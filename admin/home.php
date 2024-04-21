<?php
include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/conn.php';
// Qucontery to count all alumni in the alumni table
$sql = "SELECT COUNT(*) AS alumni_count FROM alumni";
// Execute the query
$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    // Retrieve the alumni count from the associative array
    $alumni_count = $row['alumni_count'];
    // Print the alumni count

} else {
    // If the query fails, print an error message
    echo "Error: " . mysqli_error($conn);
}

// Query to count all records in the blog table
$sql_blog = "SELECT COUNT(*) AS blog_count FROM blog";
$result_blog = mysqli_query($conn, $sql_blog);
$blog_count = 0;

if ($result_blog) {
    $row_blog = mysqli_fetch_assoc($result_blog);
    $blog_count = $row_blog['blog_count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

// Query to count all records in the jobs table
$sql_jobs = "SELECT COUNT(*) AS jobs_count FROM jobs";
$result_jobs = mysqli_query($conn, $sql_jobs);
$jobs_count = 0;

if ($result_jobs) {
    $row_jobs = mysqli_fetch_assoc($result_jobs);
    $jobs_count = $row_jobs['jobs_count'];
} else {
    echo "Error: " . mysqli_error($conn);
}
// Query to count all records in the materials table
$sql_materials = "SELECT COUNT(*) AS materials_count FROM materials";
$result_materials = mysqli_query($conn, $sql_materials);
$materials_count = 0;
if ($result_materials) {
    $row_materials = mysqli_fetch_assoc($result_materials);
    $materials_count = $row_materials['materials_count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$query = "SELECT * FROM alumni WHERE 1=1";
if (!empty($facultyFilter)) {
    $query .= " AND faculty_id = '$facultyFilter'";
}
if (!empty($batchFilter)) {
    $query .= " AND batch_id = '$batchFilter'";
}

// Execute the query
$result = mysqli_query($conn, $query);
// Close the database connection

?>
<style>
    .chart-container {
        position: relative;
        width: 100%;
        padding-bottom: 100%;
        /* Aspect ratio */
    }



    .category-names {
        text-align: center;
        margin-top: 10px;
        /* Adjust as needed */
    }
</style>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-1">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title">Alumni Number</div>
                                <div class="dash-counts text-center">
                                    <p><?php echo $alumni_count; ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-2">
                                <i class="fas fa-file-alt"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title text-center">Total Posts</div>
                                <div class="dash-counts text-center">
                                    <p><?php echo $blog_count; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-3">
                                <i class="fas fa-business-time"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title">Total Jobs</div>
                                <div class="dash-counts text-center">
                                    <p><?php echo $jobs_count; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-4">
                                <i class="fas fa-folder"></i>
                            </span>
                            <div class="dash-count">
                                <div class="dash-title ">Total Resources</div>
                                <div class="dash-counts text-center">
                                    <p><?php echo $materials_count; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Employment Status of Alumni</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="alumni"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Blogs Categories</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="myPlot"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Login Counts for the Last 15 Days</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="last_login"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Login Of The Year</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Enrollment Year</th>
                                        <th>Faculty</th>
                                        <th>Batch</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Loop through each row of the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><a href="view-estimate.html"><?php echo $row['Id']; ?></a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.php?alumni_id=<?= $row['Id'] ?>"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="<?php echo appURL; ?>/assets/img/sawir/one.jpg" alt="User Image"> <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></a>
                                                </h2>
                                            </td>
                                            <td><?php echo $row['EnrollmentYear']; ?></td>
                                            <td>
                                                <?php
                                                // Fetch faculty name based on faculty_id
                                                $facultyId = $row['faculty_id'];
                                                $facultyQuery = "SELECT name FROM faculties WHERE faculty_id = $facultyId";
                                                $facultyResult = mysqli_query($conn, $facultyQuery);

                                                if ($facultyData = mysqli_fetch_assoc($facultyResult)) {
                                                    echo $facultyData['name'];
                                                } else {
                                                    echo "Unknown Faculty"; // If faculty name not found
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $row['batch_id']; ?></td>
                                            <?php if ($row['empl_state'] == 'Employed') {
                                                $color = 'success';
                                            } else {
                                                $color = 'warning';
                                            } ?>
                                            <td><span class="badge bg-<?php echo $color; ?>-light"><?php echo $row['empl_state']; ?></span></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <form action="./edit_alumni.php" method="post">
                                                            <input type="hidden" name="edit_alumni" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </button>
                                                        </form>
                                                        <form action="alumni.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="delete_alumni" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </button>
                                                        </form>

                                                        <form action="./profile.php" method="post">
                                                            <input type="hidden" name="profile" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-eye me-2"></i>View
                                                            </button>
                                                        </form>
                                                        </form>
                                                        <form action="./chat.php" method="post">
                                                            <input type="hidden" name="edit_user" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-paper-plane me-2"></i>Chat
                                                            </button>
                                                        </form>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="../assets/plugins/apexchart/chart-data.js"></script>
<script src="../assets/plugins/apexchart/plotly-latest.min.js"></script>
<script src="../assets/plugins/apexchart/cansav.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    // Fetch data from PHP script
    fetch('../includes/counter.php')
        .then(response => response.json())
        .then(data => {
            const xArray = data.map(item => item.category);
            const yArray = data.map(item => item.percentage);

            const layout = {
                title: ""
            };

            const pieData = [{
                labels: xArray,
                values: yArray,
                type: "pie"
            }];

            Plotly.newPlot("myPlot", pieData, layout);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
</script>
<script>
    $(document).ready(function() {
        // Fetch data from PHP script
        $.ajax({
            url: '../includes/alumni_employment.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const xArray = ["Employed", "Unemployed"]; // Assuming these are the categories
                const yArray = [response.employed, response.unemployed];

                const layout = {
                    title: ""
                };

                const data = [{
                    labels: xArray,
                    values: yArray,
                    hole: .5,
                    type: "pie"
                }];

                Plotly.newPlot("alumni", data, layout);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    });
</script>
<script>
    // Fetch login counts data from PHP script
    fetch('../includes/login_counts.php')
        .then(response => response.json())
        .then(data => {
            // Define month names
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            // Extract counts for each month
            const counts = monthNames.map((month, index) => data[index + 1]);

            // Create Chart.js chart
            new Chart("myChart", {
                type: "line",
                data: {
                    labels: monthNames,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: counts
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching login counts:', error);
        });
</script>
<script>
    // Fetch login counts data from PHP script
    fetch('../includes/last15_counts.php')
        .then(response => response.json())
        .then(data => {
            // Extract day numbers and counts from the JSON data
            const days = Object.keys(data).map(date => new Date(date).getDate());
            const counts = Object.values(data);
            const barColors = [
                "rgb(255, 105, 180)", // Hot Pink
                "rgb(30, 144, 255)", // Dodger Blue
                "rgb(0, 255, 127)", // Spring Green
                "rgb(255, 215, 0)", // Gold
                "rgb(139, 0, 139)", // Dark Magenta
                "rgb(255, 69, 0)", // Red-Orange
                "rgb(255, 165, 0)", // Orange
                "rgb(32, 178, 170)", // Light Sea Green
                "rgb(128, 0, 128)", // Purple
                "rgb(218, 112, 214)", // Orchid
                "rgb(0, 255, 255)", // Cyan
                "rgb(128, 128, 0)", // Olive
                "rgb(75, 0, 130)", // Indigo
                "rgb(255, 20, 147)", // Deep Pink
                "rgb(245, 222, 179)" // Wheat
            ];


            // Create Chart.js chart
            new Chart("last_login", {
                type: "bar",
                data: {
                    labels: days,
                    datasets: [{
                        backgroundColor: barColors,
                        data: counts
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: ""
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching login counts:', error);
        });
</script>
</body>

</html>