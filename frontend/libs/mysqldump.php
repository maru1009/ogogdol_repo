<?php
$host = 'localhost';
$username = 'root';
$password = 'password';
$database = 'database';

$backupPath = 'C:\Users\user\Documents\ogogdol_repo\sqlbackup';
$backupFilename = $backupPath . 'backup_' . date('Y-m-d') . '_' . $database . '.sql';
$command = "mysqldump -h $host -u $username -p $password $database > $backupFilename";
exec($command, $output, $returnValue);

if ($returnValue === 0) {
    echo "Database backup created successfully.\n";
} else {
    echo "Error creating database backup.\n";
    print_r($output);
}

?>
