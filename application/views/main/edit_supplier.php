<style>
    .card {
        width: 95%;
        /* Adjust the width as needed */
    }

    h4 {
        margin-left: 10px;
        color: #008081;
    }
</style>

<div class="container mt-2">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="custom-title">Edit Supplier</h4>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="card custom-card">
        <div class="card-body">
            <?= $this->session->flashdata('success'); ?>
            <?= $this->session->flashdata('error'); ?>

            <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to update this data?\')')); ?>

            <div class="custom-form-group">
                <label for="supplier_name" class="custom-label">Contact Persons Name</label>
                <input type="text" name="supplier_name" class="form-control custom-input <?php echo form_error('supplier_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_name', $supplier->supplier_name); ?>">
                <span style="color: red;"><?php echo form_error('supplier_name'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="company_name" class="custom-label">Company Name</label>
                <input type type="text" name="company_name" class="form-control custom-input <?php echo form_error('company_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('company_name', $supplier->company_name); ?>">
                <span style="color: red;"><?php echo form_error('company_name'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="supplier_contact" class="custom-label">Contact Number</label>
                <input type="tel" name="supplier_contact" maxlength="11" pattern="[0-9]+" class="form-control custom-input <?php echo form_error('supplier_contact') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_contact', $supplier->supplier_contact); ?>">
                <span style="color: red;"><?php echo form_error('supplier_contact'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="supplier_email" class="custom-label">Email</label>
                <input type="email" name="supplier_email" class="form-control custom-input <?php echo form_error('supplier_email') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_email', $supplier->supplier_email); ?>">
                <span style="color: red;"><?php echo form_error('supplier_email'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="supplier_street" class="custom-label">Street</label>
                <input type="text" name="supplier_street" class="form-control custom-input <?php echo form_error('supplier_street') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_street', $supplier->supplier_street); ?>">
                <span style="color: red;"><?php echo form_error('supplier_street'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="supplier_barangay" class="custom-label">Barangay</label>
                <input type="text" name="supplier_barangay" class="form-control custom-input <?php echo form_error('supplier_barangay') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_barangay', $supplier->supplier_barangay); ?>">
                <span style="color: red;"><?php echo form_error('supplier_barangay'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="supplier_city" class="custom-label">City</label>
                <input type="text" name="supplier_city" class="form-control custom-input <?php echo form_error('supplier_city') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_city', $supplier->supplier_city); ?>">
                <span style="color: red;"><?php echo form_error('supplier_city'); ?></span>
            </div>

            <div class="custom-form-group">
                <label for="supplier_province" class="custom-label">Province</label>
                <input type="text" name="supplier_province" class="form-control custom-input <?php echo form_error('supplier_province') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('supplier_province', $supplier->supplier_province); ?>">
                <span style="color: red;"><?php echo form_error('supplier_province'); ?></span>
            </div></br>

            <div class="custom-button-group">
                <button type="submit" name="submit" class="btn btn-primary btn-sm custom-button"><i class="fas fa-save"></i> Submit</button>
                <a class="btn btn-secondary btn-sm custom-button" href="<?= base_url('main/supplier') ?>"><i class="fas fa-reply"></i> Back</a>
            </div>
            <input type="hidden" name="supplier_id" value="<?php echo $supplier->supplier_id; ?>">
            <?= form_close(); ?>
        </div>
    </div>
</div>