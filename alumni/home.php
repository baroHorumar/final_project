<?php
include '../includes/alumni_header.php';
include '../includes/alumni_navbar.php';
include '../includes/conn.php';

// Assuming $conn is your database connection variable

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
  echo $alumni_count;
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
mysqli_close($conn);
?>

<main class="main" id="top">
  <div class="preloader" id="preloader">
    <div class="loader">
      <div class="line-scale">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </div>
  <section class="py-0">
    <div class="swiper theme-slider min-vh-100" data-swiper='{"loop":true,"allowTouchMove":false,"autoplay":{"delay":5000},"effect":"fade","speed":800}'>
      <div class="swiper-wrapper">
        <div class="swiper-slide" data-zanim-timeline="{}">
          <div class="bg-holder" style="background-image:url(assets/img/leader.jpg);"></div>
          <!--/.bg-holder-->
          <div class="container">
            <div class="row min-vh-100 py-8 align-items-center" data-inertia='{"weight":1.5}'>
              <div class="col-sm-8 col-lg-7 px-5 px-sm-3">
                <div class="overflow-hidden">
                  <h1 class="fs-4 fs-md-5 lh-1 text-warning" data-zanim-xs='{"delay":0}'>Helping Leaders</h1>
                </div>
                <div class="overflow-hidden">
                  <p class="text-white pt-4 mb-5 fs-1 fs-md-2 lh-xs" data-zanim-xs='{"delay":0.1}'>We look forward to assisting you in reaching new heights in your career and knowledge, alongside our esteemed alumni community</p>
                </div>
                <div class="overflow-hidden">
                  <div data-zanim-xs='{"delay":0.2}'><a class="btn btn-primary me-3 mt-3" href="#!">Read more<span class="fas fa-chevron-right ms-2"></span></a><a class="btn btn-warning mt-3" href="contact.php">Contact us<span class="fas fa-chevron-right ms-2"></span></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide" data-zanim-timeline="{}">
          <div class="bg-holder" style="background-image:url(assets/img/eu-slider.jpg);"></div>
          <!--/.bg-holder-->
          <div class="container">
            <div class="row min-vh-100 py-8 align-items-center" data-inertia='{"weight":1.5}'>
              <div class="col-sm-8 col-lg-7 px-5 px-sm-3">
                <div class="overflow-hidden">
                  <h1 class="fs-4 fs-md-5 lh-1 text-warning text-center" data-zanim-xs='{"delay":0}'>Join Our Alumni Network</h1>
                </div>
                <div class="overflow-hidden">
                  <p class="text-primary pt-4 mb-5 fs-1 fs-md-2 lh-xs text-white" data-zanim-xs='{"delay":0.1}'>Embark on a journey of lifelong connections, mentorship, and opportunities by becoming a part of our vibrant alumni community.</p>
                </div>
                <div class="overflow-hidden">
                  <div data-zanim-xs='{"delay":0.2}'><a class="btn btn-primary me-3 mt-3" href="#!">Read more<span class="fas fa-chevron-right ms-2"></span></a><a class="btn btn-warning mt-3" href="contact.php">Contact us<span class="fas fa-chevron-right ms-2"></span></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide" data-zanim-timeline="{}">
          <div class="bg-holder" style="background-image:url(assets/img/students.jpg);"></div>
          <!--/.bg-holder-->
          <div class="container">
            <div class="row min-vh-100 py-8 align-items-center" data-inertia='{"weight":1.5}'>
              <div class="col-sm-8 col-lg-7 px-5 px-sm-3">
                <div class="overflow-hidden">
                  <div>
                    <h1 class="fs-4 fs-md-5 lh-1 text-warning text-center" data-zanim-xs='{"delay":0}'>Forge Bonds: Our Unity Hub</h1>
                  </div>
                  <div class="overflow-hidden">
                    <p class="text-primary pt-4 mb-5 fs-1 fs-md-2 lh-xs text-white" data-zanim-xs='{"delay":0.1}'>Rediscover the vibrant community where bonds are rekindled, connections are reignited, and unity thrives once more</p>
                  </div>

                  <div class="overflow-hidden">
                    <div data-zanim-xs='{"delay":0.2}'><a class="btn btn-primary me-3 mt-3" href="#!">Read more<span class="fas fa-chevron-right ms-2"></span></a><a class="btn btn-warning mt-3" href="contact.php">Contact us<span class="fas fa-chevron-right ms-2"></span></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-nav">
          <div class="swiper-button-prev"><span class="fas fa-chevron-left"></span></div>
          <div class="swiper-button-next"><span class="fas fa-chevron-right"></span></div>
        </div>
      </div>
  </section>
  <section class="bg-100 mt-0 section-margin">
    <div class="container">
      <div class="text-center mb-1">
        <h3 class="fs-2 fs-md-3">Latest News</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/9.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>Tax impacts of lease mean accounting change</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Paul O'Sullivan</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>HMRC released a consultation document to flag some potential tax impacts that a forthcoming change...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/10.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>What brexit means for data protection law</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Enrico Ambrosi</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>Assuming that the referendum is not ignored completely, there are two possible futures for the UK...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/11.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>The growing meanace of social engineering fraud</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Robson</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>Social engineering involves the collection of information from various sources about a target...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <section class="bg-100 mt-0 section-margin">
    <div class="container">
      <div class="text-center mb-1">
        <h3 class="fs-2 fs-md-3">Latest Jobs</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/9.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>Tax impacts of lease mean accounting change</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Paul O'Sullivan</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>HMRC released a consultation document to flag some potential tax impacts that a forthcoming change...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/10.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>What brexit means for data protection law</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Enrico Ambrosi</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>Assuming that the referendum is not ignored completely, there are two possible futures for the UK...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/11.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>The growing meanace of social engineering fraud</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Robson</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>Social engineering involves the collection of information from various sources about a target...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <section class="bg-100 mt-0">
    <div class="container mt-0">
      <div class="text-center mb-1">
        <h3 class="fs-2 fs-md-3">Latest Resource</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/9.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>Tax impacts of lease mean accounting change</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Paul O'Sullivan</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>HMRC released a consultation document to flag some potential tax impacts that a forthcoming change...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/10.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>What brexit means for data protection law</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Enrico Ambrosi</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>Assuming that the referendum is not ignored completely, there are two possible futures for the UK...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"><a href="news/news.html"><img class="card-img-top" src="assets/img/11.jpg" alt="Featured Image" /></a>
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden"><a href="news/news.html">
                  <h5 data-zanim-xs='{"delay":0}'>The growing meanace of social engineering fraud</h5>
                </a></div>
              <div class="overflow-hidden">
                <p class="text-500" data-zanim-xs='{"delay":0.1}'>By Robson</p>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.2}'>Social engineering involves the collection of information from various sources about a target...</p>
              </div>
              <div class="overflow-hidden">
                <div class="d-inline-block" data-zanim-xs='{"delay":0.3}'><a class="d-flex align-items-center" href="news/news.html">Learn More<div class="overflow-hidden ms-2" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'><span class="d-inline-block fw-medium">&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
