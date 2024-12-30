<?php
  include "../includes/connection.inc.php";
  include "../includes/functions.inc.php";

  session_start();

  if (isset($_SESSION['key'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard</title>

  <link rel="stylesheet" href="../assets/css/app.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/components.css" />
  <link rel="stylesheet" href="../assets/css/custom.css" />
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">

      <?php include "./sidebar-root.html.php";?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Blogs</h5>
                          <h2 class="mb-3 font-18">10</h2>
                          <p class="mb-0"><span class="col-green">10</span> Today</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="../assets/images/dashboard/blog.png" alt="Blogs" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include "./footer.html.php";?>

    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/js/app.min.js"></script>
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="../assets/js/custom.js"></script>
</body>
</html>
<?php
  } else {
      header("Location:../login/");
      die();
  }
?>