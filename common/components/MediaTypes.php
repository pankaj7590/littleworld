<?php

namespace common\components;

class MediaTypes
{
    const PRODUCT = 1;
    const PRODUCT_GROUP = 2;
    const THEME_OPTION = 3;

    public static $constants = [
        'product' => self::PRODUCT,
        'product_group' => self::PRODUCT_GROUP,
        'theme_option' => self::THEME_OPTION,
    ];

    public static $titles = [
        self::PRODUCT => 'Product',
        self::PRODUCT_GROUP => 'Product Group',
        self::THEME_OPTION => 'Theme Option',
    ];

}