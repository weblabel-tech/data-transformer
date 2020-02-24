<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer;

use Weblabel\DataTransformer\Exception\UnsupportedFormatException;

interface DecoderResolverInterface
{
    /**
     * Returns decoder for given format.
     *
     * @throws UnsupportedFormatException
     */
    public function resolve(string $format): DecoderInterface;
}
