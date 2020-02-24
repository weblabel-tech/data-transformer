<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer;

use Weblabel\DataTransformer\Exception\InvalidPayloadException;

interface DecoderInterface
{
    /**
     * Decodes a string into an array.
     *
     * @throws InvalidPayloadException
     */
    public function decode(string $data): array;

    /**
     * Checks if given format is supported.
     */
    public function supports(string $format): bool;
}
