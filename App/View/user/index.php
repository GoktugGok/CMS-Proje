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
            <h1 class="m-0">Profilim</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= _link('') ?>">Keşfet</a></li>
              <li class="breadcrumb-item"><a href="<?= _link('profil') ?>">Profilim</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
            <form id="profile">
                <div class="card-body">
                        <div class="form-group">
                            <label for="name">İsim</label>
                            <input type="text" class="form-control" id="name" value=" <?= sess('name')?>">
                        </div>           
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="surname">Soyisim</label>
                            <input type="text" class="form-control" id="surname" value=" <?=sess('surname')?>">
                        </div>           
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="email">E-Posta</label>
                            <input type="text" class="form-control" id="email" value=" <?=sess('email')?>">
                        </div>           
                </div>
                <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
            <form id="changepassword">
              <input type="hidden" id="customer_id"  value=" <?=sess('id')?>">
                <div class="card-body">
                        <div class="form-group">
                            <label for="password">Eski Şifreniz</label>
                            <input type="password" class="form-control" id="password" value="">
                        </div>           
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="new_password">Şifren</label>
                            <input type="password" class="form-control" id="new_password" value="">
                        </div>           
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="new_password_again">Şifre (Tekrar)</label>
                            <input type="password" class="form-control" id="new_password_again" value="">
                        </div>           
                </div>
                <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
            </div>
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
    const profile = document.getElementById('profile');
    const changepassword = document.getElementById('changepassword');

    profile.addEventListener('submit',(e) =>{
      let name = document.getElementById('name').value;
      let surname = document.getElementById('surname').value;
      let email = document.getElementById('email').value;



      let formData = new FormData();
      formData.append('name',name);
      formData.append('surname',surname);
      formData.append('email',email);


      axios.post('<?= _link('profil/guncelle') ?>',formData)
        .then(res=>{
          console.log(res)

          swal.fire(
            res.data.title,
            res.data.msg,
            res.data.status,
          );
         
        })
        .catch((err)=>{console.log(err)})
      e.preventDefault();

    })
    changepassword.addEventListener('submit',(e) =>{
      let password = document.getElementById('password').value;
      let new_password = document.getElementById('new_password').value;
      let new_password_again = document.getElementById('new_password_again').value;



      let formData = new FormData();
      formData.append('password',password);
      formData.append('new_password',new_password);
      formData.append('new_password_again',new_password_again);


      axios.post('<?= _link('profil/sifre') ?>',formData)
        .then(res=>{
          console.log(res)

          swal.fire(
            res.data.title,
            res.data.msg,
            res.data.status,
          );

          
          
        })
        .catch((err)=>{console.log(err)})
      e.preventDefault();

    })

</script>
</body>
</html>
