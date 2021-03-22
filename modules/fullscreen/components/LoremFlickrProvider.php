<?php

namespace app\modules\fullscreen\components;


use Faker\Provider\Base;

class LoremFlickrProvider extends Base
{
    /**
     * @var string
     */
    public const BASE_URL = 'https://loremflickr.com';

    /**
     * @var array
     *     */
    protected static $categories = [
        'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
        'fashion', 'people', 'nature', 'sports', 'technics', 'transport',
    ];

    public static function loremFlickrUrl(
        $width = 320,
        $height = 240
    ) {
        return sprintf(
            '%s/%d/%d/%s?lock=%d',
            self::BASE_URL,
            $width,
            $height,
            static::$categories[array_rand(static::$categories)],
            rand(0, getrandmax())
        );
    }
}
