<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use Weblabel\DataTransformer\DecoderInterface;
use Weblabel\DataTransformer\Exception\UnsupportedFormatException;
use Weblabel\DataTransformer\Resolver\DecoderResolver;

class DecoderResolverTest extends TestCase
{
    public function testDecoderResolvingForNonSupportedFormat()
    {
        $this->expectException(UnsupportedFormatException::class);
        $decoderResolver = new DecoderResolver([]);
        $decoderResolver->resolve('json');
    }

    public function testDecoderResolving()
    {
        $xmlDecoder = $this->createMock(DecoderInterface::class);
        $xmlDecoder
            ->expects(self::once())
            ->method('supports')
            ->with('json')
            ->willReturn(false);

        $jsonDecoder = $this->createMock(DecoderInterface::class);
        $jsonDecoder
            ->expects(self::once())
            ->method('supports')
            ->with('json')
            ->willReturn(true);

        $decoderResolver = new DecoderResolver([$xmlDecoder, $jsonDecoder]);
        $decoder = $decoderResolver->resolve('json');

        self::assertSame($decoder, $jsonDecoder);
    }
}
