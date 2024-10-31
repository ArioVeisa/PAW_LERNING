<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include("connection.php");

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $query = "SELECT * FROM student WHERE nim = '$nim'";
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari formulir
    $nim = $_POST['nim'];
    $name = $_POST['name'];
    $birth_city = $_POST['birth_city'];
    $birth_date = $_POST['birth_date'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $gpa = $_POST['gpa'];

    $update_query = "UPDATE student SET name='$name', birth_city='$birth_city', birth_date='$birth_date', faculty='$faculty', department='$department', gpa='$gpa' WHERE nim='$nim'";
    
    if (mysqli_query($connection, $update_query)) {
        header("Location: student_view.php?message=Data berhasil diperbarui");
    } else {
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link href="assets/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Edit Mahasiswa</h1>
        <form action="" method="post">
            <input type="hidden" name="nim" value="<?php echo $data['nim']; ?>">
            <label>Nama:</label>
            <input type="text" name="name" value="<?php echo $data['name']; ?>" required><br>
            <label>Tempat Lahir:</label>
            <input type="text" name="birth_city" value="<?php echo $data['birth_city']; ?>" required><br>
            <label>Tanggal Lahir:</label>
            <input type="date" name="birth_date" value="<?php echo $data['birth_date']; ?>" required><br>
            <label>Fakultas:</label>
            <input type="text" name="faculty" value="<?php echo $data['faculty']; ?>" required><br>
            <label>Jurusan:</label>
            <input type="text" name="department" value="<?php echo $data['department']; ?>" required><br>
            <label>IPK:</label>
            <input type="number" step="0.01" name="gpa" value="<?php echo $data['gpa']; ?>" required><br>
            <button type="submit">Perbarui</button>
        </form>
    </div>
</body>

</html>