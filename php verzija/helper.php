<?php

function getVar($var) {
  $parentDir = dirname(__DIR__);
  $envFilePath = $parentDir . '/.env';
  
  if (file_exists($envFilePath)) {
    $file = file_get_contents($envFilePath, true);
    $env = explode("\n", $file);

    foreach ($env as $vars) {
      if (preg_match('/^'.$var.'=/', $vars)) {
        $value = preg_replace('/^'.$var.'=/', '', $vars);
        $clean = preg_replace('/["|\'|`]/', '', $value);

        return trim($clean); // Return the found value
      }
    }

    // If no match is found, return null or an empty string
    return null;
  }

  // Return null if the .env file doesn't exist
  return null;
}

// Connect to database
function getDatabaseConnection(){
    	// Access the environment variables
	$host = getVar('HOST');
	$dbname = getVar('DB');
	$username = getVar('USER');
	$password = getVar('PASSWORD');
	// var_dump($host, $dbname, $username, $password); // Debugging the values
	try {
		$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Connected successfully to the database!";
        return $pdo;
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
        exit();
	}
}
// returns recipes
function getRecipes() {
    $pdo = getDatabaseConnection();
    try {
        $stmt = $pdo->prepare("SELECT idRecipe, name FROM recipes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching recipes: " . $e->getMessage();
        exit();
    }
}
// returns timers
function getTimers() {
    $pdo = getDatabaseConnection();
    try {
        $stmt = $pdo->prepare("SELECT idTimer, idRecipe, name, duration FROM timers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching timers: " . $e->getMessage();
        exit();
    }
}




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
};





?>
