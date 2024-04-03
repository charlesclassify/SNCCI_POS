<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Company</title>

  <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/logogfi.png" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CSS (version 5.15.4) from CDN -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

  <!-- jQuery (version 3.6.0) from CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <link href="<?= base_url('assets/css/styles1.css'); ?>" rel="stylesheet" />

</head>

<style>
  /* Success notification style */
  .toast-success {
    background-color: #28a745 !important;
    /* Green background color */
  }

  /* Error notification style */
  .toast-error {
    background-color: #dc3545 !important;
    /* Red background color */
  }

  /* Warning notification style */
  .toast-warning {
    background-color: #ffc107 !important;
    /* Yellow background color */
  }

  /* Active sidebar item style */
  .nav-link.active {
    background-color: #BF3131;
    /* Change the background color to red */
    color: white;
    /* Optionally change text color */
  }

  /* Adjusting nested sidebar items */
  .sb-sidenav-menu-nested .nav-link.active {
    margin-left: -25px;
    /* Adjust margin to align nested items with parent */
    text-align: center;
  }

  /* Hide icon on mobile devices */
  @media only screen and (max-width: 767px) {
    .small-box .icon {
      display: none;
    }
  }

  /* Hide icon on mobile devices */
  @media only screen and (max-width: 767px) {
    .user-greeting {
      display: none;
    }
  }
</style>

<script>

</script>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-light bg-light ">
    <!-- Navbar Brand-->
    <a href="<?= base_url('main') ?>" class="brand-link d-flex align-items-center exclude-from-highlight">
      <img src="<?= base_url('assets/images/gf.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 10.0; max-width: 90%; max-height: 65px" />
    </a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
      <i class="fas fa-bars text-dark"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
    <!-- Navbar-->
    <span class="user-greeting text-dark">Hi,
      <?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?>! &nbsp;
    </span>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-dark "></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="<?= base_url('main/logout') ?>">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">General</div>

            <a id="nav-link" class="nav-link" href="<?= base_url('main/dashboard') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt text-dark"></i>
              </div>
              Dashboard
            </a>

            <a id="nav-link" class="nav-link" href="<?= base_url('main/user') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-user text-dark"></i>
              </div>
              User
            </a>
            <a id="nav-link" class="nav-link" href="<?= base_url('main/supplier') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-truck text-dark"></i>
              </div>
              Supplier
            </a>
            <a id="nav-link" class="nav-link" href="<?= base_url('main/product') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-box text-dark"></i>
              </div>
              Product
            </a>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon">
                <i class="fas fa-archive text-dark"></i>
              </div>
              Inventory
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div class="collapse bg-secondary" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link text-white" href="<?= base_url('main/inventory_adjustment') ?>">Inventory Adjustment</a>
                <a class="nav-link text-white" href="<?= base_url('main/inventory_ledger') ?>">Inventory Ledger</a>
              </nav>
            </div>

            <a id="nav-link" class="nav-link" href="<?= base_url('main/pos') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-cash-register text-dark"></i>
              </div>
              POS
            </a>
            <a id="nav-link" class="nav-link" href="<?= base_url('main/reports') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-chart-bar text-dark"></i>
              </div>
              Reports
            </a>

            <a id="nav-link" class="nav-link" href="<?= base_url('main/backup') ?>">
              <div class="sb-nav-link-icon">
                <i class="fas fa-database text-dark"></i>
              </div>
              Backup & Restore
            </a>

          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">