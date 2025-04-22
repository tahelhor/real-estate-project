<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';

$property_id = $_GET['id'];
$sql = "DELETE FROM properties WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$stmt->close();

$photo_sql = "DELETE FROM property_photos WHERE property_id = ?";
$photo_stmt = $conn->prepare($photo_sql);
$photo_stmt->bind_param("i", $property_id);
$photo_stmt->execute();
$photo_stmt->close();

header("Location: list_properties.php");
exit();
?>