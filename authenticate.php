<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prn = $_POST['prn'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE prn = ?");
        $stmt->execute([$prn]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'prn' => $user['prn'],
                'name' => $user['name'],
                'roll_no' => $user['roll_no'],
                'year' => $user['year'],
                'course' => $user['course']
            ];
            header('Location: dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid PRN or password';
            header('Location: login.php');
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header('Location: login.php');
        exit();
    }
}
