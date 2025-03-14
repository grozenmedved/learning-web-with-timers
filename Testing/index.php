<?php
	include 'helper.php';
	$testArrayOfRecipes = getRecipes();
	$testArrayOfTimers = getTimers();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// var_dump($_POST);
		$formId = $_POST['form_id'] ?? null;
		// var_dump($formId);


		if (isset($_POST['form_id']) && $formId === 'newTimer'){
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
		if (isset($_POST['form_id']) && $formId === 'newRecipe'){
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
		// Edit
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
		// Remove
		if (isset($_POST['form_id']) && $formId === 'removeRecipe') {
			$idRecipe = $_POST['idRecipe']; // The ID of the recipe to remove
			
			// Connect to the database
			try {
					$pdo = getDatabaseConnection(); // Assuming this is a function you have to get DB connection
					
					// Prepare the DELETE statement
					$stmt = $pdo->prepare("DELETE FROM recipes WHERE idRecipe = :idRecipe");
					
					// Bind the parameters
					$stmt->bindParam(':idRecipe', $idRecipe, PDO::PARAM_INT);
					
					// Execute the query
					$stmt->execute();
					
					echo "Recipe removed successfully!";
					
					// Redirect to the same page to avoid resubmission on refresh
					header('Location: ' . $_SERVER['PHP_SELF']);
					exit;

			} catch (PDOException $e) {
					echo "Error removing recipe: " . $e->getMessage();
			}
		}
		if (isset($_POST['form_id']) && $formId === 'removeTimer') {
			$idTimer = $_POST['idTimer']; // The ID of the timer to remove
			
			// Connect to the database
			try {
					$pdo = getDatabaseConnection(); // Assuming this is a function you have for the DB connection
					
					// Prepare the DELETE statement
					$stmt = $pdo->prepare("DELETE FROM timers WHERE idTimer = :idTimer");
					
					// Bind the parameters
					$stmt->bindParam(':idTimer', $idTimer, PDO::PARAM_INT);
					
					// Execute the query
					$stmt->execute();
					
					echo "Timer removed successfully!";
					
					// Redirect to the same page to avoid resubmission on refresh
					header('Location: ' . $_SERVER['PHP_SELF']);
					exit;

			} catch (PDOException $e) {
					echo "Error removing timer: " . $e->getMessage();
			}
		}	





}



	function displayBaseSite($testArrayOfRecipes, $testArrayOfTimers){
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
			echo "</details>";
		}
	}
	function displayAddVersion($testArrayOfRecipes, $testArrayOfTimers) {
		echo "<h2>Recipes</h2>";
		foreach ($testArrayOfRecipes as $childRecipe) {
			echo "<h3>{$childRecipe['name']} (Recipe ID: {$childRecipe['idRecipe']})</h3>";
			echo "<details open>
				<summary> Timers </summary>";
			foreach ($testArrayOfTimers as $childTimer) {
				if ($childTimer["idRecipe"] === $childRecipe["idRecipe"]) {
					$duration = $childTimer['duration'];
					$hours = floor($duration / 3600) . ' hours';
					$minutes = floor(($duration % 3600) / 60) . ' minutes'; 
					$seconds = $duration % 60 . ' seconds'; 
					echo "<li>"; 
						echo "<strong>" . $childTimer['name'] . "</strong> 
								<input class='timerDuration' name='hours'   placeholder='hours' value='$hours' readonly>
								<input class='timerDuration' name='minutes' placeholder='minutes' value='$minutes' readonly>
								<input class='timerDuration' name='seconds' placeholder='seconds' value='$seconds' readonly>
						";
						// echo " <button class='button'>Start</button>";
						// echo " <button class='button'>Stop</button>  ";    
						// // echo " duration: {$childTimer['duration']} ";
						// // echo "<script>startCountdown('timer" . $childTimer['idTimer'] . "', " . $childTimer['duration'] . ");</script>";
						// echo "  duration: " . displayFinishingTime($childTimer['duration']); 
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
	}
	function displayEditVersion($testArrayOfRecipes, $testArrayOfTimers){
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
	}
	function displayRemoveVersion($testArrayOfRecipes, $testArrayOfTimers){
		echo "<h2>Recipes</h2>";
		foreach ($testArrayOfRecipes as $childRecipe) {
			echo "<h3>{$childRecipe['name']} (Recipe ID: {$childRecipe['idRecipe']})</h3>";
			echo "
			<form method='POST'>
				<input type='hidden' name='form_id' value='removeRecipe'>
				<input type='hidden' name='idRecipe' value='{$childRecipe['idRecipe']}'>
				<button type='submit'> Remove </button>
			</form>
			";

			echo "<details open>
				<summary> Timers </summary>";

			foreach ($testArrayOfTimers as $childTimer) {
				if ($childTimer["idRecipe"] === $childRecipe["idRecipe"]) {
					echo "<div>"; 
					echo "<strong>" . $childTimer['name'] . "</strong>"; 
					echo "
					<form method='POST'>
							<input type='hidden' name='form_id' value='removeTimer'>
							<input type='hidden' name='idTimer' value='{$childTimer['idTimer']}'>
						<button type='submit'> Remove </button>
					</form>
				</div>"; 

				}
			}
			echo "</details>";
		}

	}
	function displayAsideMain(){
		echo "
		<a href='index.php?action=add'><button type='button'>Add</button></a>
		<a href='index.php?action=edit'><button type='button'>Edit</button></a>
		<a href='index.php?action=remove'><button type='button'>Remove</button></a>
		";
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
		<?php
			$action = $_GET['action'] ?? 'default'; // Default action if none is provided
			if ($action === 'default') {
				displayAsideMain();
			}
			else {
				echo '<a href="index.php"><button type="button">Back</button></a>';
			}

		?>
		<!-- <a href="index.php?action=add"><button type="button">Add</button></a>
		<a href="index.php?action=edit"><button type="button">Edit</button></a>
		<a href="index.php?action=remove"><button type="button">Remove</button></a> -->
	</aside>
	<body>
		<main>
				<?php
					$action = $_GET['action'] ?? 'default'; // Default action if none is provided
					if ($action === 'add') {
						displayAddVersion($testArrayOfRecipes, $testArrayOfTimers);
						// echo "<h2>Add a New Item</h2>";
						// Display your add form here
				} elseif ($action === 'edit') {
					displayEditVersion($testArrayOfRecipes, $testArrayOfTimers);
						// echo "<h2>Edit an Item</h2>";
						// Display your edit form here
				} elseif ($action === 'remove') {
					displayRemoveVersion($testArrayOfRecipes, $testArrayOfTimers);
						// echo "<h2>Remove an Item</h2>";
						// Display your remove form here
				} else {
					displayBaseSite($testArrayOfRecipes, $testArrayOfTimers);
						// Default content
				}
				?>
		</main>
	</body>
</html>