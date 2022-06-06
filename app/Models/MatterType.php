<?php

namespace App\Models;

class MatterType
{
    public const POST = 'post';
    public const BOOKMARK = 'bookmark';
    public const TOOL = 'tool';

    public function __construct(protected string $type)
    {
    }

    public static function values(): array
    {
        return [
            self::POST,
            self::BOOKMARK,
            self::TOOL,
        ];
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
