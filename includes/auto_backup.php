<?php
require_once 'backup_db.php';

// فانکشنی بکۆپکردن فراخوانی بکە
$backupFile = backupDatabase();

if ($backupFile) {
    echo "Backup created successfully: $backupFile";
} else {
    echo "Failed to create backup.";
}
?>