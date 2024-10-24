<?php
require_once 'config.php';
requireLogin();

$user = $_SESSION['user'];
$subject_code = $_GET['code'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM subjects WHERE subject_code = ?");
$stmt->execute([$subject_code]);
$subject = $stmt->fetch();

if (!$subject) {
    header('Location: dash.php');
    exit();
}

$start_date = $_GET['from'] ?? date('Y-m-d', strtotime('-30 days'));
$end_date = $_GET['to'] ?? date('Y-m-d');

$attendance_query = "
    SELECT 
        date,
        GROUP_CONCAT(
            CASE 
                WHEN period = 1 THEN status
                ELSE NULL 
            END
        ) as period1,
        GROUP_CONCAT(
            CASE 
                WHEN period = 2 THEN status
                ELSE NULL 
            END
        ) as period2,
        GROUP_CONCAT(
            CASE 
                WHEN period = 3 THEN status
                ELSE NULL 
            END
        ) as period3,
        GROUP_CONCAT(
            CASE 
                WHEN period = 4 THEN status
                ELSE NULL 
            END
        ) as period4,
        GROUP_CONCAT(
            CASE 
                WHEN period = 5 THEN status
                ELSE NULL 
            END
        ) as period5,
        GROUP_CONCAT(
            CASE 
                WHEN period = 6 THEN status
                ELSE NULL 
            END
        ) as period6,
        GROUP_CONCAT(
            CASE 
                WHEN period = 7 THEN status
                ELSE NULL 
            END
        ) as period7,
        GROUP_CONCAT(
            CASE 
                WHEN period = 8 THEN status
                ELSE NULL 
            END
        ) as period8,
        SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_count,
        SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_count
    FROM attendance
    WHERE prn = ? 
    AND subject_code = ?
    AND date BETWEEN ? AND ?
    GROUP BY date
    ORDER BY date DESC";

$stmt = $pdo->prepare($attendance_query);
$stmt->execute([$user['prn'], $subject_code, $start_date, $end_date]);
$attendance_records = $stmt->fetchAll();

$total_present = 0;
$total_absent = 0;
foreach ($attendance_records as $record) {
    $total_present += $record['present_count'];
    $total_absent += $record['absent_count'];
}
$total_lectures = $total_present + $total_absent;
$attendance_percentage = $total_lectures > 0 ? round(($total_present / $total_lectures) * 100, 2) : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subject['subject_name']); ?> Attendance</title>
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($subject['subject_name']); ?></h1>

        <div class="date-range">
            <form method="GET" action="">
                <input type="hidden" name="code" value="<?php echo htmlspecialchars($subject_code); ?>">
                <div class="date-input">
                    <label>From:</label>
                    <input type="date" name="from" value="<?php echo $start_date; ?>">
</div>
<div class="date-input">
                    <label>To:</label>
                    <input type="date" name="to" value="<?php echo $end_date; ?>">
                </div>
                <button type="submit" class="btn">Filter</button>
            </form>
        </div>

        <div class="summary">
            <div class="stat">
                <i class="bi bi-calendar-event"></i>
                <div>
                    <span>Total Lectures</span>
                    <strong><?php echo $total_lectures; ?></strong>
                </div>
            </div>
            <div class="stat">
                <i class="bi bi-check-circle"></i>
                <div>
                    <span>Present</span>
                    <strong><?php echo $total_present; ?></strong>
                </div>
            </div>
            <div class="stat">
                <i class="bi bi-x-circle"></i>
                <div>
                    <span>Absent</span>
                    <strong><?php echo $total_absent; ?></strong>
                </div>
            </div>

            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $attendance_percentage; ?>%"></div>
            </div>
            <span class="percentage"><?php echo $attendance_percentage; ?>%</span>
        </div>

        <div class="attendance-table">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <th>Period <?php echo $i; ?></th>
                        <?php endfor; ?>
                        <th>Present/Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance_records as $record): ?>
                    <tr>
                        <td><?php echo date('d M Y', strtotime($record['date'])); ?></td>
                        <?php for ($i = 1; $i <= 8; $i++): 
                            $period = 'period' . $i;
                            $status = $record[$period];
                        ?>
                        <td>
                            <?php if ($status === 'present'): ?>
                                <span class="present">✓</span>
                            <?php elseif ($status === 'absent'): ?>
                                <a href="#" class="absent" 
                                   onclick="requestChange('<?php echo $record['date']; ?>', <?php echo $i; ?>)">✗</a>
                            <?php else: ?>
                                NA
                            <?php endif; ?>
                        </td>
                        <?php endfor; ?>
                        <td>
                            <span class="present">[<?php echo $record['present_count']; ?>]</span> / 
                            <span class="absent">[<?php echo $record['absent_count']; ?>]</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="requestModal" class="modal">
            <div class="modal-content">
                <h2>Request Attendance Change</h2>
                <form id="changeRequestForm" method="POST" action="request_change.php">
                    <input type="hidden" name="date" id="requestDate">
                    <input type="hidden" name="period" id="requestPeriod">
                    <input type="hidden" name="subject_code" value="<?php echo htmlspecialchars($subject_code); ?>">
                    
                    <div class="form-group">
                        <label for="reason">Reason for Change:</label>
                        <textarea name="reason" id="reason" required></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" onclick="closeModal()">Cancel</button>
                        <button type="submit">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function requestChange(date, period) {
        document.getElementById('requestDate').value = date;
        document.getElementById('requestPeriod').value = period;
        document.getElementById('requestModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('requestModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('requestModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    </script>
</body>
</html>
