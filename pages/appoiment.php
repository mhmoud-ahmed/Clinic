<?php
include "../layouts/header-script.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
include "../middleware/auth.php";
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Appoiments</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item">Pations</li>
        <li class="breadcrumb-item active">Appoiments</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Appoments To Day</h5>
            <?php if (catchDataSession('succ', 'succ')) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= catchDataSession('succ', 'succ'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            <?php if (catchDataSession('error', 'error-logic')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= catchDataSession('error', 'error-logic'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Age</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Pation_code</th>
                  <th scope="col">Reservation Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $view = mysqli_query($confg, appoimentToday(date("Y-m-d"), catchDataSession('info', 'clinic_id')));

                if ($view->num_rows > 0) :
                  while ($row = $view->fetch_assoc()) :
                ?>
                    <tr>
                      <th scope="row">1</th>
                      <td><?= $row['FullName'] ?></td>
                      <td><?= print_age($row['age']) ?></td>
                      <td><?= $row['phone'] ?></td>
                      <td><?= $row['code'] ?></td>
                      <td><?= $row['type_reservation'] ?></td>
                      <td><a href="../handelers/handeler-appoiment.php?pation_id=<?= $row['id'] ?>" type="button" class="btn btn-info">Done</a></td>
                      <?php if ($row['type_reservation'] == "consultation") : ?>
                        <td><a href="../pages/pation-file.php?pation_code=<?= $row['code'] ?>" type="button" class="btn btn-info">Add file</a></td>
                      <?php endif  ?>
                    </tr>
                  <?php endwhile; ?>
                <?php endif; ?>
              </tbody>
            </table>
            <!-- End Default Table Example -->
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<?php include "../layouts/footer-content.php";
include "../layouts/footer-script.php"
?>