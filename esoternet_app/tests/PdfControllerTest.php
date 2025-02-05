<?php
//TEST fonctionnelle pour la création de PDF en utilisant l'entity PACT
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PdfControllerTest extends WebTestCase
{
    public function testGeneratePdfForPact(): void
    {
        $client = static::createClient();
        $client->request('GET', '/pdf/pact/1');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/pdf');
        $this->assertNotEmpty($client->getResponse()->getContent());
    }
}
