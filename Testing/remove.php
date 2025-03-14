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