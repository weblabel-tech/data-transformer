<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer\Decoder;

use Weblabel\DataTransformer\DecoderInterface;
use Weblabel\DataTransformer\Exception\InvalidPayloadException;

final class JsonDecoder implements DecoderInterface
{
    private const FORMAT_JSON = 'json';

    private const RECURSION_DEPTH = 512;

    /**
     * {@inheritdoc}
     */
    public function decode(string $data): array
    {
        try {
            return json_decode($data, true, self::RECURSION_DEPTH, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new InvalidPayloadException(sprintf('Cannot decode payload. Error: %s', $e->getMessage()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supports(string $format): bool
    {
        return self::FORMAT_JSON === $format;
    }
}
