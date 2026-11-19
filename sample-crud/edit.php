
<?php
include 'db.php';

// Get the student ID from the URL
$id = $_GET['id'];

// Get the existing student record
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();

// Update the student record
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year_level = $_POST['year_level'];

    $sql = "UPDATE students SET
            student_id = ?,
            first_name = ?,
            last_name = ?,
            email = ?,
            course = ?,
            year_level = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssii",
        $student_id,
        $first_name,
        $last_name,
        $email,
        $course,
        $year_level,
        $id
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
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student Record</h2>

<form method="POST" action="">

    Student ID:
    <input type="text" name="student_id"
           value="<?php echo htmlspecialchars($student['student_id']); ?>" required>
    <br><br>

    First Name:
    <input type="text" name="first_name"
           value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
    <br><br>

    Last Name:
    <input type="text" name="last_name"
           value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
    <br><br>

    Email:
    <input type="email" name="email"
           value="<?php echo htmlspecialchars($student['email']); ?>" required>
    <br><br>

    Course:
    <input type="text" name="course"
           value="<?php echo htmlspecialchars($student['course']); ?>" required>
    <br><br>

    Year Level:
    <input type="number" name="year_level" min="1" max="5"
           value="<?php echo $student['year_level']; ?>" required>
    <br><br>

    <button type="submit">Update Student</button>

</form>

<br>
<a href="index.php">Back to Student Records</a>

</body>
</html>
