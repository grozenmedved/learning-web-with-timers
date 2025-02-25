<?php
/*
	http://students.b2.eu/udelezenec35/RSA/phptest.php
	// supposed to make a shopping list? 
	// 
	
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
	$velike_macke = [
	[
		"ime" => "tiger".
		"teza" => "200kg",
		"lokacija" => "azija",
		"podvrste" => [
			"Najmanj zaskrbljujoce vrste" => "none",
			"ogrozeni" => "juzno kitajski"
		]
	],
	[	
		"ime" => "leopard".
		"teza" => "31kg",
		"lokacija" => "afrika",
		"podvrste" => [
			"Najmanj zaskrbljujoce vrste" => "afrikanski",
			"ogrozeni" => "amur", "indokitajski" 
		]
	],
	[
		"ime" => "snezni leopard".
		"teza" => "33kg",
		"lokacija" => " centralna azija",
		"podvrste" => [
			"Najmanj zaskrbljujoce vrste" => "none",
			"ogrozeni" => "none"
		]
	]
	];
	foreach ($velike_macke as $oseba){
	echo $stevec++ ."Oseba ".$velike_macke['ime']."".$velike_macke['teza'].""je stara "". $velike_macke['lokacija']." let in zivi na naslovu ".$velike_macke['podvrste']['Najmanj zaskrbljujoce vrste'].", ".$velike_macke['podvrste']['ogrozeni']."";
};
*/


  $ime = '';
  $priimek = '';
  $geslo = '';
  $email = '';
	
	#echo "<pre>";
	#print_r($_POST);
	#echo "</pre>";
	#shows what you've entered
	if (isset($_POST) && isset($_POST['ime'])) {
		$ime = $_POST['ime'];
	}
		if (isset($_POST) && isset($_POST['priimek'])) {
		$priimek = $_POST['priimek'];
	}
		if (isset($_POST) && isset($_POST['email'])) {
		$email = $_POST['email'];
	}
		if (isset($_POST) && isset($_POST['geslo'])) {
		$geslo = $_POST['geslo'];
	}
  	#this checks for errors, need to go over later
  $napake = [];
  if (isset($_POST) && count($_POST) !== 0) {
    if (strlen($_POST['ime']) <= 2) {
      array_push($napake, ['tip' => 'ime', 'sporocilo' => 'Ime je prekratko.']);
    }
    if (strlen($_POST['priimek']) <= 2) {
      array_push($napake, ['tip' => 'priimek', 'sporocilo' => 'Priimek je prekratek.']);
    }

    $nedovoljene_domene  = ['gmail.com', 'email.si', 'yahoo.com'];
    foreach ($nedovoljene_domene as $domena) {
      if ( strpos($_POST['email'], $domena) > 0 ) {
        array_push($napake, ['tip' => 'email', 'sporocilo' => $domena.' ni dovoljen.']);
      }
    }
  }
	#checks for errors /* 

	#function #funkcije grejo tuki

$tecajnica = [
		[
	 "drzava" => "Drzave",
	 "oznake" => "Kratko ime",
	 "valute" => "Ime",
	 "tecaj"  => "Vrednost"
	],[
	 "drzava" => "ZDA",
	 "oznake" => "USD",
	 "valute" => "Ameriski Dolar",
	 "tecaj"  => "1,0460"
	],[
	 "drzava" => "Svica",
	 "oznake" => "CHF",
	 "valute" => "Svicarski Frank",
	 "tecaj"  => "1,09"
	],[
	 "drzava" => "Kitajska",
	 "oznake" => "CNY",
	 "valute" => "Kitajski yuan",
	 "tecaj"  => "0,14"
	],[
	 "drzava" => "Rusija",
	 "oznake" => "RUB",
	 "valute" => "Ruski Ruble",
	 "tecaj"  => "0,010"
	],[
	 "drzava" => "Romunija",
	 "oznake" => "RON",
	 "valute" => "Romunski leu",
	 "tecaj"  => "0,20"
	],
	
	
	
];
/*
foreach ($tecajnica as $valuta) 
{	
echo "<table>";
	echo"<tr>";
		echo"<td>". $valuta["drzava"] . "</td>";
		echo"<td>". $valuta["oznake"] . "</td>";
		echo"<td>". $valuta["valute"] . "</td>";
		echo"<td>". $valuta["tecaj"] . "</td>";
	echo"</tr>";
echo "</table>";
}
*/
echo "<table>";
foreach ($tecajnica as $valuta) 
{	
	echo"<tr>";
		echo"<td>". $valuta["drzava"] . "</td>";
		echo"<td>". $valuta["oznake"] . "</td>";
		echo"<td>". $valuta["valute"] . "</td>";
		echo"<td>". $valuta["tecaj"] . "</td>";
	echo"</tr>";
}
echo "<form action="./phptest.php" method="post">"
echo "<tr>"// allows inputting information into
	echo "<td><input type="text" name="drzava" id="drzava"></td>"
	echo "<td><input type="text" name="oznake" id="oznake"></td>"
	echo "<td><input type="text" name="valute" id="valute"></td>"	
	echo "<td><input type="text" name="tecaj" id="tecaj"></td>"		
echo "</tr>"
echo "<tr>"
	echo "<td colspan="4"><input type="submit" value="dodaj valuto" style="width:100%"></td>"
echo "</tr>"
echo "</form>"
echo "</table>";
array_push($tecajnica, $_POST);
?>
<!DOCTYPE HTML>
<html>
<HEAD>
	<title>testi</title>
	<style>
		table, th, td {
			border:1px solid;
			border-collapse:collapse;
			padding:2px;
			table-layout: fixed;
			width: 40%;

		}

	</style>
</HEAD>
<body>
<!--to gleda za napake -->
<?php if (count($napake) >= 1) { ?>
  <div class="napake">Imate napako v obrazcu.
    <ul>
      <?php foreach ($napake as $napaka) { ?>
        <li><?php echo $napaka['sporocilo']; ?></li>
      <?php } ?>
    </ul>
  </div>
<?php } ?>


<form action="phptest.php" method="POST">
<!--ime -->
 <label for="ime">
	ime:
	<input type="type" name="ime" id="id" value="<?php echo $ime; ?>">
	</label>
<!--priimek -->
 <label for="priimek">
	priimek:
	<input type="type" name="priimek" id="id" value="<?php echo $priimek; ?>">
 </label>
<!--geslo -->
 <label for="geslo">
	geslo:
	<input type="type" name="geslo" id="id" value="<?php echo $geslo; ?>">
 </label>
<!--email -->
 <label for="email">
	email:
	<input type="type" name="email" id="id" value="<?php echo $email; ?>">
 </label>
 <input type="submit"  value="Pošlji">
<!--table -->

</form>
<?php
	
	
	
?>



</body>
</html>