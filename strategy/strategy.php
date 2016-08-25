<?php
/**
 * Created by PhpStorm.
 * User: razumovsu
 * Date: 11.08.16
 * Time: 12:36
 */
interface payStrategy {
    public function pay($amount);
}
// TODO_razumovsu sample
class payByCC implements payStrategy {

    private $ccNum = '';
    private $ccType = '';
    private $cvvNum = '';
    private $ccExpMonth = '';
    private $ccExpYear = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using Credit Card";
    }

}

class payByPayPal implements payStrategy {

    private $payPalEmail = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using PayPal";
    }

}

class shoppingCart {

    public $amount = 0;

    public function __construct($amount = 0) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount = 0) {
        $this->amount = $amount;
    }

    public function payAmount() {
        if($this->amount >= 500) {
            $payment = new payByCC();
        } else {
            $payment = new payByPayPal();
        }

        $payment->pay($this->amount);
    }
}

$cart = new shoppingCart(499);
$cart->payAmount();

// Вывод
//Paying 499 using PayPal

$cart = new shoppingCart(501);
$cart->payAmount();

//Вывод
//Paying 501 using Credit Card
