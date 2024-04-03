<h4>User Management</h4>

<div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
  <div class="card-header">
    <a href="<?php echo site_url('main/add_user'); ?>" class="btn btn-success btn-sm "><i class="fas fa-user-plus"></i>
      Add User </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-stripped table-sm" id="user-datatables">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($result) && !empty($result)) {
            $count = 1;
            foreach ($result as $key => $row) {
              $user_id = $row->user_id;
          ?>
              <tr class="text-center">
                <td>
                  <?php echo $count++; ?>
                </td>
                <td>
                  <?php echo $row->username; ?>
                </td>
                <td>
                  <?php echo $row->first_name; ?>
                </td>
                <td>
                  <?php echo $row->last_name; ?>
                </td>
                <td>
                  <?php echo ucfirst($row->role); ?>
                </td>
                <td>


                  <?php if ($row->status == "deactivated") { ?>

                    <span class="badge bg-danger">
                      <?= ucfirst($row->status) ?>
                    </span>

                  <?php
                  } else {
                  ?>
                    <span class="badge bg-success">
                      <?= ucfirst($row->status) ?>
                    </span>

                  <?php
                  } ?>
                </td>
                <td>
                  <a href="<?php echo site_url('main/edit_user/' . $user_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit user details"><i class="fas fa-edit"></i></a>

                  <?php {
                  ?>
                    <?php $status = $row->status;
                    if ($status == 'active') { ?>
                      <a href="<?php echo site_url('main/deactivate_user/' . $user_id); ?>" style="color:red; padding-left:6px;" title="Click here to deactivate this user" onclick="return confirm('Are you sure you want to deactivate user?')"><i class="fas fa-ban"></i></a>
                    <?php } else { ?>
                      <a href="<?php echo site_url('main/reactivate_user/' . $user_id); ?>" style="color:green; padding-left:6px;" title="Click here to activate this user" onclick="return confirm('Are you sure you want to reactivate user?')"><i class="fas fa-check-circle"></i></a>
                    <?php } ?>
                  <?php
                  }
                  ?>


                </td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    <?php if ($this->session->flashdata('success')) { ?>
      toastr.success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } elseif ($this->session->flashdata('error')) { ?>
      toastr.error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>
  });
</script>