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
		if ($formId === 'newTimer'){

		}
		if ($formId === 'newRecipe'){
		
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
								<input type='hidden' name='form_id' value='newRecipe'>
								<input type='text' name='recipeName' placeholder='{$childRecipe['name']}'>
								<button type='submit'> Save </button>
							</div>
						</form>";

						echo "<details open>
							<summary> Timers </summary>";

						foreach ($testArrayOfTimers as $childTimer) {
							if ($childTimer["idRecipe"] === $childRecipe["idRecipe"]) {
								// echo "<li>"; 
								// 	echo "<strong>" . $childTimer['name'] . "</strong>"; 
								// 	echo " <button class='button'>Start</button>";
								// 	echo " <button class='button'>Stop</button>  ";    
								// 	// echo " duration: {$childTimer['duration']} ";
								// 	// echo "<script>startCountdown('timer" . $childTimer['idTimer'] . "', " . $childTimer['duration'] . ");</script>";
								// 	echo "  duration: " . displayFinishingTime($childTimer['duration']); 
								// 	echo "</li>";
									echo "
									<form method='POST'>
										<input type='hidden' name='form_id' value='editTimer'>
										<input type='hidden' name='idRecipe' value='{$childRecipe['idRecipe']}'>
										<div>
											<input type='text' placeholder='{$childTimer['name']}'>
											<input class='timerDuration' type='number' placeholder='hours'>
											<input class='timerDuration' type='number' placeholder='minutes'>
											<input class='timerDuration' type='number' placeholder='seconds'>
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