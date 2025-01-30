<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\Mailer\AuthMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Uid\Uuid;

class AuthController extends AbstractController
{
    #[Route(path: '/login', name: 'page_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername,
        ]);
    }

    #[Route(path: '/logout', name: 'page_logout')]
    public function logout(): void
    {
        
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/register', name: 'register')]
    public function register(
        Request $request,
        AuthMailer $authMailer,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $registrationForm = $this->createForm(RegistrationFormType::class);
        $registrationForm->handleRequest($request);
        

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            
            $data = $registrationForm->getData();
            $plainPassword = $data['plainPassword'];
            $repeatPassword = $data['repeatPassword'];
            
            if ($plainPassword === $repeatPassword) {
                $user = new User;
                $user->setName($data['name']);
                $user->setEmail($data['email']);
                $user->setRegistrationDate(new \DateTime());
                $user->setRoles(['ROLE_USER']);
                $user->setAccountStatus(UserAccountStatusEnum::PENDING);
                $user->setPlainPassword($plainPassword);
                
                $emailConfirmToken = Uuid::v4()->toRfc4122();
                $user->setConfirmEmailToken($emailConfirmToken);

                $entityManager->persist($user);
                $entityManager->flush();

                dump('Email sending');
                $authMailer->sendConfirmEmail($user);

                $this->addFlash('success', 'Register email confirmation has been sent');
                
                return $this->redirectToRoute('page_login');
            }

            $this->addFlash('error', 'Les mots de passe ne correspondent pas');
        }
        else {
            dump($registrationForm->getErrors()); 
        }

        return $this->render(view: 'auth/register.html.twig', parameters: [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    #[Route(path: '/confirm/{uid}', name: 'page_confirm')]
    public function confirm(
        string $uid,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $user = $userRepository->findOneBy(['confirmEmailToken' => $uid]);
        $user->setVerified(true);
        $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $user->setConfirmEmailToken(null);
        $entityManager->flush();

        return $this->redirectToRoute('page_login');
    }
}
