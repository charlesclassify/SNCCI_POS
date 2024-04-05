<style>
    .card {
        width: 95%;
        /* Adjust the width as needed */
        margin: 0 auto;
        /* Center the card on the page horizontally */
    }

    h4 {
        margin-left: 30px;
    }
</style>
<div class="container">
    <h4>Back-up & Restore</h4>

    <!-- Backup Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Backup Database</h3>
        </div>
        <div class="card-body">
            <a href="<?= site_url('main/export'); ?>" onclick="return confirm('Are you sure you want to backup your database?')" class="btn btn-primary">
                Backup</a>
        </div>
    </div>

    <!-- Restore Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Restore Databases</h3>
        </div>
        <div class="card-body">
            <form action="<?= site_url('main/restore'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="backupFile">Select Backup File:</label>
                    <input type="file" name="backupFile" id="backupFile" class="form-control-file" required>
                </div>
                <button type="submit" onclick="return confirm('Are you sure you want to restore your database?')" class="btn btn-primary">Restore</button>
            </form>
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