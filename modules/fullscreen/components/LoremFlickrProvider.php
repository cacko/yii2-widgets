<?php

namespace app\modules\fullscreen\components;


use Faker\Provider\Base;

class LoremFlickrProvider extends Base
{
    /**
     * @var string
     */
    public const BASE_URL = 'https://picsum.photos';


    public static function loremFlickrUrl(
        $width = 320,
        $height = 240
    ): string
    {
        return sprintf(
            '%s/%d/%d.webp?random=%d',
            self::BASE_URL,
            $width,
            $height,
            rand(0, getrandmax())
        );
    }
}
