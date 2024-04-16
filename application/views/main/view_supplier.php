<style>
    label {
        font-weight: bold;
    }

    h3,
    h4 {
        color: #008081;
    }
</style>
<div class="container mt-3">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">View Supplier</h4>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Supplier Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="supplier-name">Supplier Name</label>
                        <p id="supplier-name"><?= $supplier->supplier_name ?></p>
                    </div>
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <p id="company-name"><?= $supplier->company_name ?></p>
                    </div>
                    <div class="form-group">
                        <label for="supplier-contact">Contact</label>
                        <p id="supplier-contact"><?= $supplier->supplier_contact ?></p>
                    </div>
                    <div class="form-group">
                        <label for="supplier-email">Email</label>
                        <p id="supplier-email"><?= $supplier->supplier_email ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="supplier-address">Address</label>
                        <p id="supplier-address">
                            <?= $supplier->supplier_street ?><br>
                            <?= $supplier->supplier_barangay ?><br>
                            <?= $supplier->supplier_city ?>, <?= $supplier->supplier_province ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-left">
                <a class="btn btn-secondary" href="<?= base_url('main/supplier') ?>">
                    <i class="fas fa-reply"></i> Back to Suppliers
                </a>
            </div>
        </div>
    </div>
</div>