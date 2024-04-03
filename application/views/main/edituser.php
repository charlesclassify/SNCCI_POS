<style>
	.card {
		width: 95%;
		/* Adjust the width as needed */
	}

	h4 {
		text-align: center;
	}

	@media (max-width: 767px) {
		h1 {
			margin-left: 0;
		}
	}
</style>

<div class="container mt-2">
	<h4>Edit User</h4>

	<!-- Flash Messages -->
	<?= $this->session->flashdata('add_user_submit'); ?>
	<?= $this->session->flashdata('add_user_error'); ?>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow">
				<div class="card-body">
					<?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to update this user?\')')); ?>

					<div class="form-group">
						<label for="username" class="bold-label">Username</label>
						<input type="text" id="username" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('username', $user->username); ?>">
						<?php echo form_error('username'); ?>
					</div>

					<div class="form-group">
						<label for="first_name" class="bold-label">First Name</label>
						<input type="text" id="first_name" name="first_name" class="form-control <?php echo form_error('first_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('first_name', $user->first_name); ?>">
						<?php echo form_error('first_name'); ?>
					</div>

					<div class="form-group">
						<label for="last_name" class="bold-label">Last Name</label>
						<input type="text" id="last_name" name="last_name" class="form-control <?php echo form_error('last_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('last_name', $user->last_name); ?>">
						<?php echo form_error('last_name'); ?>
					</div>

					<div class="form-group">
						<label for="password" class="bold-label">Password</label>
						<input type="password" id="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>">
					</div>

					<div class="form-group">
						<label for="password1" class="bold-label">Confirm Password</label>
						<input type="password" id="password1" placeholder="Confirm Password" name="password1" class="form-control <?php echo form_error('password1') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?php echo form_error('password1'); ?></span>
					</div>
					<div class="form-group">
						<label for="warehouse" class="bold-label">Warehouse</label><br>
						<select name="warehouse" id="warehouse-select" data-live-search="true" data-style="btn-sm btn-outline-secondary" class="form-control <?php echo form_error('warehouse') ? 'is-invalid' : ''; ?>">
							<option value="<?php echo set_value('warehouse', $user->warehouse); ?>" selected hidden><?php echo set_value('warehouse', $user->warehouse); ?></option>
							<option value="Warehouse 1">Warehouse 1</option>
						</select>
						<span class="text-danger"><?php echo form_error('warehouse'); ?></span>
					</div>
					<div class="form-group">
						<label for="role" class="bold-label">Roles</label><br>
						<select name="role" id="role-select" data-live-search="true" data-style="btn-sm btn-outline-secondary" class="form-select" <?php echo form_error('role') ? 'is-invalid' : ''; ?>">
							<option class="text-info invisible" value="<?= $user->role ?>"><?= ucfirst($user->role) ?></option>
							<option value="Admin">Admin</option>
							<option value="Inbound User">Inbound User</option>
							<option value="Outbound User">Outbound User</option>
						</select>
						<?php echo form_error('role'); ?>
					</div>

					<input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
					<!-- Add the other form fields in a similar manner -->

					<div class="mt-4">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
						<a class="btn btn-secondary" href="<?= base_url('main/user') ?>"><i class="fas fa-reply"></i> Back</a>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>