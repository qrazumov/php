<?php
/**
 * Created by PhpStorm.
 * User: razumovsu
 * Date: 12.08.16
 * Time: 10:01
 */
// Получатель
class radioControl {
    public function turnOn() {
        // Включаем радио
        echo "Turning On Radio";
    }
    public function turnOff() {
        // Выключаем радио
        echo "Turning Off Radio";
    }
}

// Команда
interface radioCommand {
    public function execute();
}

class turnOnRadio implements radioCommand {
    private $radioControl;
    public function __construct(radioControl $radioControl) {
        $this->radioControl = $radioControl;
    }
    public function execute() {
        $this->radioControl->turnOn ();
    }
}

class turnOffRadio implements radioCommand {
    private $radioControl;
    public function __construct(radioControl $radioControl) {
        $this->radioControl = $radioControl;
    }
    public function execute() {
        $this->radioControl->turnOff ();
    }
}


// Клиент
$in = 'turnOffRadio';

// Подстановка
if (class_exists ( $in )) {
    $command = new $in ( new radioControl () );
} else {
    throw new Exception ( '..Command Not Found..' );
}

$command->execute ();
