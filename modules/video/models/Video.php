<?php

namespace app\modules\video\models;

use Cacko\Yii2\Widgets\Video\Components\Video\VideoFactory;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Video extends Model
{
    public string $url = '';
    public bool $autoPlay = false;
    public bool $hideControls = false;
    public int $startTimestamp = 0;
    public int $startPosition = 0;
    public bool $openInModal = false;
    public bool $loop = false;
    public string $placeholderImage  = '';
    public string $placeholderEndImage = '';
    protected string $startTime = '';
    protected string $exampleUrl = '';

    const DEFAULT_VIDEOS = [
        VideoFactory::YOUTUBE => [
            'https://www.youtube.com/watch?v=9CTzhqVHmww' => 'Video',
            'https://www.youtube.com/watch?v=krOcGk-PuXo&list=PL_EWVaz0_zlEU5aFD2dFQ4fBm69LcfYrU' => 'Playlist'
        ],
        VideoFactory::VIMEO => [
            'https://vimeo.com/497096899' => 'Video',
            'https://vimeo.com/605783608/493d2ee578' => 'Private video'
        ],
        VideoFactory::WISTIA => [
            'https://home.wistia.com/medias/e4a27b971d' => 'Video'
        ],
        VideoFactory::TWITCH => [
            'https://clips.twitch.tv/HeartlessNurturingHippoTebowing-o5tz4mHTd7tsZ-Bc' => 'Clip',
            'https://www.twitch.tv/bignxg' => 'Channel',
            'https://www.twitch.tv/videos/1696730227' => 'Video'
        ],
        VideoFactory::MP4 => [
            SERVER_HOSTNAME . '/videos/sample-30s.mp4' => 'Video'
        ],
        VideoFactory::BRIGHTCOVE => [
            'https://players.brightcove.net/1752604059001/default_default/index.html?videoId=4825279519001' => 'Video'
        ]
    ];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url', 'placeholderImage', 'placeholderEndImage'], 'url', 'defaultScheme' => 'https'],
            [['autoPlay', 'hideControls', 'openInModal', 'loop'], 'boolean'],
            [['autoPlay', 'hideControls', 'openInModal', 'loop'], 'default', 'value' => false],
            [['startTimestamp', 'startPosition'], 'number', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [];
    }

    protected function setStartTime($val)
    {
        $this->startTime = $val;
    }

    protected function getStartTime()
    {
        return '';
    }

    public function getExampleUrl()
    {
        return $this->exampleUrl;
    }

    public static function getDefaultVideos(): array
    {
        return array_reduce(array_keys(static::DEFAULT_VIDEOS), function ($res, $type) {
            $res[VideoFactory::SUPPORTED_TYPES[$type]] = static::DEFAULT_VIDEOS[$type];
            return $res;
        }, []);
    }

    public static function getRandomDefaultVideo(): string
    {
        return array_rand(array_merge([], ...array_values(static::DEFAULT_VIDEOS)));
    }
}
