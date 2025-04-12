<?php
// This script clears Laravel's application cache
echo "Clearing Laravel cache...\n";

// Change to the project directory
chdir(__DIR__);

// Execute artisan commands
echo shell_exec('php artisan cache:clear');
echo shell_exec('php artisan config:clear');
echo shell_exec('php artisan route:clear');
echo shell_exec('php artisan view:clear');
echo shell_exec('composer dump-autoload');
echo shell_exec('php artisan optimize:clear');

echo "Cache cleared successfully!\n";
?>