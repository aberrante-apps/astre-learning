<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $grandTotal = $_POST['stripeTotal'];
  $grandTotalPrice = number_format(($grandTotal/100),2);

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => "$grandTotal",
      'currency' => 'cad',
  ]);

  echo "<h1>Successfully charged $$grandTotalPrice!</h1>";
?>