<?php


 require('inc/stripe-php-master/config.php'); 

\Stripe\Stripe::setApiKey($Secretkey);

try {
    $token = $_POST['stripeToken'];
    $amount = 500; // Amount in paise
    $currency = "inr";
    $return_url = "https://stripe-php-master/thankyou.php"; // Replace with your actual return URL
   


    $source = \Stripe\Source::create([
        'type' => 'card',
        'token' => $token,
    ]);

    $paymentIntent = \Stripe\PaymentIntent::create([
        "amount" => $amount,
        "currency" => $currency,
        "description" => "Payment description",
        "source" => $source->id, // Use Source ID instead of token
        "confirm" => true, // Confirm the PaymentIntent immediately
        "return_url" => $return_url, // Specify the return URL
    ]);

    echo '<pre>';
    print_r($paymentIntent);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>