<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "attendance_system");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$prn = mysqli_real_escape_string($connection, $_POST['prn']);
$password = $_POST['password'];

// Query to check credentials
$query = "SELECT * FROM students WHERE prn = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $prn);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if ($password === $row['password']) {
        $_SESSION['user'] = $row;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Wrong Password";
    }
} else {
    $error = "PRN not found!";
}

// Close the prepared statement
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Attendance Tracking System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
            border: 1px solid #ef9a9a;
        }
        button {
            background-color: #5f9ea0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #4f8a8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h1>Attendance Tracking System</h1>
        
        <div class="para">
            <p><strong>Our system is designed to streamline and simplify the process of
            managing attendance for your organization.</strong></p>
        </div>

        <?php if ($error): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="prn">PRN:</label>
                <input type="text" id="prn" name="prn" required 
                       value="<?php echo isset($_POST['prn']) ? htmlspecialchars($_POST['prn']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

    </div>
</body>
</html>
