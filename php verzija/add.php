<?php
	include 'helper.php';
	
	$testArrayOfRecipes = getRecipes();
	$testArrayOfTimers = getTimers();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		var_dump($_POST);
		$formId = $_POST['form_id'] ?? null;
		var_dump($formId);
		var_dump($_POST);
		if ($formId === 'newTimer'){
			    // Get form data
					$idRecipe = $_POST['idRecipe'];
					$newTimerName = $_POST['newTimerName'];
					$hours = $_POST['hours'] > 0 ? $_POST['hours'] : 0;
					$minutes = $_POST['minutes'] > 0 ? $_POST['minutes'] : 0;
					$seconds = $_POST['seconds'] > 0 ? $_POST['seconds'] : 0;
			
					// Convert the time to seconds
					$durationInSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
			
					// Insert the timer into the database
					try {
							// Get the database connection
							$pdo = getDatabaseConnection();
							// Prepare the SQL insert statement
							$stmt = $pdo->prepare("INSERT INTO timers (idRecipe, name, duration) VALUES (:idRecipe, :name, :duration)");
							// Bind parameters
							$stmt->bindParam(':idRecipe', $idRecipe);
							$stmt->bindParam(':name', $newTimerName);
							$stmt->bindParam(':duration', $durationInSeconds);
			
							// Execute the statement
							$stmt->execute();
			
							echo "Timer saved successfully!";
							// Redirect to reload the page
							header("Location: " . $_SERVER['PHP_SELF']);
							exit(); // Ensure no further execution
					} catch (PDOException $e) {
							echo "Error saving timer: " . $e->getMessage();
					}
			
		}
		if ($formId === 'newRecipe'){
			$recipeName = trim($_POST['recipeName'] ?? '');
			if (!empty($recipeName)) {
				try {
						// Get database connection
						$pdo = getDatabaseConnection();

						// Insert new recipe into the database
						$stmt = $pdo->prepare("INSERT INTO recipes (name) VALUES (:recipeName)");
						$stmt->bindParam(':recipeName', $recipeName);
						$stmt->execute();

						echo "Recipe saved successfully!";
						// Redirect to reload the page
						header("Location: " . $_SERVER['PHP_SELF']);
						exit(); // Ensure no further execution
						
				} catch (PDOException $e) {
						echo "Error saving recipe: " . $e->getMessage();
				}
		} else {
				echo "Recipe name cannot be empty.";
		}
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
						  <input type='hidden' name='form_id' value='newTimer'>
							<input type='hidden' name='idRecipe' value='{$childRecipe['idRecipe']}'>
							<div>
								<input type='text' name='newTimerName' placeholder='Enter new timer name'>
								<input type='number' name='hours' placeholder='hours'>
								<input type='number' name='minutes' placeholder='minutes'>
								<input type='number' name='seconds' placeholder='seconds'>
								<button type='submit'> Save </button>
							</div>
						</form>
						";						
						echo "</details>";
					}
					echo "
					<form method='POST'>
						<input type='hidden' name='form_id' value='newRecipe'>
						<input type='text' name='recipeName' placeholder='Enter new recipe name'>
						<button type='submit'> Save </button>
					</form>
				 ";
					
				?>
		</main>
	</body>
</html>