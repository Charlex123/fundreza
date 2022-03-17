<?php

function randStrGen($len) {
$result = "";
$chars = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charArray = str_split($chars);
for($i = 0; $i <$len; $i++) {
    $randItem = array_rand($charArray);
    $result .= "".$charArray[$randItem];
}
return $result;
}

function randStrGena($lena) {
    $resulta = "";
    $charsa = '123456789012345678901234567890123456789012345678901234567890';
    $charArraya = str_split($charsa);
    for($i = 0; $i <$lena; $i++) {
        $randItema = array_rand($charArraya);
        $resulta .= "".$charArraya[$randItema];
    }
    return $resulta;
    }

?>

<?php
$rand = randStrGen(25);
$randa = randStrGena(8);
?>
