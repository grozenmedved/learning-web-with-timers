<?php
		// Define parent array
	$exampleParent = [
		[
			"idRecipie" => 1,
			"name" => "Beli kruh",
		],[
			"idRecipie" => 2,
			"name" => "Štruca",
		],[
			"idRecipie" => 3,
			"name" => "Žemlja",
		],
	];
	// Define child array, referencing the parent
	$exampleChild = [
		[
			"idTimer" => 1,
			"idRecipie" => 1, // Links to the parent
			"name" => "Cold fermentation",
			"duration" => 30,
		],[
			"idTimer" => 2,
			"idRecipie" => 1, // Links to the parent
			"name" => "Final proof",
			"duration" => 7200,
		],[
			"idTimer" => 2,
			"idRecipie" => 3, // Links to the parent
			"name" => "Final proof",
			"duration" => 126400,
		],
		[
			"idTimer" => 2,
			"idRecipie" => 3, // Links to the parent
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
	function startCountdown(timerId, timeLeft) {
			function updateTimer() {
					if (timeLeft <= 0) {
							document.getElementById(timerId).innerHTML = 'Time\'s up!';
							clearInterval(timerInterval); // Stop the interval when time is up
					} else {
							let minutes = Math.floor(timeLeft / 60);
							let seconds = timeLeft % 60;
							document.getElementById(timerId).innerHTML = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
							timeLeft--; // Decrease the time
					}
			}

			// Update every second
			let timerInterval = setInterval(updateTimer, 1000);
			return timeLeft;
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
		<!-- search bar -->
		<aside class="search_bar">
			<a><button class="button"> New </button></a>
			<a><button class="button"> Edit </button></a>
			<a><button class="button"> Remove </button></a>
		</aside>
		<main>
				<?php
					echo "<h2>Recepti</h2>";
					foreach ($exampleParent as $parent) {
						echo "<h3>{$parent['name']} (Recipe ID: {$parent['idRecipie']})</h3>";
						echo "<details open>
							<summary> Timerji </summary>";
						foreach ($exampleChild as $child) {
							if ($child["idRecipie"] === $parent["idRecipie"]) {
								echo "<li>"; // Start child list item
									echo "<strong>" . $child['name'] . "</strong>"; // Display child name and duration
									echo " <button class='button'>Start</button>";
									echo " <button class='button'>Stop</button>  ";    
									echo " duration: {$child['duration']} ";
									echo "<script>startCountdown('timer" . $child['idTimer'] . "', " . $child['duration'] . ");</script>";
									echo "  duration: " . displayFinishingTime($child['duration']); // Display child name and duration
								echo "</li>"; // End child list item
							}
						}
						echo "</details>";
					}				
				?>
		</main>
	</body>
</html>