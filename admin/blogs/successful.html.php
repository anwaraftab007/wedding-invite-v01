<?php
  session_start();
  
  if(isset($_SESSION['key'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Successfully Uploaded Blog</title>

  <?php include "../header.html.php";?>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="card card-success">
              <div class="card-header">
                <h4>Blog Upload</h4>
              </div>
              <div class="card-body text-center">
                <img src="../../assets/images/successful.png" width="300" alt="Blog Successful" />
                <h4 class="my-4">Successfully Uploaded Blog!</h4>
                <a href="../view-blogs/" class="btn btn-success">View Blogs</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include "../scripts.html.php";?>
</body>
</html>
<?php
  } else {
    header("Location:../../login/");
    die();
  }
?>