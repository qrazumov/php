<?php
interface eMailBody {
    public function loadBody();
}

class eMail implements eMailBody {
    public function loadBody() {
        echo "This is Main Email body.<br>";
    }
}

abstract class emailBodyDecorator implements eMailBody {

    protected $emailBody;

    public function __construct(eMailBody $emailBody) {
        $this->emailBody = $emailBody;
    }

    abstract public function loadBody();

}

class christmasEmailBody extends emailBodyDecorator {

    public function loadBody() {

        echo 'This is Extra Content for Christmas<br>';
        $this->emailBody->loadBody();

    }

}

class newYearEmailBody extends emailBodyDecorator {

    public function loadBody() {

        echo 'This is Extra Content for New Year.<br>';
        $this->emailBody->loadBody();

    }

}



/*
 *  Обычное письмо
 */

//$email = new eMail();
//$email->loadBody();
//


/*
 *  Письмо с поздравлениями с Рождеством
 */

//$email = new eMail();
//$email = new christmasEmailBody($email);
//$email->loadBody();

//
///*
// *  Письмо с поздравлениями к Новому Году
// */
//
//$email = new eMail();
//$email = new newYearEmailBody($email);
//$email->loadBody();
//
//
/*
 *  Письмо с поздравлениями с Рождеством и Новым Годом
 */

$email = new eMail();
$email = new christmasEmailBody($email);
$email = new newYearEmailBody($email);
$email->loadBody();
