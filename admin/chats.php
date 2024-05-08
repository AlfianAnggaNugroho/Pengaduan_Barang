<?php
include "templates/header.php";
include "templates/sidebar-chat.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Contact Active</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Data Contact</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fab fa-whatsapp mr-3"></i>Contact Active</h3>
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
          <table class="table table-hover" id="table" width="100%">
            <thead align="center">
              <th>WhatsApp</th>
              <th>Telegram</th>
              <th width="160">Action</th>
            </thead>
            <tbody align="center">
              <?php
                $data = query("SELECT * FROM chat ");
                foreach ($data as $d) :
                ?>

              <tr>
                <td><?= $d['whatsapp']; ?></td>
                <td><?= $d['telegram']; ?></td>
                <td><a href="edit-contact.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-outline-info mr-2"
                    style="font-size: 15px; width: 80px;"><i class="fas fa-search mr-1"></i>Edit</a>
                </td>
              </tr>
              <?php
                endforeach;
                ?>
            </tbody>
            <tfoot align="center">
              <th>WhatsApp</th>
              <th>Telegram</th>
              <th width="160">Action</th>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </section>

  <!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>