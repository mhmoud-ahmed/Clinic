  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="../pages/home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Pations</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="allAppoiment.php">
              <i class="bi bi-circle"></i><span>All Appoiments</span>
            </a>
          </li>
          <li>
            <a href="appoiment.php">
              <i class="bi bi-circle"></i><span>Appoiments To Day</span>
            </a>
          </li>
          <li>
            <a href="pation-contact.php">
              <i class="bi bi-circle"></i><span>Contact</span>
            </a>
          </li>
          <li>
            <a href="pation-file.php">
              <i class="bi bi-circle"></i><span>Files</span>
            </a>
          </li>
        </ul>
      </li><!-- End Pations Nav -->

      <li class="nav-item active">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Contact Clinic</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <?php if (isset($_SESSION['info']['clinic_name']) == 'El-Hawamdia') : ?>
            <li>
              <a href="../pages/contact-badrashin.php">
                <i class="bi bi-circle"></i><span>Contact Badrashin</span>
              </a>
            </li>
            <li>
              <a href="../pages/contact-giza.php">
                <i class="bi bi-circle"></i><span>Contact Giza</span>
              </a>
            </li>
          <?php elseif (isset($_SESSION['info']['clinic_name']) == 'El-Badrashin') : ?>
            <li>
              <a href="../pages/contact-hawamdia.php">
                <i class="bi bi-circle"></i><span>Contact Hawamdia</span>
              </a>
            </li>
            <li>
              <a href="../pages/contact-giza.php">
                <i class="bi bi-circle"></i><span>Contact Giza</span>
              </a>
            </li>
          <?php elseif (isset($_SESSION['info']['clinic_name']) == 'Giza') : ?>
            <li>
              <a href="../pages/contact-hawamdia.php">
                <i class="bi bi-circle"></i><span>Contact Hawamdia</span>
              </a>
            </li>
            <li>
              <a href="../pages/contact-badrashin.php">
                <i class="bi bi-circle"></i><span>Contact Badrashin</span>
              </a>
            </li>
          <?php else : ?>
            <li>
              <a href="../pages/contact-badrashin.php">
                <i class="bi bi-circle"></i><span> Contact Badrashin </span>
              </a>
            </li>
            <li>
              <a href="../pages/contact-hawamdia.php">
                <i class="bi bi-circle"></i><span>Contact Hawamdia</span>
              </a>
            </li>
            <li>
              <a href="../pages/contact-giza.php">
                <i class="bi bi-circle"></i><span>Contact Giza</span>
              </a>
            </li>
          <?php endif ?>
        </ul>
      </li><!-- End Clinics Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <?php if (!checkSession('info')) : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="login.php">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Login</span>
          </a>
        </li>
      <?php endif ?>
      <!-- End Login Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-left"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->