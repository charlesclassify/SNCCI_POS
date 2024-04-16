<?= $this->session->flashdata('success'); ?>
<?= $this->session->flashdata('error'); ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h4>Edit Location</h4>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('main/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">location</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->



<?php echo form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to update this data?\')')); ?>

<div class="panel panel-default text-center">
    <div class="panel-body">
        <div>
            <label>Location</label></br>
            <input type="text" name="location" class="form-control form-control-sm d-inline-block col-5" value="<?php echo set_value('location', $location->location); ?>">
        </div></br>
        <div>
            <button type="submit" name="submit" class="btn btn-primary btn-sm" class="form-submit"><i class="fas fa-save"></i> Submit</button>

            <a class="btn btn-secondary btn-sm" href="<?= base_url('main/location') ?>"><i class="fas fa-reply"></i> back</a>
        </div>
    </div>
    <input type="hidden" name="location_id" value="<?php echo $location->location_id; ?>">
</div>
</form>