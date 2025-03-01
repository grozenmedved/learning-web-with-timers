<?php
		// Define parent array
	$exampleParent = [
		[
			"idrecipe" => 1,
			"name" => "Beli kruh",
		],[
			"idrecipe" => 2,
			"name" => "Štruca",
		],[
			"idrecipe" => 3,
			"name" => "Žemlja",
		],
	];
	// Define child array, referencing the parent
	$exampleChild = [
		[
			"idTimer" => 1,
			"idrecipe" => 1, // Links to the parent
			"name" => "Cold fermentation",
			"duration" => 30,
		],[
			"idTimer" => 2,
			"idrecipe" => 1, // Links to the parent
			"name" => "Final proof",
			"duration" => 7200,
		],[
			"idTimer" => 3,
			"idrecipe" => 3, // Links to the parent
			"name" => "Final proof",
			"duration" => 126400,
		],
		[
			"idTimer" => 4,
			"idrecipe" => 3, // Links to the parent
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
<script>
	function addTimer(timerStorage){
		// function that creates input fields below and then pushes the values into the appropriate array
	}
	function removeTimer(timerStorage, timerID){
		// function removes the timer 
		// what does it need
			// needs the main array that stores everything
			// then it needs the id, to remove
			// finally, it removes the edit array	
		return timerStorage.splice(timerStorage.findIndex((timerData)=> timerData.id == timerID), 1)
	}
	function editTimer(timerStorage, timerChanges){
		// 

	}
	</script>

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
					foreach ($exampleParent as $parent) {
						echo "<h3>{$parent['name']} (Recipe ID: {$parent['idrecipe']})</h3>
							<input type=\"text\" placeholder=\"Enter new recipe name\">
							<button> Save </button>
						";

						echo "<details open>
							<summary> Timers </summary>";

						foreach ($exampleChild as $child) {
							if ($child["idrecipe"] === $parent["idrecipe"]) {
								echo "<li>"; 
									echo "<strong>" . $child['name'] . "</strong>"; 
									echo " <button class='button'>Start</button>";
									echo " <button class='button'>Stop</button>  ";    
									// echo " duration: {$child['duration']} ";
									// echo "<script>startCountdown('timer" . $child['idTimer'] . "', " . $child['duration'] . ");</script>";
									echo "  duration: " . displayFinishingTime($child['duration']); 
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