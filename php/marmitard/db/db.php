<?php
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception('.env file not found');
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Only process lines that look like setting assignments
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);

            // Remove any leading/trailing whitespace
            $name = trim($name);
            $value = trim($value);

            // Remove quotes from value if present
            if (preg_match('/^"(.*)"$/', $value, $matches) || preg_match("/^'(.*)'$/", $value, $matches)) {
                $value = $matches[1];
            }

            // Set the environment variable
            $_ENV[$name] = $value;
            putenv("$name=$value");
        }
    }
}

// Load the .env file
loadEnv(__DIR__ . '/.env');

// Access environment variables
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

// Example usage
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
