<?php
include('db_conn.php');

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($mysqli->query("DELETE FROM units WHERE id='$id'") === TRUE) {
        header('Location: ./UnitManagement.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>