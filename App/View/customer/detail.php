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
  <link rel="stylesheet" href="<?=assets('plugins/summernote/summernote.min.css')?>">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">

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
      <div class="row d-flex justify-content-center">
      <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info ">
                <h3 class="widget-user-username mt-2"><?= $data['customer']['name']. ' '.$data['customer']['surname'] ?></h3>
                <h5 class="widget-user-desc mb-0"><?= $data['customer']['company']?></h5>
              </div>
              <div class="widget-user-image d-flex justify-content-center" style="width: 90px; font-size:40px;">
                <div>
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><a href="" style="color:black;"><?= count($data['projects'])?></a></h5>
                      <span class="description-text">Projeler</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                    <h5 class="description-header" style="font-size:14px;"><a href="mailto:" style="color:black;"><?= $data['customer']['email']?></a></h5>
                      <span class="description-text ">E-Posta</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><a href="tel:" style="color:black;"><?= $data['customer']['phone']?></a></h5>
                      <span class="description-text">Numara</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
      
          
      </div>
      <div class="row">
      <div class="col-md-6">
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
      <div class="col-md-6">
           <textarea id="summernote"><?= htmlspecialchars_decode($data['customer']['notes'])?></textarea>
           <button style="width: 100%;" class="btn btn-sm btn-dark" onclick="saveNote()">Kaydet</button>
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
<script src="<?=assets('plugins/summernote/summernote.min.js')?>"></script>

<!-- AdminLTE App -->
<script src="<?=assets('js/adminlte.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js" integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function (){
      $('#summernote').summernote({
        height: 190,
        placeholder: 'Müşterileriniz hakkında ilgili notlar alın.',
        toolbar: [
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']],
          ['view', ['codeview']]
        ]
      });
    })

    function saveNote(){
      const html = $('#summernote').summernote('code');

      let formData = new FormData();
      formData.append('html',html);

      axios.post('<?= _link('musteri/not/'.$data['customer']['id']) ?>',formData)
        .then(res=>{
          swal.fire(
            res.data.title,
            res.data.msg,
            res.data.status,
          );
        })
        .catch((err)=>{console.log(err)})
    }
</script>
</body>
</html>
