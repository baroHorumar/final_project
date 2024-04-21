<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
include('../includes/jobs.php');
?>

<body>

    <!-- Preloader Start -->
    <header>

        <div class="content container-fluid">
            <div class="row">
                <!-- Add space on the left -->
                <!--  -->
                <!-- job post company Start -->
                <div class="job-post-company pt-120 pb-120">
                    <div class="container">
                        <div class="row justify-content-between">
                            <!-- Left Content -->
                            <div class="col-xl-3 col-lg-3 col-md-4">
                                <!-- Your sidebar content goes here -->

                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <!-- job single -->
                                <?php
                                $conn = new mysqli('localhost', 'root', '', 'alumnidb');
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                if (isset($_GET['post_id'])) {
                                    $post_id = $_GET['post_id'];
                                    $post_query = "SELECT * FROM jobs WHERE id = $post_id";
                                    $post_result = $conn->query($post_query);

                                    if ($post_result && $post_result->num_rows > 0) {
                                        $post = $post_result->fetch_assoc();
                                ?>
                                        <div class="single-job-items mb-50" style="background-color:aliceblue; border: 1px solid #E4E4E4;">
                                            <div class="job-items">
                                                <div class="company-img company-img-details">
                                                    <a href="#"><img src="<?php echo $post['image'] ?? ''; ?>" alt="company-img" style="max-width: 100px; max-height: 80px; min-width: 100px; min-height: 80px;"></a>
                                                </div>
                                                <div class="job-tittle">
                                                    <a href="#">
                                                        <h4><?= $post['job_title'] ?></h4>
                                                    </a>
                                                    <ul>
                                                        <li><?= $post['company'] ?></li>
                                                        <li><i class="fas fa-map-marker-alt"></i><?= $post['location'] ?></li>
                                                        <li>$3500 - $4000</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- job single End -->

                                        <div class="job-post-details">
                                            <div class="post-details1 mb-50">
                                                <!-- Small Section Tittle -->
                                                <div class="small-section-tittle">
                                                    <h4>Job Description</h4>
                                                </div>
                                                <p><?= $post['description'] ?></p>
                                            </div>
                                            <div class="post-details2  mb-50">
                                                <!-- Small Section Tittle -->
                                                <!-- <div class="small-section-tittle">
                                                    <h4>Required Knowledge, Skills, and Abilities</h4>
                                                </div>
                                                <ul>
                                                    <li>System Software Development</li>
                                                    <li>Mobile Applicationin iOS/Android/Tizen or other platform</li>
                                                    <li>Research and code , libraries, APIs and frameworks</li>
                                                    <li>Strong knowledge on software development life cycle</li>
                                                    <li>Strong problem solving and debugging skills</li>
                                                </ul> -->
                                            </div>
                                            <div class="post-details2  mb-50">
                                                <!-- Small Section Tittle -->
                                                <!-- <div class="small-section-tittle">
                                                    <h4>Education + Experience</h4>
                                                </div>
                                                <ul>
                                                    <li>3 or more years of professional design experience</li>
                                                    <li>Direct response email experience</li>
                                                    <li>Ecommerce website design experience</li>
                                                    <li>Familiarity with mobile and web apps preferred</li>
                                                    <li>Experience using Invision a plus</li>
                                                </ul> -->
                                            </div>
                                        </div>

                            </div>
                            <!-- Right Content -->
                            <div class="col-xl-3 col-lg-4">
                                <div class="post-details3  mb-50">
                                    <!-- Small Section Tittle -->
                                    <div class="small-section-tittle">
                                        <h4>Job Overview</h4>
                                    </div>
                                    <ul>
                                        <li>Posted date : <span><?= $post['created_at'] ?></span></li>
                                        <li>Location : <span><?= $post['location'] ?></span></li>
                                        <li>Vacancy :<span>02</span></li>
                                        <li>Job nature : <span>Full time</span></li>
                                        <li>Salary : <span>$7,800 yearly</span></li>
                                        <li>Application date : <span><?= $post['end_date'] ?></span></li>
                                    </ul>
                                    <div class="apply-btn2">
                                        <a href="<?= $post['apply_link'] ?>" class="btn">Apply Now</a>
                                    </div>
                                </div>
                                <div class="post-details4  mb-50">
                                    <!-- Small Section Tittle -->
                                    <div class="small-section-tittle">
                                        <h4>Company Information</h4>
                                    </div>
                                    <span><?= $post['company'] ?> </span>
                                    <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> -->
                                    <ul>
                                        <li>Name: <span><?= $post['company'] ?> </span></li>
                                        <li>Web : <span><?php echo $post['apply_link'] ?? ''; ?></span></li>
                                        <!-- <li>Email: <span>carrier.colorlib@gmail.com</span></li> -->
                                    </ul>
                                </div>
                        <?php
                                    } else {
                                        echo "<p>Post not found.</p>";
                                    }
                                } else {
                                    echo "<p>No post ID specified.</p>";
                                }
                        ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- job post company End -->

                </main>


</body>
<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>

<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php');
?>