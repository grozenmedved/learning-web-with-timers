<?php
	// Define parent array
	include 'helper.php';

	$testArrayOfRecipes = getRecipes();
	$testArrayOfTimers = getTimers();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// var_dump($_POST);
		$formId = $_POST['form_id'] ?? null;
		// var_dump($formId);
		// var_dump($_POST);
		// Edit Timer
		if (isset($_POST['form_id']) && $formId === 'editTimer'){
			$idRecipe = $_POST['idRecipe'];
			$idTimer = $_POST['idTimer'];
			$newTimerName = $_POST['newTimerName'];
			$hours = $_POST['hours'];
			$minutes = $_POST['minutes'];
			$seconds = $_POST['seconds'];
	
			$durationInSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
			try {
        // Get the database connection
        $pdo = getDatabaseConnection();

        // Prepare the SQL update statement
        $stmt = $pdo->prepare("UPDATE timers SET name = :name, duration = :duration WHERE idTimer = :idTimer");

        // Bind parameters to the query
        $stmt->bindParam(':name', $newTimerName);
        $stmt->bindParam(':duration', $durationInSeconds);
        $stmt->bindParam(':idTimer', $idTimer, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Provide feedback
				echo "Timer updated successfully!";
				// Redirect to refresh the page
				header("Location: " . $_SERVER['PHP_SELF']);
				exit();
    } catch (PDOException $e) {
        // Handle any errors
        echo "Error updating timer: " . $e->getMessage();
    }

		}
		// Edit Recipe
		if (isset($_POST['form_id']) && $formId === 'editRecipe'){
			$recipeId = $_POST['idRecipe'] ?? null;
			$newRecipeName = trim($_POST['recipeName'] ?? '');
			if (!empty($recipeId) && !empty($newRecipeName)) {
				try {
					$pdo = getDatabaseConnection();
					$stmt = $pdo->prepare("UPDATE recipes SET name = :name WHERE idRecipe = :id");
					$stmt->bindParam(':name', $newRecipeName);
					$stmt->bindParam(':id', $recipeId);
					$stmt->execute();
					// Redirect to refresh the page
					header("Location: " . $_SERVER['PHP_SELF']);
					exit();
				} catch (PDOException $e) {
						echo "Error updating recipe: " . $e->getMessage();
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
						echo "<h3>{$childRecipe['name']} (Recipe ID: {$childRecipe['idRecipe']})</h3>
						<form method='POST'>
							<div>
								<input type='hidden' name='form_id' value='editRecipe'>
								<input type='hidden' name='idRecipe' value='{$childRecipe['idRecipe']}'>
								<input type='text' name='recipeName' placeholder='{$childRecipe['name']}' value='{$childRecipe['name']}'>
								<button type='submit'> Save </button>
							</div>
						</form>";

						echo "<details open>
							<summary> Timers </summary>";

						foreach ($testArrayOfTimers as $childTimer) {
							if ($childTimer["idRecipe"] === $childRecipe["idRecipe"]) {
								$duration = $childTimer['duration'];
								$hours = floor($duration / 3600);
								$minutes = floor(($duration % 3600) / 60); 
								$seconds = $duration % 60; 
								// echo "<li>"; 
								// 	echo "<strong>" . $childTimer['name'] . "</strong>"; 
								// 	echo " <button class='button'>Start</button>";
								// 	echo " <button class='button'>Stop</button>  ";    
								// 	// echo " duration: {$childTimer['duration']} ";
								// 	// echo "<script>startCountdown('timer" . $childTimer['idTimer'] . "', " . $childTimer['duration'] . ");</script>";
									// echo "  duration: " . displayFinishingTime($childTimer['duration']); 
								// 	echo "</li>";
									echo "
									<form method='POST'>
										<input type='hidden' name='form_id' value='editTimer'>
										<input type='hidden' name='idRecipe' value='{$childRecipe['idRecipe']}'>
										<input type='hidden' name='idTimer' value='{$childTimer['idTimer']}'>
										<div>
											<input type='text' name='newTimerName' placeholder='{$childTimer['name']}' value='{$childTimer['name']}'>
											<input class='timerDuration' type='number' name='hours'   placeholder='hours' value='$hours'>
											<input class='timerDuration' type='number' name='minutes' placeholder='minutes' value='$minutes'>
											<input class='timerDuration' type='number' name='seconds' placeholder='seconds' value='$seconds'>
											<button> Save </button>
										</div>
									</form>";
							}
						}
						echo "</details>";
					}
				?>
		</main>
	</body>
</html>