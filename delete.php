<?php
$conn = new mysqli("localhost", "root", "", "database");
$id   = $_GET['id'] ?? '';

if (isset($id) && !empty($id)) {
    $conn->query("DELETE FROM `data` WHERE `id` = $id");
    header("Location: home.php");
} else {
    header("Location: home.php");
}