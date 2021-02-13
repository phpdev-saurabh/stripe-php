<?php 

require_once('config.php'); 
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
					

				<script src="https://checkout.stripe.com/checkout.js"></script>

				<button id="customButton" class="btn btn-primary">Stripe Pay Button</button>

				<form action="checkout-popup-charge.php" id="stripe_charge_form" method="POST">
					<input type="hidden" name="stripe_token" value="" id="stripe_token">
					<input type="hidden" name="item_id" value="" id="123">
				</form>

				<script>
				var handler = StripeCheckout.configure({
				  key: '<?php echo API_KEY;?>',
				  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
				  locale: 'auto',
				  token: function(token) {
				    // You can access the token ID with `token.id`.
				    // Get the token ID to your server-side code for use.

				    // Send Token To Server using HTML Form
				    $("#stripe_token").val(token.id);
				    $("#stripe_charge_form").submit();
				  }
				});

				document.getElementById('customButton').addEventListener('click', function(e) {
				  // Open Checkout with further options:
				  handler.open({
				    name: 'Demo Site',
				    description: '2 widgets',
				    amount: 2000
				  });
				  e.preventDefault();
				});

				// Close Checkout on page navigation:
				window.addEventListener('popstate', function() {
				  handler.close();
				});
				</script>


				</div>
			</div>
		</div>
	</body>
	
</html>