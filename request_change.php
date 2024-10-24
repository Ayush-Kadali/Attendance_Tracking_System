<?php
require_once 'config.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dash.php');
    exit();
}

$date = $_POST['date'] ?? '';
$period = $_POST['period'] ?? '';
$subject_code = $_POST['subject_code'] ?? '';
$reason = $_POST['reason'] ?? '';
$prn = $_SESSION['user']['prn'];

try {
    $stmt = $pdo->prepare("
        SELECT id, status 
        FROM attendance 
        WHERE prn = ? AND subject_code = ? AND date = ? AND period = ?
    ");
    $stmt->execute([$prn, $subject_code, $date, $period]);
    $attendance = $stmt->fetch();

    if (!$attendance) {
        throw new Exception('Attendance record not found');
    }

    $stmt = $pdo->prepare("
        SELECT id 
        FROM attendance_requests 
        WHERE attendance_id = ? AND status = 'pending'
    ");
    $stmt->execute([$attendance['id']]);
    if ($stmt->fetch()) {
        throw new Exception('A request is already pending for this attendance');
    }

    $stmt = $pdo->prepare("
        INSERT INTO attendance_requests 
        (attendance_id, prn, requested_status, reason) 
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
        $attendance['id'],
        $prn,
        $attendance['status'] === 'present' ? 'absent' : 'present',
        $reason
    ]);

    $_SESSION['success_message'] = 'Attendance change request submitted successfully';
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
}

header("Location: subject_attendance.php?code=" . urlencode($subject_code));
exit();
