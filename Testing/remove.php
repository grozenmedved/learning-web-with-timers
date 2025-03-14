<?php
	include 'helper.php';
	$testArrayOfRecipes = getRecipes();
	$testArrayOfTimers = getTimers();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formId = $_POST['form_id'] ?? null;
    
    if ($formId === 'removeRecipe') {
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
		if ($formId === 'removeTimer') {
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
				?>
		</main>
	</body>
</html>