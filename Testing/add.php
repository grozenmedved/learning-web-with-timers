<?php
	// Define parent array
	include_once 'helper.php';
	getDatabaseConnection();
	
	$testArrayOfRecipes = [
		[
			"idRecipe" => 1,
			"name" => "Beli kruh",
		],[
			"idRecipe" => 2,
			"name" => "Štruca",
		],[
			"idRecipe" => 3,
			"name" => "Žemlja",
		],
	];
	// Define child array, referencing the parent
	$testArrayOfTimers = [
		[
			"idTimer" => 1,
			"idRecipe" => 1, // Links to the parent
			"name" => "Cold fermentation",
			"duration" => 30,
		],[
			"idTimer" => 2,
			"idRecipe" => 1, // Links to the parent
			"name" => "Final proof",
			"duration" => 7200,
		],[
			"idTimer" => 3,
			"idRecipe" => 3, // Links to the parent
			"name" => "Final proof",
			"duration" => 126400,
		],
		[
			"idTimer" => 4,
			"idRecipe" => 3, // Links to the parent
			"name" => "Final proof",
			"duration" => 226400,
		],
	];
	function displayFinishingTime($duration) {
		$currentTime = time();
		$days = floor($duration / 86400);
		if ($duration < 86400) {
			return "Ready at " .  gmdate("H:i:s" , $currentTime + $duration);
		} elseif ($duration >= 86400 && $duration <  86400*2){
			return "Ready in " . $days .  " day at " .  gmdate("H:i:s" , $currentTime + $duration);
		} else {
			return "Ready in " . $days .  " days at " .  gmdate("H:i:s" , $currentTime + $duration);
		}
	};
	function addNewTimer($testArrayOfTimers, $data){
		$newTimer = [
			"idTimer" => count($testArrayOfTimers) + 1, // this should be handled by database
			"idRecipe" => $data["idRecipe"], // Links to the parent
			"name" => $data["newTimerName"],
			"duration" => 
				((int) ($data["hours"] ?? 0) * 3600) +
				((int) ($data["minutes"] ?? 0) * 60) +
				((int) ($data["seconds"] ?? 0)),
		];
		$testArrayOfTimers[] = $newTimer;
		return $testArrayOfTimers;
	}

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$testArrayOfTimers = addNewTimer($testArrayOfTimers, $_POST);
	};
	
	echo "<pre>";
	print_r($testArrayOfTimers);
	echo "</pre>";




?>
 
<!DOCTYPE html>
<html>
	<head>
		<title>Timing Saved</title>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
	</head>
	<aside>
		<a href="index.php"><button type="button">Back</button></a>
	</aside>
	<body>
		<main>
				<?php
					echo "<h2>Recipes</h2>";
					foreach ($testArrayOfRecipes as $childRecipe) {
						echo "<h3>{$childRecipe['name']} (Recipe ID: {$childRecipe['idRecipe']})</h3>";
						echo "<details open>
							<summary> Timers </summary>";

						foreach ($testArrayOfTimers as $childTimer) {
							if ($childTimer["idRecipe"] === $childRecipe["idRecipe"]) {
								echo "<li>"; 
									echo "<strong>" . $childTimer['name'] . "</strong>"; 
									echo " <button class='button'>Start</button>";
									echo " <button class='button'>Stop</button>  ";    
									// echo " duration: {$childTimer['duration']} ";
									// echo "<script>startCountdown('timer" . $childTimer['idTimer'] . "', " . $childTimer['duration'] . ");</script>";
									echo "  duration: " . displayFinishingTime($childTimer['duration']); 
								echo "</li>"; 
							}
						}
						echo "
						<form method='POST'>
							<input type='hidden' name='idRecipe' value='{$childRecipe['idRecipe']}'>
							<li>
								<input type='text' name='newTimerName' placeholder='Enter new timer name'>
								<input type='number' name='hours' placeholder='hours'>
								<input type='number' name='minutes' placeholder='minutes'>
								<input type='number' name='seconds' placeholder='seconds'>
								<button type='submit'> Save </button>
							</li>
						</form>
						";						
						echo "</details>";
					}
					echo '
						<input type="text" placeholder="Enter new recipe name">
						<button> Save </button>

					';
					
				?>
		</main>
	</body>
</html>