<?php
		// Define parent array
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
	}





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
						echo "<h3>{$childRecipe['name']} (Recipe ID: {$childRecipe['idRecipe']})</h3>
							<input type=\"text\" placeholder=\"Enter new recipe name\">
							<button> Save </button>
						";

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
									echo 
									'<ul>
										<input type="text" placeholder="Enter new timer name">
										<input class="timerDuration" type="number" placeholder="hours">
										<input class="timerDuration" type="number" placeholder="minutes">
										<input class="timerDuration" type="number" placeholder="seconds">
										<button> Save </button>
									</ul>';
							}
						}
						echo "</details>";
					}
				?>
		</main>
	</body>
</html>