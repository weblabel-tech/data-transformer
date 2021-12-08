<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer\Tests\Decoder;

use PHPUnit\Framework\TestCase;
use Weblabel\DataTransformer\Decoder\JsonDecoder;
use Weblabel\DataTransformer\Exception\InvalidPayloadException;

class JsonDecoderTest extends TestCase
{
    private JsonDecoder $jsonDecoder;

    public function testThatDecoderSupportsJsonFormat()
    {
        self::assertTrue($this->jsonDecoder->supports('json'));
    }

    /**
     * @dataProvider nonJsonFormatDataProvider
     */
    public function testThatDecoderDoesntSupportNonJsonFormat(string $format)
    {
        self::assertFalse($this->jsonDecoder->supports($format));
    }

    public function testDecodingJsonPayload()
    {
        $result = $this->jsonDecoder->decode('{"foo": "bar"}');

        self::assertSame(['foo' => 'bar'], $result);
    }

    public function testDecodingWithInvalidJsonPayload()
    {
        $this->expectException(InvalidPayloadException::class);

        $this->jsonDecoder->decode('{"foo":bar}');
    }

    public function nonJsonFormatDataProvider(): array
    {
        return [
            ['html'],
            ['txt'],
            ['xml'],
            ['jsonld'],
        ];
    }

    protected function setUp(): void
    {
        $this->jsonDecoder = new JsonDecoder();
    }
}
