<?php
include "../includes/connection.inc.php";
include "../includes/functions.inc.php";

session_start();
if (isset($_SESSION['key'])) {
    header("Location:../dashboard/");
    die();
} else {
    if (isset($_POST['email'])) {
        $email = sanitize_data($con, $_POST['email']);
        $password = sha1(sanitize_data($con, $_POST['password']));

        $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'"));

        if ($count == 0) {
            ?>
      <div class="alert alert-danger m-4">
        <strong>Oops!</strong> The credentials you entered, don't exist.
      </div>
<?php
} else {
            $sql = mysqli_query($con, "SELECT * FROM users where email = '$email' AND password = '$password'");
            $row = mysqli_fetch_assoc($sql);

            $_SESSION['key'] = $row['id'];
            header("Location:../dashboard/");
            die();
        }
    }
    ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login</title>

    <link rel="stylesheet" href="../assets/css/app.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/components.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
  </head>

  <body>
    <div class="loader"></div>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Login</h4>
                </div>
                <div class="card-body">
                  <form class="needs-validation" method="post" novalidate="">
                    <div class="form-group">
                      <label for="email">Email*</label>
                      <input name="email" id="email" type="email" class="form-control" tabindex="1" required autofocus>
                      <div class="invalid-feedback">
                        Please fill in your email
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password">Password*</label>
                      <input name="password" id="password" type="password" class="form-control" tabindex="2" required>
                      <div class="invalid-feedback">
                        please fill in your password
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
}
?>