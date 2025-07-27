<!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginAdmin"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}
		require_once "../connection/connection.php";
?>
<!---------------- Session Ends form here ------------------------>

<?php  
	// Fetch total students
    $student_query = mysqli_query($con, "SELECT COUNT(*) AS total_students FROM student");
    $student_row = mysqli_fetch_array($student_query);
    $total_students = $student_row['total_students'];

    // Fetch total drives
    $drive_query = mysqli_query($con, "SELECT COUNT(*) AS total_drives FROM drive");
    $drive_row = mysqli_fetch_array($drive_query);
    $total_drives = $drive_row['total_drives'];

    // Fetch total applications
    $app_query = mysqli_query($con, "SELECT COUNT(*) AS total_applications FROM application");
    $app_row = mysqli_fetch_array($app_query);
    $total_applications = $app_row['total_applications'];

    // Fetch total placed students (assuming a 'status' column in students table)
    $placed_query = mysqli_query($con, "SELECT COUNT(*) AS placed_students FROM placement");
    $placed_row = mysqli_fetch_array($placed_query);
    $total_placed = $placed_row['placed_students'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include('../Common/header.php'); ?>
    <?php include('../Common/admin-sidebar.php'); ?>

    <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
        <div class="sub-main">
            <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                <div class="d-flex flex-row">
                    <div class="p-2"><h4>Admin Dashboard</h4></div>
                </div>
            </div>
            
            <!-- Statistic Cards -->
            <div class="row g-3 text-white mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-people-fill fs-1"></i>
                            <h5>Total Students</h5>
                            <p class="fs-4"><?php echo $total_students; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-briefcase-fill fs-1"></i>
                            <h5>Total Drives</h5>
                            <p class="fs-4"><?php echo $total_drives; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-check-fill fs-1"></i>
                            <h5>Applications</h5>
                            <p class="fs-4"><?php echo $total_applications; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-award-fill fs-1"></i>
                            <h5>Placed Students</h5>
                            <p class="fs-4"><?php echo $total_placed; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="card p-3 shadow-sm">
                        <h5 class="text-center">Branch Wise Placement Summary</h5>
                        <canvas id="applicationsChart" height="250"></canvas>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card p-3 shadow-sm">
                        <h5 class="text-center">Placement Summary</h5>
                        <canvas id="placementSummaryChart" height="250"></canvas>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card p-3 shadow-sm">
                        <h5 class="text-center">Placement Status</h5>
                        <canvas id="placementChart" height="250"></canvas>
                    </div> 
                </div>
            </div>
        </div>
    </main>
    <?php include('../Common/footer.php'); ?>

    <!-- Chart Scripts -->
    <script>
        const applicationsChart = new Chart(document.getElementById('applicationsChart'), {
            type: 'bar',
            data: {
                labels: ['CSE', 'ME', 'CE', 'EEE', 'ECE', 'MCA'],
                datasets: [{
                    label: 'Placed',
                    data: [50, 25, 30, 40, 10, 5],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Branch Wise Placement Summary' }
                }
            }
        });

        const placementChart = new Chart(document.getElementById('placementChart'), {
            type: 'pie',
            data: {
                labels: ['Placed', 'Not Placed'],
                datasets: [{
                    data: [900, 600],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: 'Placement Statistics' }
                }
            }
        });
        const placementSummaryChart = new Chart(document.getElementById('placementSummaryChart'), {
            type: 'bar',
            data: {
                labels: ["AY'2022", "AY'2023", "AY'2024"],
                datasets: [
                    {
                        label: 'Total Students Placed',
                        data: [210, 169, 242],
                        backgroundColor: '#2E86C1',
                        yAxisID: 'y',
                    },
                    {
                        label: 'No. of Offers',
                        data: [474, 316, 373],
                        backgroundColor: '#E67E22',
                        yAxisID: 'y',
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Overall Summary of Placement - YoY',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Students / Offers'
                        },
                        beginAtZero: true
                    },
                    y1: {
                        type: 'linear',
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Avg Offer per Student'
                        },
                        beginAtZero: true,
                        min: 0,
                        max: 3,
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });

    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>