<?php

function getVar($var) {
    $parentDir = dirname(__DIR__);  // Get the parent directory
    $envFilePath = $parentDir . '/.env';  // Path to the .env file

    if (file_exists($envFilePath)) {
        $file = file_get_contents($envFilePath);  // Read the file contents
        $env = explode("\n", $file);  // Split into lines

        // Print out the value of $var for debugging
        echo "Looking for: " . $var . "<br>";

        // Loop through each line and print the content of $vars for debugging
        foreach ($env as $vars) {
            echo "Checking: " . $vars . "<br>";  // Debugging each line in the file

            // Check if $var matches the beginning of the line
            if (preg_match('/^' . preg_quote($var, '/') . '=/',$vars)) {  
                echo "Match found: " . $vars . "<br>";  // Debug if a match is found
                $value = preg_replace('/^' . preg_quote($var, '/') . '=/', '', $vars);  // Get the value
                $clean = preg_replace('/["|\'|`]/', '', $value);  // Clean the value
                return trim($clean);  // Return the value
            }
        }
    }
    return null;  // Return null if the variable is not found
}
?>
