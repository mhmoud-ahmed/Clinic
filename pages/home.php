<?php
include "../layouts/header-script.php";
include "../middleware/auth.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Pation appoiment Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Total Detection <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php if (!empty(catchDataSession('info', 'clinic_id'))) : ?>
                                            <?php $detection = mysqli_query($confg, countReservation("detection","$date")) ?>
                                            <?php if ($detection->num_rows > 0) {
                                                while ($row = $detection->fetch_assoc()) {
                                                    $countDetection = $row['COUNT(*)'];
                                                }
                                            } ?>
                                            <h6><?= $countDetection ?></h6>
                                        <?php else : ?>
                                            <?php $consultation = mysqli_query($confg, countReservation("detection","$date")) ?>
                                            <?php if ($consultation->num_rows > 0) {
                                                while ($row = $consultation->fetch_assoc()) {
                                                    $countconsultation = $row['COUNT(*)'];
                                                }
                                            } ?>
                                            <h6><?= $countconsultation ?></h6>
                                        <?php endif ?>
                                        <span class="text-muted small pt-2 ps-1">Detection</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->
                    <!-- Pation appoiment Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Total Consultation <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php if (!empty(catchDataSession('info', 'clinic_id'))) : ?>
                                            <?php $consultation = mysqli_query($confg, countReservation("consultation","$date")) ?>
                                            <?php if ($consultation->num_rows > 0) {
                                                while ($row = $consultation->fetch_assoc()) {
                                                    $countconsultation = $row['COUNT(*)'];
                                                }
                                            } ?>
                                            <h6><?= $countconsultation ?></h6>
                                        <?php else :?>
                                            <?php $consultation = mysqli_query($confg, countReservation("consultation","$date")) ?>
                                            <?php if ($consultation->num_rows > 0) {
                                                while ($row = $consultation->fetch_assoc()) {
                                                    $countconsultation = $row['COUNT(*)'];
                                                }
                                            } ?>
                                            <h6><?= $countconsultation ?></h6>
                                        <?php endif ?>
                                        <span class="text-muted small pt-2 ps-1">Consultation</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Consult Card -->
                    <?php if (!empty(catchDataSession('info', 'clinic_id'))) : ?>
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card revenue-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">All Reservation <span> Today </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php $allReservation = mysqli_query($confg, allReservation("$date",(catchDataSession('info', 'clinic_id')))) ?>
                                            <?php if ($allReservation->num_rows > 0) {
                                                while ($row = $allReservation->fetch_assoc()) {
                                                    $reservation = $row['COUNT(*)'];
                                                }
                                            } ?>
                                            <h6><?= $reservation ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Reservation</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><?php endif ?>
                    <!-- End Consult Card -->
                    <!-- Appoiment Clinic -->
                    <div class="col-12">
                        <?php if (catchDataSession('error_pation-info', 'error_pation-info')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= catchDataSession('error_pation-info', 'error_pation-info'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(catchDataSession('info', 'clinic_id'))) : ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Clinic Appoiment Pation</h5>
                                    <!-- Add pation Form -->
                                    <?php if (catchDataSession('errorReservation', 'errorReservation')) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= catchDataSession('errorReservation', 'errorReservation'); ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (catchDataSession('successApoiment', 'successApoiment')) : ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= catchDataSession('successApoiment', 'successApoiment'); ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (catchDataSession('clinic', 'clinic')) : ?>
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <?= catchDataSession('clinic', 'clinic'); ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <form class="row g-3" method="POST" action="../handelers/add-pation.php">
                                        <div class="col-md-6">
                                            <label for="inputName5" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="inputName5" name="fName">
                                            <?php if (catchDataSession('errorValidation', 'fname')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'fname'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputName5" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="inputName5" name="lName">
                                            <?php if (catchDataSession('errorValidation', 'lname')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'lname'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputName5" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="inputName5" reqiued name="phone">
                                            <?php if (catchDataSession('errorValidation', 'phone')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'phone'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputName5" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="inputName5" name="age">
                                            <?php if (catchDataSession('errorValidation', 'birthdate')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'birthdate'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>


                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Covernorate</label>
                                            <input type="text" class="form-control" id="inputCity" name="covernorate">
                                            <?php if (catchDataSession('errorValidation', 'covernorate')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'covernorate'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">City</label>
                                            <input type="text" class="form-control" id="inputCity" name="city">
                                            <?php if (catchDataSession('errorValidation', 'city')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'city'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Gender</label>
                                            <select id="inputState" class="form-select" name="gender">
                                                <option selected>Choose...</option>
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                            </select>
                                            <?php if (catchDataSession('errorValidation', 'gender')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'gender'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Status</label>
                                            <select id="inputState" class="form-select" name="status">
                                                <option selected>Choose...</option>
                                                <option value="detection">Detection</option>
                                                <option value="consultation">Consultation</option>
                                            </select>
                                            <?php if (catchDataSession('errorValidation', 'status')) : ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <?= catchDataSession('errorValidation', 'status'); ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Day</label>
                                            <input type="date" name="date" class="form-control" id="inputName5" reqiued name="date">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" min="2022-05-30" max="2022-07-30" name="add-pation" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </form><!-- End Multi Columns Form -->

                                </div>
                            </div>
                        <?php else : ?>
                            <section class="section">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Tabel Appoiments</h5>
                                                <!-- Table with stripped rows -->
                                                <table class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Type Reservation</th>
                                                            <th scope="col">Age</th>
                                                            <th scope="col">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <?php $viewAllAppoiments = mysqli_query($confg, appoimentView($date)); ?>
                                                        <?php if ($viewAllAppoiments->num_rows > 0) :
                                                            $i = 1; ?>
                                                            <?php while ($row = $viewAllAppoiments->fetch_assoc()) :
                                                            ?>
                                                                <tr>
                                                                    <th scope="row"><?= $i++ ?></th>
                                                                    <td><?= $row['FullName'] ?></td>
                                                                    <td><?= $row['type_reservation'] ?></td>
                                                                    <td><?= print_age($row['age']) ?></td>
                                                                    <td><?= $row['date'] ?></td>
                                                                </tr>
                                                            <?php endwhile ?>
                                                        <?php endif ?>
                                                    </tbody>
                                                </table>
                                                <!-- End Table with stripped rows -->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        <?php endif ?>
                    </div><!-- End Appoiment Clinic -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->

<?php
include "../layouts/footer-content.php";
include "../layouts/footer-script.php";
unset($_SESSION['errorValidation']);
unset($_SESSION['errorReservation']);
unset($_SESSION['successApoiment']);
unset($_SESSION['error_pation-info']);
unset($_SESSION['clinic']);
?>