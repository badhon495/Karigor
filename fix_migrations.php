<?php
// Run this script to fix the database schema and refresh migrations

echo "Starting database fix...\n";

// Change to project directory
chdir(__DIR__);

// Drop and recreate tables
echo "Refreshing database migrations...\n";
echo shell_exec('php artisan migrate:fresh');

// Verify contact_issues table structure
echo "\nChecking contact_issues table structure:\n";
echo shell_exec('php artisan db:table contact_issues');

echo "\nFix completed. Please check the output above to verify the user_name column exists.\n";
?>