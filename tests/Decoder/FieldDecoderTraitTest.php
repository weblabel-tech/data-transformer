<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer\Tests\Decoder;

use PHPUnit\Framework\TestCase;
use Weblabel\DataTransformer\Decoder\FieldDecoderTrait;
use Weblabel\DataTransformer\DecoderInterface;

class FieldDecoderTraitTest extends TestCase
{
    public function testDecodingOfArrayFields()
    {
        $fieldDecoder = $this->getMockForTrait(FieldDecoderTrait::class);
        $decoder = $this->createMock(DecoderInterface::class);
        $decoder
            ->method('decode')
            ->withConsecutive(['{"foo":"bar"}'], ['{"baz":"qux"}'])
            ->willReturnOnConsecutiveCalls(['foo' => 'bar'], ['baz' => 'qux']);

        $fieldDecoder->setDecoder($decoder);
        $data = [
            'firstKey' => '{"foo":"bar"}',
            'secondKey' => '{"baz":"qux"}',
            'thirdKey' => '{"quux":"quuz"}',
        ];
        $fields = [
            'firstKey',
            'secondKey',
        ];

        $decodedData = $fieldDecoder->decodeFields($data, $fields);

        self::assertSame(
            [
                'firstKey' => [
                    'foo' => 'bar',
                ],
                'secondKey' => [
                    'baz' => 'qux',
                ],
                'thirdKey' => '{"quux":"quuz"}',
            ],
            $decodedData
        );
    }

    public function testSkippingNonexistingField()
    {
        $fieldDecoder = $this->getMockForTrait(FieldDecoderTrait::class);
        $decoder = $this->createMock(DecoderInterface::class);
        $decoder
            ->expects(self::never())
            ->method('decode');

        $data = [];
        $fields = [
            'nonExistingKey',
        ];

        $fieldDecoder->decodeFields($data, $fields);
    }
}
