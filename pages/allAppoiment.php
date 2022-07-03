<?php
include "../layouts/header-script.php";
include "../middleware/auth.php";
include "../layouts/nav.php";
include "../layouts/aside.php";
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Appoiments Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item">Appoiments</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                                <?php $viewAllAppoiments = mysqli_query($confg, allAppoiments(catchDataSession('info', 'clinic_id'))); ?>
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

</main><!-- End #main -->

<?php
include "../layouts/footer-content.php";
include "../layouts/footer-script.php";
