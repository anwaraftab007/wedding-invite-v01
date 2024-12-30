<?php
include "../../includes/connection.inc.php";
include "../../includes/functions.inc.php";

session_start();

if (isset($_SESSION['key'])) {
    $sqlFetch = mysqli_query($con, "SELECT * FROM event");
    $rowFetch = mysqli_fetch_assoc($sqlFetch);

    if (isset($_POST['title'])) {
      $title = sanitize_data($con, $_POST['title']);
      $time = sanitize_data($con, $_POST['time']);
      $details = sanitize_data($con, $_POST['details']);

        $target_dir = "../assets/images/event/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            ?>
            <script>
                alert("File is not an image.");
            </script>
    <?php
$uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            ?>
                <script>
                    alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                </script>
    <?php
$uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            ?>
        <script>
            alert("Sorry, your file was not uploaded.");
        </script>
    <?php
// if everything is ok, try to upload file
        } else {
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . "-" . date("d-m-Y") . "." . end($temp);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
                $sql = mysqli_query($con, 
                  "UPDATE event SET
                    title = '$title',
                    image = '$newfilename',
                    time = '$time',
                    details = '$details'
                  ");

                  header("Location:../update-details/");
                  die();
            } else {
                ?>
            <script>
                alert("Sorry, there was an error uploading the image.");
            </script>
    <?php
}
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
      <title>Update Event Details</title>

      <?php include "../header.html.php";?>
    </head>
    <body>
      <div class="loader"></div>
      <div id="app">
        <div class="main-wrapper main-wrapper-1">

          <?php include "../sidebar.html.php";?>

          <!-- Main Content -->
          <div class="main-content">
            <section class="section">
              <div class="section-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="mb-3 text-right">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                  </div>
                  <div class="row">
                    <div class="col-md-6 offset-md-3">
                      <div class="card">
                        <div class="card-header">
                          <h4>Update Event Details</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12 form-group">
                              <label>Title*</label>
                              <input type="text" name="title" class="form-control" value="<?php echo $rowFetch['title']; ?>" required />
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Image*</label>
                              <input type="file" name="image" id="image" class="form-control" required />
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Time*</label>
                              <input type="text" name="time" class="form-control" value="<?php echo $rowFetch['time']; ?>" required />
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Details*</label>
                              <textarea name="details" class="form-control" required><?php echo $rowFetch['details']; ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>
          </div>

          <?php include "../footer.html.php";?>

        </div>
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