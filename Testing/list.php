<?php
		// Define parent array
	$testArrayOfRecipies = [
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
	$testArrayOfTimers = [
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
			"idTimer" => 3,
			"idrecipe" => 3, // Links to the parent
			"name" => "Final proof",
			"duration" => 126400,
		],
		[
			"idTimer" => 4,
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

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Edit Recipes or Timers</title>
      <style>
          .input-section {
              display: none;
          }
      </style>
  </head>
  <body>
  <main>
    <h2>Recipes</h2>
    <?php foreach ($testArrayOfRecipies as $childRecipie): ?>
        <li>
        <h3><?= htmlspecialchars($childRecipie['name']) ?> (Recipe ID: <?= $childRecipie['idrecipe'] ?>)</h3>
        <button onclick="toggleForm('addTimerForm<?= $childRecipie['idrecipe'] ?>')">Add Timer</button>
        <div id="addTimerForm<?= $childRecipie['idrecipe'] ?>" style="display:none;">
            <form method="POST">
                <input type="hidden" name="idrecipe" value="<?= $childRecipie['idrecipe'] ?>">
                <input type="text" name="new_timer_name" placeholder="Timer name">
                <input type="number" name="duration" placeholder="Duration (sec)">
                <button type="submit">Save</button>
            </form>
        </div>
        <details open>
            <summary>Timers</summary>
            <?php foreach ($testArrayOfTimers as $childTimer): ?>
                <?php if ($childTimer['idrecipe'] === $childRecipie['idrecipe']): ?>
                    <li>
                        <strong><?= htmlspecialchars($childTimer['name']) ?></strong> 
                        <button>Start</button>
                        <button>Stop</button>
                        <span>Duration: <?= $childTimer['duration'] ?> sec</span>
                        <button>Edit Timer</button>
                        <button>Remove Timer</button>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </details>
        </li>
    <?php endforeach; ?>

    <button onclick="toggleForm('addRecipeForm')">Add Recipe</button>
    <div id="addRecipeForm" style="display:none;">
        <form method="POST">
            <input type="text" name="new_recipe_name" placeholder="Recipe name">
            <button type="submit">Save</button>
        </form>
    </div>
</main>


  </body>
</html>
