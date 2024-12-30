<?php
include "../../includes/connection.inc.php";
include "../../includes/functions.inc.php";

session_start();

if (isset($_SESSION['key'])) {
    $sql = mysqli_query($con, "SELECT * FROM slider");

    if (isset($_GET['delete'])) {
        if ($_GET['delete'] == "success") {
            ?>
      <script>
        alert("Image has been deleted successfully!");
      </script>
    <?php
} else if ($_GET['delete'] == "fail") {
            ?>
      <script>
        alert("Image couldn't be deleted!");
      </script>
    <?php
}
    }

    if (isset($_GET['action'])) {
        if ($_GET['action'] == "delete") {
            $id = $_GET['id'];

            $sliderImage = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM slider WHERE id='$id'"));
            $sqlDelete = mysqli_query($con, "DELETE FROM slider WHERE id = '$id'");

            $target_dir = "../assets/images/slider/" . $sliderImage['image'];

            if ($sqlDelete && unlink($target_dir)) {
                header("Location:../view-sliders/?delete=success");
                die();
            } else {
                header("Location:../view-sliders/?delete=fail");
                die();
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
      <title>View Images</title>

      <?php include "../header.html.php";?>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.min.css" integrity="sha512-NDWv4n2v59EOoj+dDvXfD4uGGTCOXkLAnm+DhQtyYxpZL4lMSymTX5HD8i5NEcF+1YLBkgvByardYsJaA1W6MA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/jquery.dataTables.min.css" integrity="sha512-LEcCbgUWPBUGbPctNaH+oxZRo415/rpwfqUQXcT4gS+gZyUTb8OIBV288vKAPLqbqsskLKQxgXOz4fr794XZhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <div class="mb-3 text-right">
                  <a href="../add-slider/" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Slider</a>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>All uploaded Sliders</h4>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-striped" id="table-1">
                            <thead>
                              <tr>
                                <th>S.No.</th>
                                <th>Heading</th>
                                <th>Text</th>
                                <th>Button text</th>
                                <th>Image</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($sql)) {
                              ?>
                                <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td><?php echo $row['heading']; ?></td>
                                  <td><?php echo $row['text']; ?></td>
                                  <td><?php echo $row['button_text']; ?></td>
                                  <td>
                                    <img alt="image" src="../../assets/images/slider/<?php echo $row['image']; ?>" width="100" />
                                  </td>
                                  <td class="text-center">
                                    <a class="btn btn-danger text-white delete" id="image-<?php echo $row['id']; ?>">
                                      <i class="far fa-trash-alt"></i>
                                    </a>
                                  </td>
                                </tr>
                              <?php
                                }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>

          <?php include "../footer.html.php";?>

        </div>
      </div>

      <?php include "../scripts.html.php";?>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js" integrity="sha512-yCkOYsxpzPSpcbHspsH6A28Z0cgsfjJhlR78nPAfLLZSSV40tVN4VQ6ES/miqI/1z8a5FWVYwCF145+eyJx9Tw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap4.min.js" integrity="sha512-2wDq7VuYclJFDG5YbUbmOEWYtTEs/DwpKa9maNvC8gIhEHyR/rgh1BuyUrPZy00H8/DGlLAwbYwSpzCRV0dQJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <script>
        $("#table-1").dataTable({
          "columnDefs": [
            { "sortable": false, "targets": [1, 2] }
          ]
        });
        
        $(".delete").click(function () {
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover the image!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete)
              window.location = "?action=delete&id=" + $(this).attr("id").substr(6);
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