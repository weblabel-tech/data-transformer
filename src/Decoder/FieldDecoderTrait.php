<?php

declare(strict_types=1);

namespace Weblabel\DataTransformer\Decoder;

use Weblabel\DataTransformer\DecoderInterface;

trait FieldDecoderTrait
{
    /** @var DecoderInterface */
    private DecoderInterface $decoder;

    public function decodeFields(array $data, array $fields): array
    {
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }

            $data[$field] = $this->decoder->decode($data[$field]);
        }

        return $data;
    }

    public function setDecoder(DecoderInterface $decoder): void
    {
        $this->decoder = $decoder;
    }
}
