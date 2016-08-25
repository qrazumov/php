<?php

/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 07.12.15
 * Time: 22:17
 */
class SearchFactory
{
    const YOUTUBE_FACTORY = 'youtube';
    const GOOGLE_FACTORY = 'google';

    public function getFactory($factoty = self::GOOGLE_FACTORY)
    {
        switch ($factoty) {
            case self::YOUTUBE_FACTORY:
                $factory = new YoutubeAbstractFactory();
                break;

            case self::GOOGLE_FACTORY:
                $factory = new GoogleAbstractFactory();
                break;
        }

        return $factory;
    }
}