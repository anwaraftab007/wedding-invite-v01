<?php
include "../../includes/connection.inc.php";
include "../../includes/functions.inc.php";

session_start();

if (isset($_SESSION['key'])) {
    if (isset($_POST['blog_title'])) {
        // Store form data
        $blog_title = sanitize_data($con, $_POST['blog_title']);
        $blog_categories = sanitize_data($con, $_POST['blog_categories']);
        $author_name = sanitize_data($con, $_POST['author_name']);
        $blog_date = $_POST['blog_date'];
        $meta_title = sanitize_data($con, $_POST['meta_title']);
        $meta_keywords = sanitize_data($con, $_POST['meta_keywords']);
        $meta_description = sanitize_data($con, $_POST['meta_description']);
        $blog_content = mysqli_real_escape_string($con, $_POST['blog_content']);

        $target_dir = "../assets/images/blogs/";
        $target_file = $target_dir . basename($_FILES["blog_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["blog_image"]["tmp_name"]);
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
            $temp = explode(".", $_FILES["blog_image"]["name"]);
            $newfilename = round(microtime(true)) . "-" . date("d-m-Y") . "." . end($temp);

            if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_dir . $newfilename)) {
                // Insert data into database
                $sql = mysqli_query($con,
                    "INSERT INTO blogs(blog_title,blog_categories,author_name,blog_image,blog_date,meta_title,meta_keywords,meta_description,blog_content)
                    VALUES('$blog_title','$blog_categories','$author_name','$newfilename','$blog_date','$meta_title','$meta_keywords','$meta_description','$blog_content')"
                );

                if ($sql) {
                    header("Location:../successful/");
                    die();
                } else {
                    header("Location:../unsuccessful/");
                    die();
                }
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
      <title>Add Blog</title>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.css" integrity="sha512-uNuUv76SDK2TrRpaWVDwggBAeGU+W+8JD/wJ7ZhSe4cF41yknQ5Ii7ueYgT7ds7d33WaufIjHdab6XgsnfCywQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" integrity="sha512-2L0dEjIN/DAmTV5puHriEIuQU/IL3CoPm/4eyZp3bM8dnaXri6lK8u6DC5L96b+YSs9f3Le81dDRZUSYeX4QcQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <?php include "../header.html.php";?>

      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet" />
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
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="card">
                        <div class="card-header">
                          <h4>Blog Details</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12 form-group">
                              <label>Title*</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-book-open"></i>
                                  </div>
                                </div>
                                <input type="text" name="blog_title" class="form-control" required />
                              </div>
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Categories*</label>
                              <select class="form-control select2" multiple=""
                                onchange="
                                  $('.blog_categories').val($(this).val());
                                "
                                required
                              >
                                <option>Industry</option>
                                <option>Cables</option>
                                <option>Wires</option>
                              </select>
                            </div>
                            <input type="hidden" name="blog_categories" class="blog_categories" />
                            <div class="col-lg-12 form-group">
                              <label>Author Name*</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                  </div>
                                </div>
                                <input type="text" name="author_name" class="form-control" required />
                              </div>
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Cover Image*</label>
                              <input type="file" name="blog_image" id="blog_image" class="form-control" required />
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Date*</label>
                              <input type="date" name="blog_date" class="form-control datepicker" required />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card">
                        <div class="card-header">
                          <h4>SEO Details</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12 form-group">
                              <label>Meta Title*</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-book-open"></i>
                                  </div>
                                </div>
                                <input type="text" name="meta_title" class="form-control" required />
                              </div>
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Meta Keywords*</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-tags"></i>
                                  </div>
                                </div>
                                <input type="text" name="meta_keywords" class="form-control" required />
                              </div>
                            </div>
                            <div class="col-lg-12 form-group">
                              <label>Meta Description*</label>
                              <textarea name="meta_description" class="form-control" required></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Blog Content</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <textarea name="blog_content" class="summernote"></textarea>
                            </div>
                            <div class="col-lg-2 mt-4">
                              <button type="submit" class="form-control btn btn-primary">Add Blog</button>
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
      <!-- Page Specific JS File -->
      <script src="../../assets/js/page/forms-advanced-forms.js"></script>

      <!-- JS Libraies -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.js" integrity="sha512-RVw+XaWNydMuPjPzSi5GlclhfvA0eAl+BbqRO0Q/IO3+bMB3NWdN6e/q/BYJrhPsHXNnxae4acHVaAOPtCphQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js" integrity="sha512-osQTlub0mspbF8cmq5xylJ5kCJi42xglqltwx2pMI0/I78Y55dKpr3TtLB7nCTYka1AxpF1dOAeSFbgByDvS0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
      <script>
        $(document).ready(function() {
          $(".summernote").summernote({
            placeholder: "Blog Content",
          });
        });
      </script>
    </body>
    </html>
<?php
} else {
    header("Location:../../login/");
    die();
}
?>