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
			"idTimer" => 2,
			"idrecipe" => 3, // Links to the parent
			"name" => "Final proof",
			"duration" => 126400,
		],
		[
			"idTimer" => 2,
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
		<!-- Choose timers or recipes -->
		<aside>
			<a><button class="button" id="recipeChooseButton">Edit recipes</button></a>
			<a><button class="button" id="timerChooseButton">Edit timers</button></a>
		</aside>	
		<!-- Choose whether to add, edit, or remove -->
		<div id="recipeChooseWhichEdit" class="inputSection" style="display:none;">
				<button class="editSection" id="recipeIDAddNew">New recipe</button>
				<button class="editSection" id="recipeIDEdit">Edit recipe</button>
				<button class="editSection" id="recipeIDRemove">Remove recipe</button>
		</div>
		<div id="timerChooseWhichEdit" class="inputSection" style="display:none;">
				<button class="editSection" id="timerIDAddNew">New timer</button>
				<button class="editSection" id="timerIDEdit">Edit timer</button>
				<button class="editSection" id="timerIDRemove">Remove timer</button>
		</div>
		<!-- Inputs for New Timer -->
		<div id="recipeAddNewInputs" class="editSection" style="display:none;">
				<input type="text" placeholder="Enter recipe name">
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
    // Recipie or timer section
    const inputSections = document.querySelectorAll('.inputSection');
    inputSections.forEach(section => section.style.display = 'none');

    // Add event listeners to buttons to show/hide corresponding input sections
    document.getElementById('recipeChooseButton').addEventListener('click', function() {
        toggleInputs('recipeChooseWhichEdit', inputSections);
    });
    document.getElementById('timerChooseButton').addEventListener('click', function() {
        toggleInputs('timerChooseWhichEdit', inputSections);
    });
    function toggleInputs(sectionId, sectionType) {
        // Hide all input sections
        sectionType.forEach(section => section.style.display = 'none');
        // Show the selected input section
        document.getElementById(sectionId).style.display = 'block';
    }

		// Edit section
		// const editSection = document.querySelectorAll('.editSection');
    // editSection.forEach(section => section.style.display = 'none');
		// document.getElementById('recipeIDAddNew').addEventListener('click', function() {
    //     toggleInputs('recipeAddNewInputs', editSection);
    // });

    // Add event listeners to buttons to show/hide corresponding input sections

</script>

		<main>
				<?php
					echo "<h2>Recepti</h2>";
					foreach ($exampleParent as $parent) {
						echo "<h3>{$parent['name']} (Recipe ID: {$parent['idrecipe']})</h3>";
						echo "<details open>
							<summary> Timerji </summary>";
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
							}
						}
						echo "</details>";
					}				
				?>
		</main>
	</body>
</html>