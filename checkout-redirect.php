<?php 

require_once('config.php'); 

require 'vendor/autoload.php';

// This is your real test secret API key.
\Stripe\Stripe::setApiKey(API_SECRET);

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'product' => 'prod_IwNrbj6jyZjs3I',
      'unit_amount' => 1500,
      'currency' => 'usd',
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'https://example.com/success',
  'cancel_url' => 'https://example.com/cancel',
]); 

?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					

					<button id="checkout-button"> Pay </button>




				</div>
			</div>
		</div>
	</body>
	<script src="https://js.stripe.com/v3/"></script>
	<script>
		var stripe = Stripe('<?php echo API_KEY; ?>');

		var checkoutButton = document.getElementById('checkout-button');

		checkoutButton.addEventListener('click', function() {
		  stripe.redirectToCheckout({
		    // Make the id field from the Checkout Session creation API response
		    // available to this file, so you can provide it as argument here
		    // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
		    sessionId: '<?php echo $session->id; ?>'
		  }).then(function (result) {
		    // If `redirectToCheckout` fails due to a browser or network
		    // error, display the localized error message to your customer
		    // using `result.error.message`.
		  });
		});
	</script>	
</html>