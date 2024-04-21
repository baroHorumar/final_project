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



// Close the database connection
mysqli_close($conn);
?>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
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

  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-white text-center">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-10 col-md-6">
          <h3 class="fs-2 fs-lg-3">Welcome To The EU Alumni Network!</h3>
          <p class="px-lg-4 mt-3">
            Experience Tailored Guidance and Lifelong Support with EU Alumni, Your Trusted Companion in Your Continued Journey</p>
          <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
        </div>
      </div>
      <div class="row mt-4 mt-md-5">
        <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-users"></span></div>
          <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Networking</h5>
          <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Connect with fellow alumni to expand your professional network.</p>
        </div>
        <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-chalkboard-teacher"></span></div>
          <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Mentorship</h5>
          <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Benefit from the guidance and support of experienced alumni mentors.</p>
        </div>
        <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-book"></span></div>
          <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Continuous Learning</h5>
          <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Engage in lifelong learning opportunities to enhance your skills and knowledge.</p>
        </div>
        <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-chart-line"></span></div>
          <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Professional Growth</h5>
          <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Advance your career and personal development with the support of our alumni community.</p>
        </div>
      </div>

    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="pt-0">
    <div class="container">
      <div class="row flex-center text-center pb-6">

        <div class="col-12">
          <div class="position-relative mt-4 py-5 py-md-11">
            <div class="bg-holder rounded-3" style="background-image:url(assets/img/eelo.jpg);"></div>
            <!--/.bg-holder-->
            <!-- Removed video tag and replaced with a picture -->
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-4 mt-3 mt-lg-0 px-4 px-sm-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <h5 data-zanim-xs='{"delay":0}'><span class="text-primary me-3 fas fa-handshake"></span>Collaborative Community</h5>
          <p class="mt-3 pe-3 pe-lg-5" data-zanim-xs='{"delay":0.1}'>Join our alumni network to collaborate with like-minded individuals and leverage collective knowledge.</p>
        </div>
        <div class="col-sm-6 col-lg-4 mt-3 mt-lg-0 px-4 px-sm-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <h5 data-zanim-xs='{"delay":0}'><span class="text-primary me-3 fas fa-hands-helping"></span>Dedicated Support</h5>
          <p class="mt-3 pe-3 pe-lg-5" data-zanim-xs='{"delay":0.1}'>Our alumni community offers dedicated support and guidance to assist you in your endeavors.</p>
        </div>
        <div class="col-sm-6 col-lg-4 mt-3 mt-lg-0 px-4 px-sm-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <h5 data-zanim-xs='{"delay":0}'><span class="text-primary me-3 fas fa-graduation-cap"></span>Lifelong Learning</h5>
          <p class="mt-3 pe-3 pe-lg-5" data-zanim-xs='{"delay":0.1}'>Experience continuous growth and development through our platform's focus on lifelong learning.</p>
        </div>
      </div>

    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-100">
    <div class="container">
      <div class="text-center mb-6">
        <h3 class="fs-2 fs-md-3">Our Alumni Offerings</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row g-0 position-relative mb-4 mb-lg-0">
        <div class="col-lg-6 py-3 py-lg-0 mb-0 position-relative" style="min-height:400px;">
          <div class="bg-holder rounded-ts-lg rounded-te-lg rounded-lg-te-0  " style="background-image:url(assets/img/cover.png);"></div>
          <!--/.bg-holder-->
        </div>
        <div class="col-lg-6 px-lg-5 py-lg-6 p-4 my-lg-0 bg-white rounded-bs-lg rounded-lg-bs-0 rounded-be-lg rounded-lg-be-0 rounded-lg-te-lg ">
          <div class="elixir-caret d-none d-lg-block"> </div>
          <div class="d-flex align-items-center h-100">
            <div data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Knowledge Exchange</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.1}'>Join our vibrant EU alumni community dedicated to continuous learning and knowledge sharing. Contribute your insights to enrich our collective knowledge and empower each member to thrive professionally. Discover growth opportunities, connect with like-minded individuals, and stay ahead in your field with our dynamic network</p>
              </div>
              <div class="overflow-hidden">
                <div data-zanim-xs='{"delay":0.2}'><a class="d-flex align-items-center" href="#!">Learn More<div class="overflow-hidden ms-2"><span class="d-inline-block" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'>&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-0 position-relative mb-4 mb-lg-0">
        <div class="col-lg-6 py-3 py-lg-0 mb-0 position-relative order-lg-2" style="min-height:400px;">
          <div class="bg-holder rounded-ts-lg rounded-te-lg rounded-lg-te-0  rounded-lg-ts-0" style="background-image:url(assets/img/jobs.jpg);"></div>
          <!--/.bg-holder-->
        </div>
        <div class="col-lg-6 px-lg-5 py-lg-6 p-4 my-lg-0 bg-white rounded-bs-lg rounded-lg-bs-0 rounded-be-lg  rounded-lg-be-0">
          <div class="elixir-caret d-none d-lg-block"></div>
          <div class="d-flex align-items-center h-100">
            <div data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Explore Career Opportunities </h5>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3" data-zanim-xs='{"delay":0.1}'>Explore diverse career opportunities with our EU alumni network. From startups to renowned corporations, discover job openings across industries. Benefit from collective expertise to advance confidently. Join us for growth and success.</p>
              </div>
              <div class="overflow-hidden">
                <div data-zanim-xs='{"delay":0.2}'><a class="d-flex align-items-center" href="#!">Learn More<div class="overflow-hidden ms-2"><span class="d-inline-block" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'>&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-0 position-relative mb-4 mb-lg-0">
        <div class="col-lg-6 py-3 py-lg-0 mb-0 position-relative" style="min-height:400px;">
          <div class="bg-holder rounded-ts-lg rounded-te-lg rounded-lg-te-0 rounded-lg-ts-0 rounded-bs-0 rounded-lg-bs-lg " style="background-image:url(assets/img/learning.png);"></div>
          <!--/.bg-holder-->
        </div>
        <div class="col-lg-6 px-lg-5 py-lg-6 p-4 my-lg-0 bg-white rounded-bs-lg rounded-lg-bs-0 rounded-be-lg  ">
          <div class="elixir-caret d-none d-lg-block"></div>
          <div class="d-flex align-items-center h-100">
            <div data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Empower Your Learning Journey</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mt-3 text-center" data-zanim-xs='{"delay":0.1}'>Unlock a World of Learning Opportunities with EU Alumni: Immerse Yourself in a Wealth of Educational Resources to Enhance Your Skills, Gain New Insights, and Stay Ahead in Your Field</p>
              </div>
              <div class="overflow-hidden">
                <div data-zanim-xs='{"delay":0.2}'><a class="d-flex align-items-center" href="#!">Learn More<div class="overflow-hidden ms-2"><span class="d-inline-block" data-zanim-xs='{"from":{"opacity":0,"x":-30},"to":{"opacity":1,"x":0},"delay":0.8}'>&xrarr;</span></div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-7">
        <div class="col-sm-6 col-lg-4 px-4 px-sm-3 mb-4 mb-lg-0" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <h5 data-zanim-xs='{"delay":0}'><span class="text-primary fs-0 me-3 far fa-comments"></span>Discussion Forums</h5>
          <p class="mt-3 pe-3 pe-lg-5 mb-0" data-zanim-xs='{"delay":0.1}'>Engage with fellow alumni, share insights, and keep up with alumni events. <a href='#!'>Join Forum <span class='fas fa-external-link-alt ms-1'></span></a></p>
        </div>
        <div class="col-sm-6 col-lg-4 px-4 px-sm-3 mb-4 mb-lg-0" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <h5 data-zanim-xs='{"delay":0}'><span class="text-primary fs-0 me-3 fas fa-comment-alt"></span>Chat with profess</h5>
          <p class="mt-3 pe-3 pe-lg-5 mb-0" data-zanim-xs='{"delay":0.1}'>Connect with industry professionals, exchange ideas, and explore career opportunities. <a href='#!'>Start chatting <span class='fas fa-external-link-alt ms-1'></span></a></p>
        </div>
        <div class="col-sm-6 col-lg-4 px-4 px-sm-3 mb-4 mb-lg-0" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <h5 data-zanim-xs='{"delay":0}'><span class="text-primary fs-0 me-3 fas fa-phone-alt"></span>Contact Alumni Office</h5>
          <p class="mt-3 pe-3 pe-lg-5 mb-0" data-zanim-xs='{"delay":0.1}'>Reach out to the alumni office for support, resources, and alumni benefits.</p>
        </div>
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section>
    <div class="container">
      <div class="text-center mb-7">
        <h3 class="fs-2 fs-md-3">Why You Need To Join Us</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row">
        <div class="col-lg-6 pe-lg-3"><img class="rounded-3 img-fluid" src="assets/img/eu-logo.jpg" alt="about" /></div>
        <div class="col-lg-6 px-lg-5 mt-6 mt-lg-0" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="overflow-hidden">
            <div class="px-4 px-sm-0" data-zanim-xs='{"delay":0}'>
              <h5 class="fs-0 fs-lg-1"><span class="fas fa-comment-dots fs-1 me-2" data-fa-transform="flip-h"></span>Reconnect with Professionals</h5>
              <p class="mt-3">Join us as we bring together esteemed alumni, offering a platform to reconnect, network, and reminisce about shared experiences from our time at the university.</p>
            </div>
          </div>
          <div class="overflow-hidden">
            <div class="px-4 px-sm-0 mt-5" data-zanim-xs='{"delay":0}'>
              <h5 class="fs-0 fs-lg-1"><span class="fas fa-palette fs-1 me-2" data-fa-transform="shrink-1"></span>Revive Fond Memories</h5>
              <p class="mt-3">Take a trip down memory lane as we revisit cherished moments and milestones, celebrating the bonds forged during our academic journey and beyond.</p>
            </div>
          </div>
          <div class="overflow-hidden">
            <div class="px-4 px-sm-0 mt-5" data-zanim-xs='{"delay":0}'>
              <h5 class="fs-0 fs-lg-1"><span class="fas fa-stopwatch fs-1 me-2" data-fa-transform="grow-1"></span>Guidance and Support</h5>
              <p class="mt-3">Whether you seek career advice, professional development opportunities, or simply wish to reconnect with old friends, our alumni network is here to support you, 24/7.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-primary py-6 text-center text-md-start">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md">
          <h4 class="text-white text-center mb-0">Unlock a world of exclusive content, networking, and career opportunities! <br class="d-md-none" />Log in now.</h4>
        </div>
        <div class="col-md-auto mt-md-0 mt-4"><a class="btn btn-light rounded-pill" href="login.html">Log In</a></div>
      </div>

    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="text-center">
    <div class="container">
      <div class="text-center">
        <h3 class="fs-2 fs-md-3">Things You Get</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="px-3 py-4 px-lg-4">
            <div class="overflow-hidden"><img src="assets/img/icons/sharing.png" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
            <div class="overflow-hidden">
              <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Memorable Connections</h5>
            </div>
            <div class="overflow-hidden">
              <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Reconnect with fellow alumni, reminiscing about shared experiences and forming lasting bonds beyond the campus.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="px-3 py-4 px-lg-4">
            <div class="overflow-hidden"><img src="assets/img/icons/mail.png" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
            <div class="overflow-hidden">
              <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Shared Discussion</h5>
            </div>
            <div class="overflow-hidden">
              <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Join us as we offer a platform to relive cherished moments, celebrate academic achievements, and share in the adventures of our alumni family!</p>
            </div>
          </div>

        </div>
        <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="px-3 py-4 px-lg-4">
            <div class="overflow-hidden"><img src="assets/img/icons/target.png" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
            <div class="overflow-hidden">
              <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Continuous Support</h5>
            </div>
            <div class="overflow-hidden">
              <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Our alumni community provides ongoing support, guidance, and mentorship to empower each other's personal and professional growth.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="px-3 py-4 px-lg-4">
            <div class="overflow-hidden"><img src="assets/img/analytics.png" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
            <div class="overflow-hidden">
              <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Market Insights</h5>
            </div>
            <div class="overflow-hidden">
              <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Explore valuable market insights and trends through our alumni network, providing you with the latest information to make informed decisions in your industry.</p>
            </div>
          </div>

        </div>
        <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="px-3 py-4 px-lg-4">
            <div class="overflow-hidden"><img src="assets/img/icons/data-analytics.png" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
            <div class="overflow-hidden">
              <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Professional Development</h5>
            </div>
            <div class="overflow-hidden">
              <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Access exclusive Content, Resources, and networking events aimed at enhancing your skills and advancing your career.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="px-3 py-4 px-lg-4">
            <div class="overflow-hidden"><img src="assets/img/teamwork.png" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
            <div class="overflow-hidden">
              <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Collaborative Opportunities</h5>
            </div>
            <div class="overflow-hidden">
              <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Unlock collaborative possibilities and harness our collective potential!</p>
            </div>
          </div>

        </div>
      </div>
    </div><!-- end of .container-->
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <!-- <section class="bg-primary">
    <div class="container">
      <div class="row align-items-center text-white">
        <div class="col-lg-4">
          <div class="border border-2 border-warning p-4 py-lg-5 text-center rounded-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="overflow-hidden">
              <h4 class="text-white" data-zanim-xs='{"delay":0}'>Request a call back</h4>
            </div>
            <div class="overflow-hidden">
              <p class="px-lg-1 text-100 mb-0" data-zanim-xs='{"delay":0.1}'>Would you like to speak to one of our financial advisers over the phone? Just submit your details and we’ll be in touch shortly. You can also email us if you would prefer.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8 ps-lg-5 mt-6 mt-lg-0">
          <h5 class="text-white">I would like to discuss:</h5>
          <form class="mt-4" method="post">
            <div class="row">
              <div class="col-6"><input class="form-control" type="hidden" name="to" value="username@domain.extension" /><input class="form-control" type="text" placeholder="Your Name" aria-label="Your Name" /></div>
              <div class="col-6"><input class="form-control" type="text" placeholder="Phone Number" aria-label="Phone Number" /></div>
              <div class="col-6 mt-4"><input class="form-control" type="text" placeholder="Subject" aria-label="Subject" /></div>
              <div class="col-6 mt-4"><button class="btn btn-warning w-100" type="submit">Submit</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
   -->
  <!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <!-- <section class="bg-100 text-center">
    <div class="container">
      <div class="text-center mb-6">
        <h3 class="fs-2 fs-md-3">Global leadership</h3>
        <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-4    ">
          <div class="card h-100"><img class="card-img-top" src="assets/img/portrait-3.jpg" alt="Reenal Scott" />
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Reenal Scott</h5>
              </div>
              <div class="overflow-hidden">
                <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'>Advertising Consultant</h6>
              </div>
              <div class="overflow-hidden">
                <p class="py-3 mb-0" data-zanim-xs='{"delay":0.2}'>Reenal Scott is the Founder and CEO of Elixir, which he started from his dorm room in 2013 with 3 people only.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mt-4 mt-sm-0  ">
          <div class="card h-100"><img class="card-img-top" src="assets/img/portrait-4.jpg" alt="Lily Anderson" />
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Lily Anderson</h5>
              </div>
              <div class="overflow-hidden">
                <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'>Activation Consultant</h6>
              </div>
              <div class="overflow-hidden">
                <p class="py-3 mb-0" data-zanim-xs='{"delay":0.2}'>Lily leads Elixir UK and oversees the company’s Customer Operations teams supporting millions ofr users.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mt-4  mt-lg-0 ">
          <div class="card h-100"><img class="card-img-top" src="assets/img/portrait-5.jpg" alt="Thomas Anderson" />
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Thomas Anderson</h5>
              </div>
              <div class="overflow-hidden">
                <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'>Change Management Consultant</h6>
              </div>
              <div class="overflow-hidden">
                <p class="py-3 mb-0" data-zanim-xs='{"delay":0.2}'>As the VP of People, Thomas’s focus lies in the development and optimization of talent retention.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mt-4   ">
          <div class="card h-100"><img class="card-img-top" src="assets/img/portrait-6.jpg" alt="Legartha Mantana" />
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Legartha Mantana</h5>
              </div>
              <div class="overflow-hidden">
                <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'>Brand Management Consultant</h6>
              </div>
              <div class="overflow-hidden">
                <p class="py-3 mb-0" data-zanim-xs='{"delay":0.2}'>As General Counsel of Elixir, Tony oversees global legal activities and policies across all aspects.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mt-4   ">
          <div class="card h-100"><img class="card-img-top" src="assets/img/portrait-7.jpg" alt="John Snow" />
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>John Snow</h5>
              </div>
              <div class="overflow-hidden">
                <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'>Business Analyst</h6>
              </div>
              <div class="overflow-hidden">
                <p class="py-3 mb-0" data-zanim-xs='{"delay":0.2}'>John has overseen the meteoric growth while protecting scaling its uniquely creative and culture.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mt-4   ">
          <div class="card h-100"><img class="card-img-top" src="assets/img/portrait-1.jpg" alt="Ragner Lothbrok" />
            <div class="card-body" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h5 data-zanim-xs='{"delay":0}'>Ragner Lothbrok</h5>
              </div>
              <div class="overflow-hidden">
                <h6 class="fw-normal text-500" data-zanim-xs='{"delay":0.1}'>Business Consultant</h6>
              </div>
              <div class="overflow-hidden">
                <p class="py-3 mb-0" data-zanim-xs='{"delay":0.2}'>Ragner, SVP of Engineering, oversees Elixir’s vast engineering organization which drives the core programming.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->


  <!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section>
    <div class="bg-holder overlay overlay-elixir" style="background-image:url(assets/img/background-15.jpg);"></div>
    <!--/.bg-holder-->
    <div class="container">
      <div class="d-flex"><span class="me-3"> <img src="assets/img/checkmark.png" alt="checkmark" style="width: 55px" /></span>
        <div class="flex-1">
          <h2 class="text-warning fs-3 fs-lg-4">Join our Alumni Network, <br /><span class="text-white">Take the Next Big Step.</span></h2>
          <div class="row mt-4 pe-lg-10">
            <div class="overflow-hidden col-md-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="fs-3 fs-lg-4 mb-0 fw-bold text-white text-center  mt-lg-5 mt-3 lh-xs" data-zanim-xs='{"delay":0.1}' data-countup='{"endValue":<?php echo $alumni_count; ?>}'><?php echo $alumni_count; ?></div>
              <h6 class="fs-0 text-white text-center" data-zanim-xs='{"delay":0.2}'>Alumni Number</h6>
            </div>
            <div class="overflow-hidden col col-lg-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="fs-3 fs-lg-4 mb-0 fw-bold text-white text-center mt-lg-5 mt-3 lh-xs" data-zanim-xs='{"delay":0.1}' data-countup='{"endValue":<?php echo $blog_count; ?>}'><?php echo $blog_count; ?></div>
              <h6 class="fs-0 text-white text-center" data-zanim-xs='{"delay":0.2}'>Educational Blogs</h6>
            </div>
            <div class="w-100 d-flex d-lg-none"></div>
            <div class="overflow-hidden col-md-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="fs-3 fs-lg-4 mb-0 text-center fw-bold text-white mt-lg-5 mt-3 lh-xs" data-zanim-xs='{"delay":0.1}' data-countup='{"endValue":<?php echo $jobs_count; ?>}'><?php echo $jobs_count; ?></div>
              <h6 class="fs-0 text-white text-center" data-zanim-xs='{"delay":0.2}'>Posted Jobs</h6>
            </div>
            <div class="overflow-hidden col col-lg-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="fs-3 fs-lg-4 mb-0 fw-bold text-white text-center mt-lg-5 mt-3 lh-xs" data-zanim-xs='{"delay":0.1}' data-countup='{"endValue":<?php echo $materials_count; ?>}'><?php echo $materials_count; ?></div>
              <h6 class="fs-0 text-white text-center" data-zanim-xs='{"delay":0.2}'>Learning Resources</h6>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-white">
    <div class="container">
      <div class="swiper theme-slider" data-swiper='{"loop":true,"slidesPerView":1,"autoplay":{"delay":5000}}'>
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="row px-lg-8">
              <div class="col-4 col-md-3 mx-auto"><img class="rounded-3 mx-auto img-fluid" src="assets/img/client1.png" alt="Member" /></div>
              <div class="col-md-9 mt-4 mt-md-0 px-4 px-sm-3">
                <p class="lead">The implementation of the alumni management system revolutionized our engagement strategies. We've witnessed a remarkable 50% increase in alumni participation, fostering stronger connections and opportunities for collaboration.</p>
                <h6 class="fs-0 mb-1 mt-4">John Doe</h6>
                <p class="mb-0 text-500">CEO, ABC University</p>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="row px-lg-8">
              <div class="col-4 col-md-3 mx-auto"><img class="rounded-3 mx-auto img-fluid" src="assets/img/client2.png" alt="Member" /></div>
              <div class="col-md-9 mt-4 mt-md-0 px-4 px-sm-3">
                <p class="lead">Our alumni management system streamlined our communication channels and enhanced alumni engagement. Through targeted outreach and personalized interactions, we've seen a 60% increase in alumni event attendance and donations.</p>
                <h6 class="fs-0 mb-1 mt-4">Jane Smith</h6>
                <p class="mb-0 text-500">Director of Alumni Relations, XYZ College</p>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="row px-lg-8">
              <div class="col-4 col-md-3 mx-auto"><img class="rounded-3 mx-auto img-fluid" src="assets/img/client3.png" alt="Member" /></div>
              <div class="col-md-9 mt-4 mt-md-0 px-4 px-sm-3">
                <p class="lead">Implementing an alumni management system was a game-changer for us. It allowed us to nurture lifelong relationships with our alumni community, resulting in increased volunteerism, mentorship opportunities, and philanthropic support.</p>
                <h6 class="fs-0 mb-1 mt-4">Emily Johnson</h6>
                <p class="mb-0 text-500">Director of Alumni Engagement, University of ABC</p>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-nav">
          <div class="swiper-button-prev icon-item icon-item-lg"><span class="fas fa-chevron-left fs--2"></span></div>
          <div class="swiper-button-next icon-item icon-item-lg"><span class="fas fa-chevron-right fs--2"></span></div>
        </div>
      </div>
    </div><!-- end of .container-->
  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->
  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-100">
    <div class="container">
      <div class="text-center mb-2">
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
  <!-- ============================================-->

</main><!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->



<!--===============================================-->
<!--    Footer-->
<!--===============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->

<!-- ============================================-->

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