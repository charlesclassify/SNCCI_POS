<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>FISH PORT</title>
</head>
<style>
  body {
    background-image: url(<?php echo base_url('assets/images/porteportnew.png'); ?>);
    background-position: center;
    /* Center the image */
    background-repeat: no-repeat;
    /* Do not repeat the image */
    background-size: cover;
  }
</style>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="card" style="margin-top: 30px">
          <div class="card-header text-center">
            Register Now
          </div>
          <div class="card-body">
            <form method="post" autocomplete="off" action="<?= base_url('port/registerNow') ?>">
              <div class="mb-3">
                <label for="exampleInputusername" class="form-label">First Name</label>
                <input type="text" placeholder="First Name" name="first_name" class="form-control" id="first_name" aria-describedby="name">
              </div>
              <div class="mb-3">
                <label for="exampleInputlastname" class="form-label">Last Name</label>
                <input type="text" placeholder="Last Name" name="last_name" class="form-control" id="last_name" aria-describedby="name">
              </div>
              <div class="mb-3">
                <label for="exampleInputlastname" class="form-label">Username</label>
                <input type="text" placeholder="Username" name="username" class="form-control" id="username" aria-describedby="name">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="mb-3">
                <label for="exampleInputrole" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" aria-label="Default select example">
                  <option selected hidden>Select Role</option>
                  <option value="encoder">Encoder</option>
                  <option value="cashier">Cashier</option>
                  <option value="auditor">Auditor</option>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Register Now</button>
              </div>
              <?php
              if ($this->session->flashdata('success')) {  ?>
                <p class="text-success text-center" style="margin-top: 10px;"> <?= $this->session->flashdata('success') ?></p>
              <?php } ?>

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>