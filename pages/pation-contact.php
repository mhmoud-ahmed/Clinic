<?php
include "../layouts/header-script.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
include "../middleware/auth.php";

?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Pation Contact</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item">Pations</li>
        <li class="breadcrumb-item active">Contact View</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pation Contact</h5>

            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Message</th>
                  <th scope="col">Phone</th>
                </tr>
              </thead>
              <tbody>
                <?php $contact = mysqli_query($confg, contactRead(catchDataSession('info', 'clinic_id'))); ?>
                <?php if ($contact->num_rows > 0) : ?>
                  <?php while ($row = $contact->fetch_assoc()) : ?>
                    <tr>
                      <th scope="row"><?= $row['id'] ?></th>
                      <td><?= $row['name'] ?></td>
                      <td><?= $row['subject'] ?></td>
                      <td><?= $row['message'] ?></td>
                      <td><?= $row['phone'] ?></td>
                    </tr>
                  <?php endwhile ?>
                <?php endif ?>
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
include "../layouts/footer-script.php";
?>