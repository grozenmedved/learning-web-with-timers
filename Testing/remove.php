<?php
	include 'helper.php';
	$testArrayOfRecipes = getRecipes();
	$testArrayOfTimers = getTimers();





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
						echo '
							<button> Remove </button>
						';

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
									echo '
										<button> Remove </button>
									';	
								echo "</li>"; 
	
							}
						}
						echo "</details>";
					}
				?>
		</main>
	</body>
</html>