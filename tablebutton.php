<?php
require_once 'config.php';
requireLogin();

$user = $_SESSION['user'];
$prn = $user['prn'];

$subject_code = isset($_GET['code']) ? $_GET['code'] : '';

$subject_query = "SELECT * FROM subjects WHERE subject_code = ?";
$stmt = $pdo->prepare($subject_query);
$stmt->execute([$subject_code]);
$subject = $stmt->fetch();

if (!$subject) {
    header('Location: dashboard.php');
    exit;
}

$end_date = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d');
$start_date = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime($end_date . ' -30 days'));

$attendance_query = "
    SELECT 
        DATE(date) as date,
        GROUP_CONCAT(
            CASE 
                WHEN status = 'present' THEN CONCAT(period, ':✓')
                ELSE CONCAT(period, ':✗')
            END
            ORDER BY period
        ) as period_status,
        SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_count,
        SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_count
    FROM attendance 
    WHERE prn = ? 
    AND subject_code = ? 
    AND date BETWEEN ? AND ?
    GROUP BY date
    ORDER BY date";

$stmt = $pdo->prepare($attendance_query);
$stmt->execute([$prn, $subject_code, $start_date, $end_date]);
$attendance_records = $stmt->fetchAll();

$total_present = 0;
$total_absent = 0;
foreach ($attendance_records as $record) {
    $total_present += $record['present_count'];
    $total_absent += $record['absent_count'];
}
$total_lectures = $total_present + $total_absent;
$attendance_percentage = $total_lectures > 0 ? 
    round(($total_present / $total_lectures) * 100, 2) : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subject['subject_name']); ?> - Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #5f9ea0;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        .date-range {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .date-input {
            display: flex;
            align-items: center;
        }
        .date-input input {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 10px;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .stat {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .stat-icon {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        .progress-bar {
            flex-grow: 1;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin: 0 20px;
        }
        .progress {
            height: 100%;
            background-color: #4c1d95;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .present {
            color: green;
        }
        .absent {
            color: red;
        }
        select, button {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
        }
        button {
            cursor: pointer;
        }
        button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($subject['subject_name']); ?></h1>
        
        <div class="date-range">
            <div class="date-input">
                <label for="from-date">From:</label>
                <input type="date" id="from-date" value="<?php echo $start_date; ?>" onchange="updateDateRange()">
            </div>
            <div class="date-input">
                <label for="to-date">To:</label>
                <input type="date" id="to-date" value="<?php echo $end_date; ?>" onchange="updateDateRange()">
            </div>
        </div>

        <div class="summary">
            <div class="stat">
                <i class="bi bi-calendar-event"></i>
                <span>Total Lectures <?php echo $total_lectures; ?></span>
            </div>
            <div class="stat">
                <i class="bi bi-check-circle"></i>
                <span>Present <?php echo $total_present; ?></span>
            </div>
            <div class="stat">
                <i class="bi bi-x-circle"></i>
                <span>Absent <?php echo $total_absent; ?></span>
            </div>
            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $attendance_percentage; ?>%"></div>
            </div>
            <span><?php echo $attendance_percentage; ?>%</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Period 1</th>
                    <th>Period 2</th>
                    <th>Period 3</th>
                    <th>Period 4</th>
                    <th>Period 5</th>
                    <th>Period 6</th>
                    <th>Period 7</th>
                    <th>Period 8</th>
                    <th>Present/Absent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendance_records as $record): 
                    // Create an array of period statuses
                    $periods = array_fill(1, 8, 'NA');
                    $period_data = explode(',', $record['period_status']);
                    foreach ($period_data as $p) {
                        list($period, $status) = explode(':', $p);
                        $periods[(int)$period] = $status;
                    }
                ?>
                <tr>
                    <td><?php echo date('d F Y', strtotime($record['date'])); ?></td>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                    <td><?php echo $periods[$i]; ?></td>
                    <?php endfor; ?>
                    <td>
                        <span class="present"><?php echo $record['present_count']; ?></span>/
                        <span class="absent"><?php echo $record['absent_count']; ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    function updateDateRange() {
        const fromDate = document.getElementById('from-date').value;
        const toDate = document.getElementById('to-date').value;
        if (fromDate && toDate) {
            window.location.href = `?code=<?php echo urlencode($subject_code); ?>&from=${fromDate}&to=${toDate}`;
        }
    }
    </script>
</body>
</html>
