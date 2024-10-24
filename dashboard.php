<?php
require_once 'config.php';
requireLogin();

$user = $_SESSION['user'];
$prn = $user['prn'];

function getSubjectAttendance($pdo, $prn, $subject_code) {
    $query = "
        SELECT 
            COUNT(*) as total_lectures,
            SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_count,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_count
        FROM attendance 
        WHERE prn = ? AND subject_code = ?";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$prn, $subject_code]);
    $result = $stmt->fetch();
    
    $percentage = $result['total_lectures'] > 0 
        ? round(($result['present_count'] / $result['total_lectures']) * 100, 2) 
        : 0;
    
    return [
        'total' => $result['total_lectures'],
        'present' => $result['present_count'],
        'absent' => $result['absent_count'],
        'percentage' => $percentage
    ];
}

$overall_query = "
    SELECT 
        COUNT(*) as total_lectures,
        SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_count,
        SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_count
    FROM attendance 
    WHERE prn = ?";

$stmt = $pdo->prepare($overall_query);
$stmt->execute([$prn]);
$overall_stats = $stmt->fetch();
$overall_percentage = $overall_stats['total_lectures'] > 0 
    ? round(($overall_stats['present_count'] / $overall_stats['total_lectures']) * 100, 2) 
    : 0;

$subjects_query = "
    SELECT * FROM subjects 
    WHERE year = ? AND course = ?
    ORDER BY subject_code";

$stmt = $pdo->prepare($subjects_query);
$stmt->execute([$user['year'], $user['course']]);
$subjects = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Attendance Tracking System</title>
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <div>
            <img src="logo.png" alt="MIT World Peace University Logo" class="logo">
        </div>
            <h1>ATS</h1>
        <div class="user-controls">
            <span><?php echo htmlspecialchars($user['name']); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <main>
        <div class="top-section">
            <div class="overview">
                <div class="attendance-summary">
                    <div class="stat">
                        <i class="bi bi-calendar-event"></i>
                        <div>
                            <span>Total Lectures</span>
                            <strong><?php echo $overall_stats['total_lectures']; ?></strong>
                        </div>
                    </div>
                    <div class="stat">
                        <i class="bi bi-check-circle"></i>
                        <div>
                            <span>Present</span>
                            <strong><?php echo $overall_stats['present_count']; ?></strong>
                        </div>
                    </div>
                    <div class="stat">
                        <i class="bi bi-x-circle"></i>
                        <div>
                            <span>Absent</span>
                            <strong><?php echo $overall_stats['absent_count']; ?></strong>
                        </div>
                    </div>
                </div>
                <div class="attendance-bar">
                    <div class="progress" style="width: <?php echo $overall_percentage; ?>%"></div>
                </div>
                <span class="attendance-percentage"><?php echo $overall_percentage; ?>%</span>
            </div>

            <div class="student-info">
                <h2>Name: <?php echo htmlspecialchars($user['name']); ?></h2>
                <h2>PRN: <?php echo htmlspecialchars($user['prn']); ?></h2>
                <h2>Roll No: <?php echo htmlspecialchars($user['roll_no']); ?></h2>
                <h2>Year: <?php echo htmlspecialchars($user['year']); ?></h2>
                <h2>Course: <?php echo htmlspecialchars($user['course']); ?></h2>
            </div>
        </div>


        <section class="course-details">
            <?php foreach ($subjects as $subject): 
                $stats = getSubjectAttendance($pdo, $prn, $subject['subject_code']);
            ?>
            <div class="course-card">
                <h3><?php echo htmlspecialchars($subject['subject_name']); ?></h3>
                <a href="tablebutton.php?code=<?php echo urlencode($subject['subject_code']); ?>">
                    <span class="course-code"><?php echo htmlspecialchars($subject['subject_code']); ?></span>
                </a>
                <div class="theory-practical">
                    <?php if ($subject['has_theory']): ?>
                    <span>Theory</span>
                    <?php endif; ?>
                    <?php if ($subject['has_practical']): ?>
                    <span>Practical</span>
                    <?php endif; ?>
                </div>
                <div class="attendance-chart">
                    <div class="chart-circle" style="background: conic-gradient(#5f9ea0 <?php echo $stats['percentage']; ?>%, #eee 0)">
                        <div class="inner-circle">
                            <span class="percentage"><?php echo $stats['percentage']; ?>%</span>
                            <span class="label">Present</span>
                        </div>
                    </div>
                </div>
                <div class="attendance-info">
                    <p><i class="bi bi-calendar-event"></i> Total Lectures <span><?php echo $stats['total']; ?></span></p>
                    <p><i class="bi bi-check-circle"></i> Present <span><?php echo $stats['present']; ?></span></p>
                    <p><i class="bi bi-x-circle"></i> Absent <span><?php echo $stats['absent']; ?></span></p>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
