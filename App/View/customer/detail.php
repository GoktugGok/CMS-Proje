<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= assets('plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=assets('css/adminlte.min.css')?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  
  <?= $data['navbar'] ?>
  <?= $data['sidebar'] ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $data['customer']['name']. ' '.$data['customer']['surname'] ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= _link('') ?>">Keşfet</a></li>
              <li class="breadcrumb-item"><a href="<?= _link('musteri') ?>">Müşteriler</a></li>
              <li class="breadcrumb-item active"><?= $data['customer']['name']. ' '.$data['customer']['surname'] ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="row">
      <div class="col-md-4">
        <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username ml-2"><?= $data['customer']['name']. ' '.$data['customer']['surname'] ?></h3>
                <h5 class="widget-user-desc ml-2"><?= $data['customer']['company']?></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Projeler <span class="float-right badge bg-primary"><?= count($data['projects'])?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Tasks <span class="float-right badge bg-info"><?=$data['customer']['email']?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Completed Projects <span class="float-right badge bg-success"><?=$data['customer']['gsm']?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Followers <span class="float-right badge bg-danger"><?=$data['customer']['phone']?></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
      </div>
      <div class="col-md-8">
      <table class="table table-bordered">
            <thead>
                    <tr>
                      <th>Projeler</th>
                      <th>İlerleme</th>
                      <th style="width: 40px">Durum</th>
                      <th style="width: 40px">Eylem</th>
                    </tr>
            </thead>
              <tbody>
                <?php foreach($data['projects'] as $key => $value):?>
                    <tr id="row_<?= $value['id']?>">
                      <td><?= $value['title']?></td>
                      <td>
                      <?= $value['progress']?>%
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: <?= $value['progress']?>%"></div>
                        </div>
                      </td>
                      <td><?= $value['status'] == 'a' ? 'Aktif' : 'Pasif';?></td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button onclick="confirm('<?= $value['id'] ?>')" class="btn btn-sm btn-danger">Sil</button>
                          <a href="<?= _link('proje/guncelle/'.$value['id']) ?>" class="btn btn-sm btn-info">Güncelle</a>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach;?>
              </tbody>
          </table>
      </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=assets('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=assets('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?=assets('plugins/sweetalert2/sweetalert2.all.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=assets('js/adminlte.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js" integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const customer = document.getElementById('customer');

    customer.addEventListener('submit',(e) =>{
      let customer_id = document.getElementById('customer_id').value;
      let customer_name = document.getElementById('customer_name').value;
      let customer_surname = document.getElementById('customer_surname').value;
      let customer_company = document.getElementById('customer_company').value;
      let customer_phone = document.getElementById('customer_phone').value;
      let customer_gsm = document.getElementById('customer_gsm').value;
      let customer_email = document.getElementById('customer_email').value;
      let customer_address = document.getElementById('customer_address').value;


      let formData = new FormData();
      formData.append('customer_id',customer_id);
      formData.append('customer_name',customer_name);
      formData.append('customer_surname',customer_surname);
      formData.append('customer_company',customer_company);
      formData.append('customer_phone',customer_phone);
      formData.append('customer_gsm',customer_gsm);
      formData.append('customer_email',customer_email);
      formData.append('customer_address',customer_address);


      axios.post('<?= _link('musteri/guncelle') ?>',formData)
        .then(res=>{
          console.log(res)

          
          swal.fire(
            res.data.title,
            res.data.msg,
            res.data.status,
          );

          if (res.data.redirect) {
            window.location.href = res.data.redirect;
          }
          
        })
        .catch((err)=>{console.log(err)})
      e.preventDefault();

    })

</script>
</body>
</html>
