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
		<!-- editing -->
		<aside>
			<a><button class="button" id="newReceptButton">Edit Timers</button></a>
			<a><button class="button" id="editReceptButton">Edit Recept</button></a>
			<a><button class="button" id="removeReceptButton">Remove Recept</button></a>
			<a><button class="button" id="newTimerButton">New Timer</button></a>
			<a><button class="button" id="editTimerButton">Edit Timer</button></a>
			<a><button class="button" id="removeTimerButton">Remove Timer</button></a>
		</aside>	

		<!-- Inputs for New Recept -->
		<div id="newReceptInputs" class="inputSection" style="display:none;">
				<input type="text" placeholder="Enter new recept name">
				<textarea placeholder="Enter recept details"></textarea>
				<button>Save New Recept</button>
		</div>

		<!-- Inputs for Edit Recept -->
		<div id="editReceptInputs" class="inputSection" style="display:none;">
				<input type="text" placeholder="Enter recept name to edit">
				<textarea placeholder="Edit recept details"></textarea>
				<button>Save Edited Recept</button>
		</div>

		<!-- Inputs for Remove Recept -->
		<div id="removeReceptInputs" class="inputSection" style="display:none;">
				<p>Are you sure you want to remove this recept?</p>
				<button>Yes</button>
				<button>No</button>
		</div>

		<!-- Inputs for New Timer -->
		<div id="newTimerInputs" class="inputSection" style="display:none;">
				<input type="text" placeholder="Enter timer name">
				<input type="time" placeholder="Set timer time">
				<button>Save New Timer</button>
		</div>

		<!-- Inputs for Edit Timer -->
		<div id="editTimerInputs" class="inputSection" style="display:none;">
				<input type="text" placeholder="Enter timer name to edit">
				<input type="time" placeholder="Edit timer time">
				<button>Save Edited Timer</button>
		</div>

		<!-- Inputs for Remove Timer -->
		<div id="removeTimerInputs" class="inputSection" style="display:none;">
				<p>Are you sure you want to remove this timer?</p>
				<button>Yes</button>
				<button>No</button>
		</div>
<script>
    // Hide all input sections initially
    const inputSections = document.querySelectorAll('.inputSection');
    inputSections.forEach(section => section.style.display = 'none');

    // Add event listeners to buttons to show/hide corresponding input sections
    document.getElementById('newReceptButton').addEventListener('click', function() {
        toggleInputs('newReceptInputs');
    });
    document.getElementById('editReceptButton').addEventListener('click', function() {
        toggleInputs('editReceptInputs');
    });
    document.getElementById('removeReceptButton').addEventListener('click', function() {
        toggleInputs('removeReceptInputs');
    });
    document.getElementById('newTimerButton').addEventListener('click', function() {
        toggleInputs('newTimerInputs');
    });
    document.getElementById('editTimerButton').addEventListener('click', function() {
        toggleInputs('editTimerInputs');
    });
    document.getElementById('removeTimerButton').addEventListener('click', function() {
        toggleInputs('removeTimerInputs');
    });
    // Function to show the correct input section and hide the others
    function toggleInputs(sectionId) {
        // Hide all input sections
        inputSections.forEach(section => section.style.display = 'none');
        
        // Show the selected input section
        document.getElementById(sectionId).style.display = 'block';
    }
</script>

		<main>
				<?php
					echo "<h2>Recepti</h2>";
					foreach ($exampleParent as $parent) {
						echo "<h3>{$parent['name']} (Recipe ID: {$parent['idRecipie']})</h3>";
						echo "<details open>
							<summary> Timerji </summary>";
						foreach ($exampleChild as $child) {
							if ($child["idRecipie"] === $parent["idRecipie"]) {
								echo "<li>"; 
									echo "<strong>" . $child['name'] . "</strong>"; 
									echo " <button class='button'>Start</button>";
									echo " <button class='button'>Stop</button>  ";    
									echo " duration: {$child['duration']} ";
									// echo "<script>startCountdown('timer" . $child['idTimer'] . "', " . $child['duration'] . ");</script>";
									echo "  duration: " . displayFinishingTime($child['duration']); 
								echo "</li>"; 
							}
						}
						echo "</details>";
					}				
				?>
		</main>
	</body>
</html>