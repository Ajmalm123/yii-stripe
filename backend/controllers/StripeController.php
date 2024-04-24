<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class StripeController extends Controller
{
    public function actionCreate()
    {
        return $this->render('create');

    }  

public function actionSaveCard()
{
    $stripe = Yii::$app->stripe;
    $customerId = $stripe->createCustomer($_POST['email']);
        $card = $stripe->saveCard($customerId, $_POST['stripeToken']);
    // Save the customer ID and card ID in your database
}

public function actionChargeCard($customerId, $amount)
{
    $stripe = Yii::$app->stripe;
    $charge = $stripe->chargeCard($customerId, $amount);
  
    // Handle the charge response
}

public function actionListCards($customerId)
{
    $stripe = Yii::$app->stripe;
    $cards = $stripe->listCards($customerId);
    // Render the cards in your view
}

}