<?php
// CampusCart Express - SQLite Setup (Updated)

$db_file = __DIR__ . '/campuscart.db';

try {
    $conn = new PDO("sqlite:" . $db_file);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create users table with reset token support
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        full_name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        phone TEXT,
        password TEXT NOT NULL,
        reset_token TEXT,
        token_expiry DATETIME,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);

    // Add columns if the table already existed without them
    try {
        $conn->exec("ALTER TABLE users ADD COLUMN reset_token TEXT");
    } catch (Exception $e) {}

    try {
        $conn->exec("ALTER TABLE users ADD COLUMN token_expiry DATETIME");
    } catch (Exception $e) {}

    echo "<h2 style='color: green;'>Setup Successful!</h2>";
    echo "<p>Database updated with password reset support.</p>";
    echo "<p>You can now close this page.</p>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>