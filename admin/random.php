<?php
//$rand =rand(1,9);
for($rand, $i =1; $i<10; $i++){
	$rand =mt_rand(1000000000,mt_getrandmax());
echo $rand.'</br>';
}
?>