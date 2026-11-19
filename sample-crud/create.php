
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year_level = $_POST['year_level'];

    $sql = "INSERT INTO students
            (student_id, first_name, last_name, email, course, year_level)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssi",
        $student_id,
        $first_name,
        $last_name,
        $email,
        $course,
        $year_level
    );

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add New Student</h2>

<form method="POST" action="">

    Student ID:
    <input type="text" name="student_id" required>
    <br><br>

    First Name:
    <input type="text" name="first_name" required>
    <br><br>

    Last Name:
    <input type="text" name="last_name" required>
    <br><br>

    Email:
    <input type="email" name="email" required>
    <br><br>

    Course:
    <input type="text" name="course" required>
    <br><br>

    Year Level:
    <input type="number" name="year_level" min="1" max="5" required>
    <br><br>

    <button type="submit">Save Student</button>

</form>

<br>

<a href="index.php">Back to Student Records</a>

</body>
</html>
