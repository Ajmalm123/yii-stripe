<?php
namespace app\components;

use Yii;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;

class StripeComponent extends \yii\base\Component
{
    public $secretKey;

    public function init()
    {
        parent::init();
        Stripe::setApiKey($this->secretKey);
    }

    public function createCustomer($email)
    {
        return Customer::create(['email' => $email]);
    }

    public function saveCard($customerId, $token)
    {
        $customer = Customer::retrieve($customerId);
        $card = $customer->sources->create(['source' => $token]);
        return $card;
    }

    public function listCards($customerId)
    {
        $customer = Customer::retrieve($customerId);
        return $customer->sources->all(['object' => 'card']);
    }

    public function chargeCard($customerId, $amount, $currency = 'usd')
    {
        $customer = Customer::retrieve($customerId);
        $charge = Charge::create([
            'amount' => $amount,
            'currency' => $currency,
            'customer' => $customerId,
        ]);
        return $charge;
    }
}
