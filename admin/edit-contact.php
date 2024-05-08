<?php
include "templates/header.php";
include "templates/sidebar-chat.php";

if (isset($_POST['submit'])) {
    if (updateContact($_POST) > 0) {
        echo "<script>alert('Update data successfully!'); window.location='chats.php';</script>";
    } else {
        echo "<script>alert('Data update failed or you did not make any changes!'); window.location='chats.php';</script>";
    }
}

$id = $_GET['id'];
$data = query("SELECT * FROM chat WHERE id = '$id'");
foreach ($data as $d) :
?>

<style>
.hidden-input {
  display: none;
}
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Contact Active</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Contact</a></li>
            <li class="breadcrumb-item active">Detail Contact</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <form action="" method="POST">
          <input type="text" name="id" id="id" class="form-control mb-3 hidden-input" value="<?= $d['id']; ?>" readonly>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                <label for="whatsapp">WhatsApp :</label>
                <input type="number" name="whatsapp" id="whatsapp" class="form-control mb-3"
                  value="<?= $d['whatsapp']; ?>">
              </div>
              <div class="col-md-6">
                <label for="telegram">Telegram :</label>
                <input type="text" name="telegram" id="telegram" class="form-control mb-3"
                  value="<?= $d['telegram']; ?>">
              </div>
            </div>


            <div class="row">
              <div class="col-md-8 mt-4">
                <button type="submit" value="submit" name="submit" class="btn btn-outline-success mr-2"
                  style="width: 100px;">
                  <span class="fas fa-check mr-2"></span>
                  Save
                </button>
                <button type="reset" value="reset" class="btn btn-outline-danger mr-2" style="width: 100px;">
                  <span class="fas fa-times mr-2"></span>
                  Reset
                </button>
                <a href="#" class="btn btn-outline-primary" onclick="history.back()" style="width: 100px;">
                  <span class="fas fa-arrow-left mr-2"></span>
                  Back
                </a>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      <?php
        endforeach;
        ?>

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>