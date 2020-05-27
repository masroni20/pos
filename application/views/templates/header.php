<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?=$title;?> | Aplikasi POS (Pay Of Sale)</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?=base_url('assets');?>/plugins/fontawesome-free/css/all.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="<?=base_url('assets');?>/plugins/ionicons/css/ionicons.min.css">
 <!-- DataTables -->
 <link rel="stylesheet" href="<?=base_url('assets');?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="<?=base_url('assets');?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

 <!-- Theme style -->
 <link rel="stylesheet" href="<?=base_url('assets');?>/css/adminlte.min.css">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini text-sm <?=$this->uri->segment(1) == 'penjualan' ? 'sidebar-collapse' : '';?>">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="<?=base_url('assets');?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Aplikasi POS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?=base_url('assets');?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?=$this->fungsi->user_login()->nama;?> <small>(<?=$this->fungsi->user_login()->username;?>)</small></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar nav-compact nav-flat flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?=base_url();?>" class="nav-link <?=$this->uri->segment(1) == 'dashboard' ? 'active' : '';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('supplier');?>" class="nav-link <?=$this->uri->segment(1) == 'supplier' ? 'active' : '';?>">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('customer');?>" class="nav-link <?=$this->uri->segment(1) == 'customer' ? 'active' : '';?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-<?=$this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'unit' || $this->uri->segment(1) == 'item' ? 'open' : 'close';?>">
            <a href="#" class="nav-link <?=$this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'unit' || $this->uri->segment(1) == 'item' ? 'active' : '';?>">
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Produk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('kategori');?>" class="nav-link <?=$this->uri->segment(1) == 'kategori' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('unit');?>" class="nav-link <?=$this->uri->segment(1) == 'unit' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('item');?>" class="nav-link <?=$this->uri->segment(1) == 'item' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-<?=$this->uri->segment(1) == 'penjualan' || $this->uri->segment(2) == 'in' || $this->uri->segment(2) == 'out' ? 'open' : 'close';?> ">
            <a href="#" class="nav-link <?=$this->uri->segment(1) == 'penjualan' || $this->uri->segment(2) == 'in' || $this->uri->segment(2) == 'out' ? 'active' : '';?>">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('penjualan');?>" class="nav-link <?=$this->uri->segment(1) == 'penjualan' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('stok/in');?>" class="nav-link <?=$this->uri->segment(2) == 'in' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok In</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('stok/out');?>" class="nav-link <?=$this->uri->segment(2) == 'out' ? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok Out</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok</p>
                </a>
              </li>

            </ul>
          </li>
          <?php if ($this->fungsi->user_login()->level == 1): ?>
            <li class="nav-header">PENGATURAN</li>
            <li class="nav-item">
              <a href="<?=base_url('user');?>" class="nav-link <?=$this->uri->segment(1) == 'user' ? 'active' : '';?>">
               <i class="nav-icon fas fa-user"></i>
               <p>Pengguna</p>
             </a>
           </li>
         <?php endif;?>
         <li class="nav-item">
          <a href="<?=base_url('auth/logout');?>" class="nav-link">
           <i class="nav-icon fas fa-sign-out"></i>
           <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?=$title;?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
            <li class="breadcrumb-item active"><?=$this->uri->segment(1);?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
