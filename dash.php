<?php
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
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
    <div>
        <img src="logo.png" alt="MIT World Peace University Logo" class="logo">
        <h1>ATS</h1>
    </div>

    <main role="main">
        <div class="top-section">
            <a href="logout.php" class="logout-btn">Logout</a>

            <div class="section overview">
                <div class="top-section">
                    <span> <?php echo htmlspecialchars($_SESSION['name']); ?> </span>
                    <a href="dashboard.php" class="logout-btn">Logout</a>
                    <section class="overview">
                        <div class="view-options">
                            <span class="active">Semester View</span>
                            <span>Month View</span>
                            <span>Week View</span>
                        </div>
                        <div class="attendance-summary">
                            <div class="stat">
                                <i class="bi bi-calendar-event"></i>
                                <div>
                                    <span>Total Lectures</span>
                                    <strong>50</strong>
                                </div>
                            </div>
                            <div class="stat">
                                <i class="bi bi-check-circle"></i>
                                <div>
                                    <span>Present</span>
                                    <strong>40</strong>
                                </div>
                            </div>
                            <div class="stat">
                                <i class="bi bi-x-circle"></i>
                                <div>
                                    <span>Absent</span>
                                    <strong>10</strong>
                                </div>
                            </div>
                        </div>
                        <div class="attendance-bar">
                            <div class="progress" style="width: 79.28%"></div>
                        </div>
                        <span class="attendance-percentage">79.28%</span>
                    </section>
                
                <!-- ... rest of your existing dashboard HTML ... -->
            </div>

            <div class="section student-info">
                <h2>Name: <?php echo htmlspecialchars($user['name']); ?></h2>
                <h2>PRN: <?php echo htmlspecialchars($user['prn']); ?></h2>
                <h2>Roll No: <?php echo htmlspecialchars($user['roll_no']); ?></h2>
                <h2>Year: <?php echo htmlspecialchars($user['year']); ?></h2>
                <h2>Course: <?php echo htmlspecialchars($user['course']); ?></h2>
            </div>
        </div>
        <div class="semester-selector">
            <select>
                <option>B.Tech. CSE aids 2024 (Semester III)</option>
                <option>B.Tech. CSE aids 2024 (Semester IV)</option>
            </select>
        </div>

        <section class="course-details">
            <!-- Reapeating block just used for html showing, will change it to function or something and embed with js. -->
            <div class="course-card">
                <h3>Fundamentals of Data Structure</h3>
                <a href="tablebutton.html"><span class="course-code"><input type ="button" value="FDS"></span></a>
                <div class="theory-practical">
                    <span>Theory</span>
                    <span>Practical</span>
                </div>
                <div class="attendance-chart">
                    <div class="chart-circle">
                        <div class="inner-circle">
                            <span class="percentage">72%</span>
                            <span class="label">Present</span>
                        </div>
                    </div>
                </div>
                <div class="attendance-info">
                    <p><i class="bi bi-calendar-event"></i> Total Lectures <span>5</span></p>
                    <p><i class="bi bi-check-circle"></i> Present <span>4</span></p>
                    <p><i class="bi bi-x-circle"></i> Absent <span>1</span></p>
                </div>
            </div>
            <div class="course-card">
                <h3>Database Management Systems</h3>
                <a href="tablebutton.html"><span class="course-code"><input type ="button" value="DBMS"></span></a>
                <div class="theory-practical">
                    <span>Theory</span>
                    <span>Practical</span>
                </div>
                <div class="attendance-chart">
                    <div class="chart-circle">
                        <div class="inner-circle">
                            <span class="percentage">87.5%</span>
                            <span class="label">Present</span>
                        </div>
                    </div>
                </div>
                <div class="attendance-info">
                    <p><i class="bi bi-calendar-event"></i> Total Lectures <span>8</span></p>
                    <p><i class="bi bi-check-circle"></i> Present <span>7</span></p>
                    <p><i class="bi bi-x-circle"></i> Absent <span>1</span></p>
                </div>
            </div>
            <div class="course-card">
                <h3>Project Based Learning</h3>
                <a href="tablebutton.html"><span class="course-code"><input type ="button" value="PBL"></span></a>

                <div class="theory-practical">
                    <span>Theory</span>
                    <span>Practical</span>
                </div>
                <div class="attendance-chart">
                    <div class="chart-circle">
                        <div class="inner-circle">
                            <span class="percentage">100%</span>
                            <span class="label">Present</span>
                        </div>
                    </div>
                </div>
                <div class="attendance-info">
                    <p><i class="bi bi-calendar-event"></i> Total Lectures <span>6</span></p>
                    <p><i class="bi bi-check-circle"></i> Present <span>6</span></p>
                    <p><i class="bi bi-x-circle"></i> Absent <span>0</span></p>
                </div>
            </div>
        <!-- ... rest of your existing dashboard content ... -->
    </main>
</body>
</html>
