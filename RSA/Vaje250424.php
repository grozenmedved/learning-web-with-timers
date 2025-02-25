<?php
//Session
$_SESSION;
session_start();

$tecajnica = [
		[// adding ID to allow deleting afterwards
	 "ID" => "123456"
	 "drzava" => "Drzave",
	 "oznake" => "Kratko ime",
	 "valute" => "Ime",
	 "tecaj"  => "Vrednost"
	 
	],[
	 "ID" => "123456"
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
	//here it needs to check whether the session exists, whther it's empty
//if (isset($_SESSION) && isset($_SESSION["tecajnica"]) && empty($_SESSION["tecajnica"]) ){
if (isset($_SESSION) && !isset($_SESSION["tecajnica"])) {
	$_SESSION["tecajnica"] = $tecajnica;
}	
if (isset($_GET) && $_GET['naloga'] == 'izbris'){
	echo "izbrisal bom: ".$GET['ID'];
}	
	
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
foreach ($_SESSION["tecajnica"] as $valuta) 
{	
	echo"<tr>";
		echo"<td>". $valuta["ID"] . "</td>";
		echo"<td>". $valuta["drzava"] . "</td>";
		echo"<td>". $valuta["oznake"] . "</td>";
		echo"<td>". $valuta["valute"] . "</td>";
		echo"<td>". $valuta["tecaj"] . "</td>";
	echo"</tr>";
}
echo "<form action="./Vaje250424.php" method="post">"; ?>
<tr><!-- allows inputting information into -->
	<td><input type="text" name="ID" id="ID" value="<?php echo rand(9999,99999999)?>" readonly></td>
	<td><input type="text" name="drzava" id="drzava"></td>
	<td><input type="text" name="oznake" id="oznake"></td>
	<td><input type="text" name="valute" id="valute"></td>	
	<td><input type="text" name="tecaj" id="tecaj"></td>	
	<!--allows deleting -->

</tr>
<tr>
	<td colspan="4"><input type="submit" value="dodaj valuto" style="width:100%"></td>
</tr>
<?php

</form>
echo "</table>";
if (isset($_POST["drzava"]) && isset($_POST["oznake"]) && isset($_POST["valute"]) && isset($_POST["tecaj"])){
	$_SESSION["tecajnica"], $_POST);
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vaje dan 25/04</title>
  <style>
    label {
      display: block;
      margin-top: 10px;
    }
    input {
      width: 300px;
    }
    .napake {
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
</body>
</html>