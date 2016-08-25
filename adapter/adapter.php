<?php
// Имплементация класса Twitter
class Twitter {

    public function __construct() {
        // Your Code here //
    }

    public function send($msg) {
        // Posting to Twitter //
        echo $msg;
    }
}

// Простой интерфейс для каждого адаптера, который будет создан
interface socialAdapter {
    public function send($msg);
}

class twitterAdapter implements socialAdapter {

    private $twitter;

    public function __construct(Twitter $twitter) {
        $this->twitter = $twitter;
    }

    public function send($msg) {
        $this->twitter->send($msg);
    }
}
