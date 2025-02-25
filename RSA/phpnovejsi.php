<?php
//http://students.b2.eu/udelezenec35/RSA/phpnovejsi.php

//arrays for storing information
$glava = [[
	"ID"=>"1",
	"skupina"=>"Kruh",//To add a function to turn first letter uppercase
	"podskupina"=>"Peka",
	"sinonim"=>"brioš",
	"dodatna"=>"230C, ventilator ugasnjen",
	"timer" =>[
		"imecasa"=>"Pokrov gor" // better to use seconds instead of seperate minutes and use a function to show time
		"ura"=>"00",//if empty, default to zero(00)
		"minuta"=>"30",
		"sekunda"=>"00"
	],[
		"imecasa"=>"Pokrov dol"
		"ura"=>"00",//if empty, default to zero(00)
		"minuta"=>"08",// always use two digits and cap it 59
		"sekunda"=>"30"
	]],[
	"ID"=>"2",
	"skupina"=>"Kruh",
	"podskupina"=>"Testo",
	"sinonim"=>"rustikalna štruca",
	"dodatna"=>"maslo daj vn prej da se malo stopi. 150C, ventilator vključen",
	"timer" =>[
		"imecasa"=>"1st fold"
		"ura"=>"00",//if empty, default to zero(00)
		"minuta"=>"20",
		"sekunda"=>"00"
	],[
		"imecasa"=>"2nd fold"
		"ura"=>"00",
		"minuta"=>"20",
		"sekunda"=>"00"
		]]
]
$storage_list = [[
		["Baking" =>[
			["Bake" =>[ 
				["Name" => "Rustic loaf"],
				["Extra" => "230c"],
				["Timers" =>[
					["ID" => [
						["name" => "First part"],
						["Time" => 18000]],
						[






//then create a function for displaying that information
function tabela($glava)
{
	echo "<table>";
		foreach
			echo "<tr>";
				echo "<td>";

			echo "</tr>";
	echo "</table>";
}
$y = 3*25;



?>
<!DOCTYPE html>
<html>
	<head>
		<title>php novejsi test</title>
	</head>
	<body>
		<p><?php echo $y; ?></p>
	</body>
</html>

