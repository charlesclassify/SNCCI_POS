<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

  <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/logogfi.png" />

  <link rel="stylesheet" href="fonts/icomoon/style.css" />

  <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css'); ?>" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href=" <?php echo base_url('assets/css/bootstrap.min.css'); ?>" />

  <!-- Style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/stylers.css '); ?>" />

  <title>Gensan Feedmill</title>
</head>
<style>
  .btn.btn-block {
    border-radius: 20px;
    background-color: #61AE55;
    color: #fff;
  }

  .btn.btn-block:hover {
    background-color: #C7AB59;
  }

  .h4 {
    font-family: 'Poppins', sans-serif;
    text-align: center;
    margin-bottom: 20px;
  }

  .logo {
    width: 100%;
    /* Adjust size as needed */
    height: auto;
    /* Maintain aspect ratio */

  }
</style>

<body>
  <form method="post" autocomplete="on" action="<?= base_url('main/login_submit') ?>">
    <div class="d-lg-flex half">
      <div class="bg order-1 order-md-2">
        <video autoplay muted loop id="bg-video">
          <source src="<?php echo base_url('assets/images/gfi.mp4'); ?>" type="video/mp4">
        </video>
      </div>
      <div class="contents order-2 order-md-1">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7">
              <div class="mb-4">
                <h3> <img src="<?php echo base_url('assets/images/GFI.jpg'); ?>" alt="Southwinds Hotel Logo" class="logo"></h3>
              </div>
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" />
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <button type="submit" class="btn btn-block text-center my-3">Log in</button>
              <?php
              if ($this->session->flashdata('error')) { ?>
                <p class="text-danger text-center" style="margin-top: 10px;">
                  <?= $this->session->flashdata('error') ?>
                </p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/main.js '); ?>"></script>
</body>

</html>