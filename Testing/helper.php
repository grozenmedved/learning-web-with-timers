<?php

function getVar($var) {
  $parentDir = dirname(__DIR__);
  $envFilePath = $parentDir . '/.env';
  if (file_exists($envFilePath)) {
    echo ".env file found!";
} else {
    echo ".env file not found!";
}
  
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

?>
