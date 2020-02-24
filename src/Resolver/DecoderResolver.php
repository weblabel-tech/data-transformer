<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer\Resolver;

use Weblabel\DataTransformer\DecoderInterface;
use Weblabel\DataTransformer\DecoderResolverInterface;
use Weblabel\DataTransformer\Exception\UnsupportedFormatException;

final class DecoderResolver implements DecoderResolverInterface
{
    /** @var DecoderInterface[] */
    private array $decoders = [];

    /**
     * @param iterable|DecoderInterface[] $decoders
     */
    public function __construct(iterable $decoders)
    {
        foreach ($decoders as $decoder) {
            $this->addDecoder($decoder);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(string $format): DecoderInterface
    {
        foreach ($this->decoders as $decoder) {
            if ($decoder->supports($format)) {
                return $decoder;
            }
        }

        throw UnsupportedFormatException::forFormat($format);
    }

    /**
     * Adds new decoder.
     */
    public function addDecoder(DecoderInterface $decoder): void
    {
        $this->decoders[] = $decoder;
    }
}
