<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-save-card">
    <h1>Save Your Card</h1>

    <?php $form = ActiveForm::begin([
    'id' => 'payment-form',
    'action' => ['stripe/save-card'],
    'method' => 'post',
]); ?>

    <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>

    <div class="form-group">
        <?= Html::submitButton('Save Card', ['class' => 'btn btn-primary', 'id' => 'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_51P3KOU08wKd0e4UeyKhlcFMGqRGBRKUgrljBFY8njq1NTZVq9HY0voI1j9iKDW3Nh33Auhq2Wz1AzUSQYFvZ04rJ00ItJlZoLS'); // Replace 'your_publishable_key' with your actual publishable key
    var elements = stripe.elements();

    var card = elements.create('card');
    card.mount('#card-element');

    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Add the token to the form so it gets submitted to the server
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    });
</script>
