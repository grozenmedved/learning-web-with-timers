<?php

function getVar($var) {
    $parentDir = dirname(__DIR__);  // Get the parent directory
    $envFilePath = $parentDir . '/.env';  // Path to the .env file

    if (file_exists($envFilePath)) {
        $fileContents = file_get_contents($envFilePath);  // Read the file contents
        echo nl2br($fileContents);  // Output the file contents, converting newlines to <br> for proper display in the browser
    } else {
        echo ".env file not found!";
    }
    if (file_exists($envFilePath)) {
        $file = file_get_contents($envFilePath);  // Read the contents
        $env = explode("\n", $file);  // Split into lines

        foreach ($env as $vars) {
            if (preg_match('/^' . $var . '=', $vars)) {  // Match the variable name
                $value = preg_replace('/^' . $var . '=', '', $vars);  // Get the value
                $clean = preg_replace('/["|\'|`]/', '', $value);  // Clean up any quotes
                return trim($clean);  // Return the value
            }
        }
    }
    return null;  // Return null if the variable is not found
    
}

?>
