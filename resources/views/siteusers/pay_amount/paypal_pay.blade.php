<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>
<!--  AfrRh8D3wWEm4yK3Kqlr_a-zPkoDr2X0dcPRO3c1pYK9nkZ19Yt6154aGDcsSm0LFNbTynL-R_ZlKUKW
      AeIFaCYvS264x4qvukDDrPpvkw6OfTfBLVt8Nfe5pNEMh1L619hKsGWjUyI-2zdHbf4T5vR4ToB9OcVV -- Dev-->
<body>

<form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="/payment/add-funds/paypal">
  {{ csrf_field() }}
  <h2 class="w3-text-blue">Payment Form</h2>
  <p>Demo PayPal form - Integrating paypal in laravel</p>
  <p>      
  <label class="w3-text-blue"><b>Enter Amount</b></label>
  <input class="w3-input w3-border" name="amount" type="text"></p>      
  <button class="w3-btn w3-blue">Pay with PayPal</button></p>
</form>


  <script
    src="https://www.paypal.com/sdk/js?client-id=AfrRh8D3wWEm4yK3Kqlr_a-zPkoDr2X0dcPRO3c1pYK9nkZ19Yt6154aGDcsSm0LFNbTynL-R_ZlKUKW"></script>
  <div id="paypal-button-container"></div>

  <script>

  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
</script>
</body>
</html>
