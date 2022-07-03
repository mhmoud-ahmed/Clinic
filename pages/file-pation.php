<?php
include "../layouts/header-script.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
include "../middleware/auth.php";
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">

            <h2><?= catchDataSession('info', 'name') ?></h2>
            <h3>عيادات <?= catchDataSession('info', 'clinic_name') ?></h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
              <?php $prescription = mysqli_query($confg, checkPrescription(catchDataSession('pation_info', 'id'))) ?>
              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'full_name') ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'phone') ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Age</div>
                  <div class="col-lg-9 col-md-8"><?= date("Y") - getAge(catchDataSession('pation_info', 'age')) ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Pation Code</div>
                  <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'code') ?></div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Detection Date</div>
                  <div class="col-lg-9 col-md-8"><?php $date = date_create(catchDataSession('pation_info', 'date_detection'));
                                                  echo date_format($date, "Y/m/d") ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Diagnosis</div>
                  <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'diagnosis') ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Medicine</div>
                  <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'medicine') ?></div>
                </div>
                <?php if ($prescription->num_rows > 0) : ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">analyses</div>
                    <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'analyses') ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">X_rays</div>
                    <div class="col-lg-9 col-md-8"><?= catchDataSession('pation_info', 'x_rays') ?></div>
                  </div>
                <?php endif ?>
                <?php if (catchDataSession('Reservation', 'errorReservation')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= catchDataSession('Reservation', 'errorReservation'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif; ?>
                <?php if (catchDataSession('Reservation', 'doneReservation')) : ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= catchDataSession('Reservation', 'doneReservation'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif; ?>
                <?php if (!empty(catchDataSession('info', 'clinic_id'))) : ?>
                  <a href="../handelers/add-pation.php?pation_id=<?= catchDataSession('pation_info', 'id') ?>&status=detection" type="button" class="btn btn-info">Make New Detection </a>
                  <a href="../handelers/add-pation.php?pation_id=<?= catchDataSession('pation_info', 'id') ?>&status=consultation" type="button" class="btn btn-info">Make Consultation </a>
                <?php endif ?>
                <?php if ($prescription->num_rows > 0) : ?>
                  <a href="pation-file.php?pation_code=<?= catchDataSession('pation_info', 'code') ?>&pation_id=<?= catchDataSession('pation_info', 'id') ?>&add=x-ray" type="button" class="btn btn-info"> Add x-Ray </a>
                  <a href="pation-file.php?pation_code=<?= catchDataSession('pation_info', 'code') ?>&pation_id=<?= catchDataSession('pation_info', 'id') ?>&add=analyses" type="button" class="btn btn-info"> Add analyses </a>
                <?php else : ?>
                  <a href="prescription.php?pation_id=<?= catchDataSession('pation_info', 'id') ?>" type="button" class="btn btn-info"> Enter Prescription </a>
                <?php endif ?>
              </div>
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form>
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="../assets/img/profile-img.jpg" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="fullName" value="<?= catchDataSession('pation_info', 'full_name') ?>">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="phone" value="<?= catchDataSession('pation_info', 'phone') ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="age" class="col-md-4 col-lg-3 col-form-label">Age</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="age" type="date" class="form-control" id="age" value="<?= catchDataSession('pation_info', 'age') ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="national-id" class="col-md-4 col-lg-3 col-form-label">Pation Code</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="national-id" value="<?= catchDataSession('pation_info', 'code') ?>" disabled>
                    </div>
                  </div>



                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php

include "../layouts/footer-script.php";
include "../layouts/footer-content.php";
unset($_SESSION['Reservation']);
?>