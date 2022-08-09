<?php

namespace SnowPatch;

class VideoParser
{

    protected static $providers = [
        'YouTube' => [
            'identify' => '%youtube(?:-nocookie)?\.com|youtu\.be%i',
            'parse' => '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            'embed' => 'https://www.youtube.com/embed/%s',
        ],
        'Vimeo' => [
            'identify' => '%vimeo\.com%i',
            'parse' => '%vimeo\.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*%i',
            'embed' => 'https://player.vimeo.com/video/%d',
        ],
    ];

    public static function getProvider($url)
    {

        if (filter_var($url, FILTER_VALIDATE_URL)) {

            foreach (self::$providers as $provider => $actions) {
                if (preg_match($actions['identify'], $url)) {
                    return $provider;
                }
            }
        }

        return false;
    }

    public static function getId($url, $provider = false)
    {

        $providers = self::$providers;
        $provider = $provider ?: self::getProvider($url);

        if ($provider && in_array($provider, array_keys($providers))) {
            preg_match($providers[$provider]['parse'], $url, $matches);
            return $matches[1];
        }

        return false;
    }

    public static function getEmbed($url, $provider = false, $id = false)
    {

        $provider = $provider ?: self::getProvider($url);
        $id = $id ?: self::getId($url, $provider);

        return ($id) ? sprintf(self::$providers[$provider]['embed'], $id) : false;
    }
}
