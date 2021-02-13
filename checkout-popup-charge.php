<?php

require_once('config.php');

require 'vendor/autoload.php';

function print_a($obj)
{
	echo '<pre>';
	print_r($obj);
	echo '</pre>';
}

// Make Stripe Object from secret key

try {
	$stripe = new \Stripe\StripeClient(
 		API_SECRET
	);
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage(); exit;
}

// collect token from form...
$stripe_token = $_POST['stripe_token'] ?? '';
$item_id = $_POST['item_id'] ?? '';

try {
	$token = $stripe->tokens->retrieve(
	  $stripe_token,
	  []
	);

	$customer_email = $token->card->email ?? '';
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage(); exit;
}


// create customer from card email details ... 

try {
	$customer = $stripe->customers->create([
	  'email' => $customer_email,
	  'source' => $stripe_token,
	]);
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage(); exit;
}

// Charge the customer with Card Token

// To get Item Price we have $item_id in POST implement your own logic to get price...

// Stripe Price ==> 120 * 100 === $120

$amount = 120 * 100;

try {
	$charge = $stripe->charges->create([
	  'customer' => $customer->id,
	  'description' => 'Custom t-shirt',
	  'amount' => $amount,
	  'currency' => 'usd',
	]);
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage(); exit;
}

print_a($charge); exit;