<?php
require 'funct.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $newUsername = $_POST['editUsername'];
    $newName = $_POST['editName'];
    $newPassword = $_POST['editPassword'];  // Menambahkan field password dari form

    if (edituser($user_id, $newUsername, $newName, $newPassword)) {  // Menambahkan parameter password
      echo "<script>
              alert('User edited successfully!'); window.location='users.php';
            </script>";
    } else {
      echo "Error: Unable to edit user.";
    }
  }
}

// Pemutusan koneksi ditempatkan di sini setelah semua operasi selesai
$conn->close();
?>





<?php
include "templates/header.php";
include "templates/sidebar-users.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active"></li>Users
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <a href="tambah-user.php" class="btn btn-primary btn-sm">
          <i class="fas fa-plus" style="margin-right:5px;"></i> Tambah Users
        </a>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="table_user" width="100%">
            <thead align="center">
              <th>User Id</th>
              <th>Username</th>
              <th width="240">Full Name</th>
              <th>Photo</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
                $data = query("SELECT * FROM user");
                foreach ($data as $d) :
                ?>
              <tr align="center">
                <td><?php echo $d['user_id']; ?></td>
                <td><?php echo $d['username']; ?></td>
                <td><?php echo $d['name']; ?></td>
                <td><img src="../assets/img/profile/<?= $d['img']; ?>" alt="user image" width="100" height="100"></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-toggle="modal"
                    data-target="#editModal<?= $d['user_id']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="delete-user.php?id=<?= $d['user_id']; ?>" class="btn btn-sm btn-outline-danger"><i
                      class="fas fa-trash-alt mr-1"></i></a>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="editModal<?= $d['user_id']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?= $d['user_id']; ?>">
                        <div class="form-group">
                          <label for="editUsername">Username</label>
                          <input type="text" class="form-control" id="editUsername" name="editUsername"
                            value="<?= $d['username']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="editName">Full Name</label>
                          <input type="text" class="form-control" id="editName" name="editName"
                            value="<?= $d['name']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="editPassword">New Password</label>
                          <input type="password" class="form-control" id="editPassword" name="editPassword"
                            placeholder="Leave it blank if you don't want to change">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </form>
                    </div>


                  </div>
                </div>
              </div>
        </div>
        <?php endforeach; ?>
        </tbody>
        <tfoot align="center">
          <th>User Id</th>
          <th>Username</th>
          <th width="240">Full Name</th>
          <th>Photo</th>
          <th>Action</th>
        </tfoot>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>

<?php
include "templates/footer.php";
?>