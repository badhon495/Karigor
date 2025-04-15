<?php

/**
 * PostgreSQL SSL Connection Test Script
 * 
 * This script tests the connection to PostgreSQL on Render and
 * provides detailed diagnostics for SSL connection issues.
 * 
 * Usage: php postgres-ssl-test.php
 */

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

echo "PostgreSQL Connection Test\n";
echo "=========================\n\n";

// Get database configuration
$host = $_ENV['DB_HOST'] ?? 'postgres.render.com';
$port = $_ENV['DB_PORT'] ?? '5432';
$database = $_ENV['DB_DATABASE'] ?? 'laravel';
$username = $_ENV['DB_USERNAME'] ?? 'postgres';
$password = $_ENV['DB_PASSWORD'] ?? '';

echo "Connection Details:\n";
echo "Host: $host\n";
echo "Port: $port\n";
echo "Database: $database\n";
echo "Username: $username\n";
echo "Password: " . (empty($password) ? "Not set" : "Set (hidden)") . "\n\n";

// Test SSL mode settings
$sslmodes = ['require', 'prefer', 'disable'];

foreach ($sslmodes as $sslmode) {
    echo "Testing with sslmode=$sslmode...\n";
    
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$database;sslmode=$sslmode";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => true
        ];
        
        $pdo = new PDO($dsn, $username, $password, $options);
        echo "SUCCESS! Connected with sslmode=$sslmode\n";
        
        // Test a simple query
        $stmt = $pdo->query("SELECT version()");
        $version = $stmt->fetchColumn();
        echo "PostgreSQL version: $version\n";
        $pdo = null;
        echo "Connection closed successfully.\n\n";
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage() . "\n\n";
    }
}

// Connection recommendations
echo "Connection Recommendations:\n";
echo "=========================\n";
echo "1. Use 'sslmode=require' on Render (most secure)\n";
echo "2. Check that your Render environment variables are set correctly\n";
echo "3. Ensure your database credentials are correct\n";
echo "4. Check if Render's internal PostgreSQL service is working properly\n";

// How to update your .env file
echo "\nUpdate your .env file with:\n";
echo "DB_CONNECTION=pgsql\n";
echo "DB_HOST=$host\n";
echo "DB_PORT=$port\n";
echo "DB_DATABASE=$database\n";
echo "DB_USERNAME=$username\n";
echo "DB_PASSWORD=your-password\n";
echo "DB_SSLMODE=require\n";

echo "\nDone!\n";