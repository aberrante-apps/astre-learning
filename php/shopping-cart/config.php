<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_51L9DMcC3Fxs5t7yjavphjcduofdsyVwJiL9zZvqYQHFY3OEkVjt9tRFOlAulTMw05WTtlx0LBen7faj7CodAhOMm00xoRa2EdW",
  "publishable_key" => "pk_test_51L9DMcC3Fxs5t7yjmDU4hEtCcRhM2cEk1VzdIjcc7HZKnyp6V7J9lcdGkHC2ZJB0UgH5Z3SLjHN5brfnvilEIUms009I51EDeW",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>