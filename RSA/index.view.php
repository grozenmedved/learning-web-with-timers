<?php
	echo "<h1>pozdravljen svet!</h1>"; 
	echo "<p>Text gre tuki</p>";
	
	$carts = [ 'laptop', 'mouse', 'keyboard' ];
	$prices = 
	[
   'laptop' => 1000,
   'mouse' => 50,
   'keyboard' => 120
	];
	echo $prices['laptop']; // 1000
	echo $prices['mouse']; // 50
	echo $prices['keyboard']; // 120

?>
