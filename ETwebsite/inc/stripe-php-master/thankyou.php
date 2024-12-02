<?php
require('config.php');

\Stripe\Stripe::setApiKey($Secretkey);

try {
    // Retrieve the PaymentIntent ID from the query parameters
    $paymentIntentId = $_GET['payment_intent'];

    // Retrieve the PaymentIntent status
    $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
    


    // Check if the payment was successful
    if ($paymentIntent->status === 'succeeded') {
        echo "Thank you for your payment!";
    } else {
        echo "Payment failed.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
