<div class="row mb-2">
    <div class="col-sm-6">
        <h4>Add Location</h4>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('main/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">location</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->

<?php echo form_open_multipart('main/add_location'); ?>

<div class="panel panel-default text-center">
    <div class="panel-body">
        <div>
            <label>Location Name</label></br>
            <input type="text" placeholder="Enter Location Name" name="location" value="<?php echo set_value('location'); ?>" class="form-control form-control-sm d-inline-block col-5 text-center">
            <?php echo form_error('location'); ?>
        </div></br>
        <div>
            <button type="submit" name="submit" class="btn btn-primary btn-sm" class="form-submit"><i class="fas fa-save"></i> Submit</button>
            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear</button>
            <a class="btn btn-secondary btn-sm" href="<?= base_url('main/location') ?>"><i class="fas fa-reply"></i> back</a>
        </div>
    </div>
</div>