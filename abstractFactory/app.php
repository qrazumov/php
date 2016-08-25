<?php
/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 07.12.15
 * Time: 22:32
 */


// don't forget to include all files
include 'Config.php';
include 'SearchProviderAbstractFactory.php';
include 'GoogleAbstractFactory.php';
include 'YoutubeAbstractFactory.php';
include 'SearchFactory.php';
include 'Youtube.php';
include 'Google.php';


$searchAbstractFactory = new SearchFactory();

// youtube

$youtubeFactory = $searchAbstractFactory->getFactory(SearchFactory::YOUTUBE_FACTORY);

$youtube = $youtubeFactory->getInstance();

// google

//$googleFactory = $searchAbstractFactory->getFactory();
//
//$google = $googleFactory->getInstance();

$youtube->search('How to make money fast?');
$youtube->getResult();