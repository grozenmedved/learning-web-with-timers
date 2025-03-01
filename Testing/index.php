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
	function toggleForm(id){
		let form = document.getElementById(id);
		form.style.display = form.style.display === "none" || form.style.display === "" ? "block" : "none";
	}
	</script>

<!DOCTYPE html>
<html>
	<head>
		<title>Timing Saved</title>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
	</head>
	<body>
		<main>
				<?php
					echo "<h2>Recipes</h2>";
					foreach ($exampleParent as $parent) {
						echo "<h3>{$parent['name']} (Recipe ID: {$parent['idrecipe']})</h3>";
						echo "
							<button> remove recipe</button>
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
									echo "
										<button> edit timer</button>
									";
									echo "
										<button> remove timer</button>
									";
								echo "</li>"; 
							}
						}
						echo "<li>"; 
							echo "
								<button> Add timer </button>
							";
						echo "</li>"; 
						echo "</details>";
						echo '<button onclick=\"toggleForm(\'showRecipeNewFields\')\">Add recipe</button>';
						echo '<div id="showRecipeNewFields" class="hidden">
							<input type="text" placeholder="Enter name">
							<input type="number" placeholder="Enter number">
							<button>Submit</button>
						</div>
						';
					}
				?>
		</main>
	</body>
</html>