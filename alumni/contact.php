<?php
session_start();
require '../includes/alumni_header.php';
require '../includes/alumni_navbar.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  // Check if all required fields are filled
  if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      // Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                   // Disable debug output
      $mail->isSMTP();                                      // Send using SMTP
      $mail->Host = 'smtp.gmail.com';                        // Set the SMTP server to send through
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'barohuromar@gmail.com';            // SMTP username (your Gmail address)
      $mail->Password = 'mixi kvbs qevn ijys';              // SMTP password (your app-specific password)
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port = 465;                                    // TCP port to connect to

      // Recipients
      $mail->addAddress('barohuromar@gmail.com'); // Set recipient's email and name
      $mail->setFrom(
        $_POST['email'],
        $_POST['name']
      ); // Set sender's email and name
      $mail->addReplyTo($_POST['email'], $_POST['name']);
      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Message from your website';
      $mail->Body = $_POST['message'];
      $mail->send();
      $_SESSION['guul'] = 'success';
      $_SESSION['info'] = 'Message has been sent';
      echo '<script>window.location.href = "index.php";</script>';
    } catch (Exception $e) {
      $_SESSION['guul'] = 'fail';
      $_SESSION['info'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  } else {
    $_SESSION['guul'] = 'fail';
    $_SESSION['info'] = "Please fill in all required fields.";
  }
}
?>


<!-- ============================================-->
<!-- <section> begin ============================-->
<section>
  <div class="bg-holder overlay" style="background-image:url(assets/img/background-2.jpg);background-position:center bottom;"></div>
  <!--/.bg-holder-->
  <div class="container">
    <div class="row pt-6" data-inertia='{"weight":1.5}'>
      <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
        <div class="overflow-hidden">
          <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>Contact</h1>
          <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
            <ol class="breadcrumb fs-1 ps-0 fw-bold">
              <li class="breadcrumb-item"><a class="text-white" href="#!">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end of .container-->
</section><!-- <section> close ============================-->
<!-- ============================================-->


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

  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-100">
    <div class="container">
      <div class="row align-items-stretch justify-content-center mb-4">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="card h-100">
            <div class="card-body px-5">
              <h5 class="mb-3">Melbourne Office</h5>
              <p class="mb-0 text-1100"> 121 King Street,<br />Melbourne 1200,<br />Australia</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="card h-100">
            <div class="card-body px-5">
              <h5 class="mb-3">Sydney Office</h5>
              <p class="mb-0 text-1100"> 62 Collins Street West,<br />Sydney 3000, <br />Australia</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="card h-100">
            <div class="card-body px-5">
              <h5>Socials</h5><a class="d-inline-block mt-2" href="#!"><span class="fab fa-linkedin fs-2 me-2 text-primary"></span></a><a class="d-inline-block mt-2" href="#!"><span class="fab fa-twitter-square fs-2 mx-2 text-primary"></span></a><a class="d-inline-block mt-2" href="#!"><span class="fab fa-facebook-square fs-2 mx-2 text-primary"></span></a><a class="d-inline-block mt-2" href="#!"><span class="fab fa-google-plus-square fs-2 ms-2 text-primary"></span></a>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body h-100 p-5">
          <h5 class="mb-3">Write to us</h5>
          <form action="contact.php" method="post">
            <div class="mb-4">
              <input class="form-control bg-white" name="name" type="text" placeholder="Your Name" required="required" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
            </div>
            <div class="mb-4">
              <input class="form-control bg-white" name="email" type="email" placeholder="Email" required="required" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
            </div>
            <div class="mb-4">
              <textarea class="form-control bg-white" name="message" rows="11" placeholder="Enter your descriptions here..." required="required"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
            </div>
            <button class="btn btn-md-lg btn-primary" type="Submit" name="submit"><span class="color-white fw-600">Send Now</span></button>
          </form>

        </div>
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->

</main><!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
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

<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="vendors/popper/popper.min.js"></script>
<script src="vendors/bootstrap/bootstrap.min.js"></script>
<script src="vendors/is/is.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARdVcREeBK44lIWnv5-iPijKqvlSAVwbw&amp;callback=initMap" async></script>
<script src="vendors/prism/prism.js"></script>
<script src="vendors/fontawesome/all.min.js"></script>
<script src="vendors/lodash/lodash.min.js"></script>
<script src="vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="vendors/gsap/gsap.js"></script>
<script src="vendors/gsap/customEase.js"></script>
<script src="assets/js/theme.js"></script>
<?php require '../includes/footer_alumni.php'; ?>