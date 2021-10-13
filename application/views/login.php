
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi POS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/custom.css');?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?=base_url();?>"><b>Aplikasi POS</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <!-- Notifikasi -->
        <?=$this->session->flashdata('pesan');?>

        <form action="<?=base_url('auth');?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control <?=form_error('username') ? 'is-invalid' : null;?>" name="username" placeholder="Username" value="<?=$this->form_validation->set_value('username');?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <?=form_error('username', '<span class="error invalid-feedback">', '</span>');?>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control <?=form_error('password') ? 'is-invalid' : null;?>" name="password" placeholder="Password" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <?=form_error('password', '<span class="error invalid-feedback">', '</span>');?>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

</body>
</html>
