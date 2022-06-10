<?php
  require_once('./config.php');

  // Basic POST variables
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  // POST variables for customer billing address
  $billingAddress = $_POST[''];
  $billingCity = $_POST[''];
  $billingProvince = $_POST[''];
  $billingPostalCode = $_POST[''];

  // POST variables for shipping address
  $shippingName = $_POST[''];
  $shippingAddress = $_POST[''];
  $shippingCity = $_POST[''];
  $shippingProvince = $_POST[''];
  $shippingPostalCode = $_POST[''];

  // POST variables for the price of the order
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
?>