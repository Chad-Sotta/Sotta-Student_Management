
<?php
include 'db.php';

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
</head>
<body>

<h2>Student Record Management</h2>

<a href="create.php">Add New Student</a>

<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Year Level</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['course']); ?></td>
        <td><?php echo $row['year_level']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <form action="delete.php" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this student?');">

            <input type="hidden" name="id"
                value="<?php echo $row['id']; ?>">

            <button type="submit">Delete</button>

            </form>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
