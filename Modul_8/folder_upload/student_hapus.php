<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include("connection.php");

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $delete_query = "DELETE FROM student WHERE nim='$nim'";
    
    if (mysqli_query($connection, $delete_query)) {
        header("Location: student_view.php?message=Data berhasil dihapus");
    } else {
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
} else {
    header("Location: student_view.php?message=Data tidak ditemukan");
}
?>