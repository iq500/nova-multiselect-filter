<?php

namespace Iq500\Filters\Enums;

class Config
{
    public const NO_OPTIONS_LABEL = 'noOptionsLabel';
    public const PLACEHOLDER = 'placeholder';

    /**
     * @return string[]
     */
    public static function getProperties(): array
    {
        return [
            self::NO_OPTIONS_LABEL,
            self::PLACEHOLDER,
        ];
    }
}