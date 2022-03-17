<?php

if(isset($_POST['donate'])) {
    
   $request = [
   'tx_ref'=>'hooli-tx-1920bbtytty',
   "amount"=>"100",
   "currency"=>"NGN",
   "redirect_url"=>"https://fundreza.com/donatesuccess",
   "payment_options"=>"card",
   "meta"=>[
      "consumer_id"=>23,
      "consumer_mac"=>"92a3-912ba-1192a"
   ],
   "customer"=>[
      "email"=>"user@gmail.com",
      "phonenumber"=>"080****4528",
      "name"=>"Yemi Desola"
   ],
   "customizations"=>[
      "title"=>"Pied Piper Payments",
      "description"=>"Middleout isn't free. Pay the price",
      "logo"=>"https://assets.piedpiper.com/logo.png"
   ]
];
}
?>