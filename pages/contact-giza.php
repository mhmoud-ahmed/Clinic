<?php
include "../layouts/header-script.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
include "../middleware/auth.php";
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Contact</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item">Pages</li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <?php $clinic_info = mysqli_query($confg, contactView('Giza'));
  $info = []; ?>

  <?php if ($clinic_info->num_rows > 0) : ?>
    <?php while ($row = $clinic_info->fetch_assoc()) : ?>
      <?php $info[] = $row; ?>
    <?php endwhile; ?>
  <?php endif; ?>
  <section class="section contact">
    <div class="row gy-4">
      <div class="col-xl-6">
        <div class="row">
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p><?= $info[0]['clinic_Address'] ?></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p><?= $info[0]['clinic_Phone']?><br><?= $info[0]['secretars_Phone']?></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p><?= $info[0]['Email']?><br></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-clock"></i>
              <h3>Open Hours</h3>
              <p><?= $info[0]['day']?> - <?= $info[1]['day']?><br><?= date('g:ia',strtotime($info[0]['START_AT']))?> - <?= date('g:ia',strtotime($info[0]['END_AT']))?> </p>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-6">
        <div class="card p-4">
          <form action="forms/contact.php" method="post" class="php-email-form">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
              </div>

              <div class="col-md-6 ">
                <input type="number" class="form-control" name="phone" placeholder="Your Phone" required>
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
              </div>

            </div>
          </form>
        </div>

      </div>

    </div>

  </section>

</main><!-- End #main -->
<?php
include "../layouts/footer-content.php";
include "../layouts/footer-script.php";
?>