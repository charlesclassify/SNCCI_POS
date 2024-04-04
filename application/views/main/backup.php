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
</div>