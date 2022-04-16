<?php

include('db.php');

if ($_GET['id'] === null) {
    die('ID required!');
}

$id = $_GET['id'];

$query = $conn->prepare("DELETE FROM kegiatan WHERE id = ?");
$query->bind_param('s', $id);

$result = $query->execute();

if (!$result) {
    die("Execution failed");
}

header("Location: index.php");