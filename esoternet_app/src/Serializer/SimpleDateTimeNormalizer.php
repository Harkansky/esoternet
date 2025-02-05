<?php


use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use DateTime;
use DateTimeInterface;
use UnexpectedValueException;
use ArrayObject;

class SimpleDateTimeNormalizer implements ContextAwareNormalizerInterface, ContextAwareDenormalizerInterface
{
    private const FORMAT = 'd/m/Y';

    /**
     * Normalise un objet DateTime en chaîne formatée.
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): string|null
    {
        if ($object instanceof \DateTimeInterface) {
            return $object->format(self::FORMAT);
        }

        return null;
    }


    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof DateTimeInterface;
    }

    /**
     * Dénormalise une chaîne ou un tableau en objet DateTime.
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): ?DateTimeInterface
    {
        if (empty($data)) {
            return null;
        }
        if (is_array($data) && isset($data['date'])) {
            return new DateTime($data['date']);
        }
        $dt = DateTime::createFromFormat(self::FORMAT, $data);
        if (!$dt) {
            throw new UnexpectedValueException("La date '$data' ne correspond pas au format attendu.");
        }
        return $dt;
    }
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === DateTimeInterface::class || is_subclass_of($type, DateTimeInterface::class);
    }
}
