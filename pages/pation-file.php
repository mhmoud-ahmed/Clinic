<?php
include "../layouts/header-script.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
include "../middleware/auth.php";
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Files</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item">pations</li>
        <li class="breadcrumb-item active">files</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add x-rays And analysis medical</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" enctype="multipart/form-data" action="../handelers/handeler-file.php" method="POST">
              <?php if (catchDataSession('error', 'typeFile')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= catchDataSession('error', 'typeFile'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <?php if (catchDataSession('error', 'extention')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= catchDataSession('error', 'extention'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <?php if (catchDataSession('error', 'error-upload')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= catchDataSession('error', 'extention'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <?php if (catchDataSession('error', 'error-size')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= catchDataSession('error', 'error-size'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <div class="col-md-6">
                <label for="inputName5" class="form-label">Pation Code</label>
                <input type="number" class="form-control" name="pation_code" id="inputName5" value="<?php if (checkRequestGET('pation_code', 'GET')) {
                                                                                                      echo getData('pation_code');
                                                                                                    } ?>">
              </div>
              <div class="col-md-6">
                <label for="inputState" class="form-label">Filles add</label>
                <select id="inputState" class="form-select" name="imgtype">
                  <option selected>Choose...</option>
                  <option value="xRay" <?php if (checkRequestGET('add', 'GET')) {
                                          if (getData('add') == 'x-ray') {
                                            echo "Selected";
                                          }
                                        } ?>>x-Rays</option>
                  <option value="Analyses" <?php if (checkRequestGET('add', 'GET')) {
                                              if (getData('add') == 'analyses') {
                                                echo "Selected";
                                              }
                                            } ?>>Medical_Analyses</option>
                </select>
              </div>

              <input name="id" type="hidden" value="<?php if (checkRequestGET('pation_id', 'GET')) {
                                                      echo getData('pation_id');
                                                    } ?>" class="form-control" id="inputName5">

              <div class="col-md-4">
                <label for="inputState" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="inputName5" multiple>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Date</label>
                <input type="date" name="date" class="form-control" id="inputName5" multiple>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Image</label>
                <input type="file" name="attachment[]" class="form-control" id="inputName5" multiple>
              </div>

              <div class="text-center">
                <button type="submit" name="add" class="btn btn-primary">Add</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include "../layouts/footer-content.php";
include "../layouts/footer-script.php";
unset($_SESSION['error']['typeFile']);
unset($_SESSION['error']['extention']);
unset($_SESSION['error']['error-upload']);
unset($_SESSION['error']['error-size']);
?>