</main><!-- ===============================================-->

<footer class="footer bg-primary text-center py-4">
  <div class="container">
    <div class="row align-items-center opacity-85 text-white">
      <div class="col text-sm-start mt-3 mt-sm-0">
        <span class="fw-semi-bold">
          <a href="index.php" class="text-white">EU Alumni System</a>
        </span>
      </div>

      <div class="col-sm-6 mt-3 mt-sm-0">
        <ul class="list-unstyled d-flex justify-content-center justify-content-sm-start mb-0">
          <li class="me-3"><a class="text-decoration-none text-white" href="#!"><span class="fab fa-linkedin-in"></span> Linkedin</a></li>
          <li class="me-3"><a class="text-decoration-none text-white" href="#!"><span class="fab fa-twitter"></span> Twitter</a></li>
          <li class="me-3"><a class="text-decoration-none text-white" href="#!"><span class="fab fa-facebook-f"></span> Facebook</a></li>
          <li><a class="text-decoration-none text-white" href="#!"><span class="fab fa-google-plus-g"></span> Google+</a></li>
        </ul>
      </div>
      <div class="col text-sm-end mt-3 mt-sm-0"><span class="fw-semi-bold">Designed by </span class="text-white"> Group 1</div>
    </div>
  </div>
</footer>


<script src="vendors/popper/popper.min.js"></script>
<script src="vendors/bootstrap/bootstrap.min.js"></script>
<script src="vendors/is/is.min.js"></script>
<script src="vendors/bigpicture/BigPicture.js"> </script>
<script src="vendors/countup/countUp.umd.js"> </script>
<script src="vendors/swiper/swiper-bundle.min.js"></script>
<script src="vendors/fontawesome/all.min.js"></script>
<script src="vendors/lodash/lodash.min.js"></script>
<script src="vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="vendors/gsap/gsap.js"></script>
<script src="vendors/gsap/customEase.js"></script>
<script src="assets/js/theme.js"></script>
</body>

</html>