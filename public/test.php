<?php

require_once __DIR__ . '/../config/config.php';

require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/User.php';

echo "<h2>Testing SISPALA Mahardika</h2>";

echo "<h3>1. Testing Database</h3>";

try {
    $database = new Database();
    $db = $database->getConnection();

    echo "✅ Database berhasil terhubung";
} catch (Exception $e) {
    echo "❌ Database gagal: " . $e->getMessage();
}

echo "<hr>";

echo "<h3>2. Testing User Model</h3>";

try {
    $userModel = new User();

    $user = $userModel->findByUsername('admin');

    if ($user) {
        echo "✅ User admin ditemukan";

        echo "<pre>";
        print_r($user);
        echo "</pre>";
    } else {
        echo "❌ User admin tidak ditemukan";
    }

} catch (Exception $e) {
    echo "❌ User Model error: " . $e->getMessage();
}