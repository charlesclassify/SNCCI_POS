<style>
    label {
        font-weight: bold;
    }

    .bold-label {
        font-weight: bold;
    }

    .section {
        margin-bottom: 20px;
    }
</style>

<div class="container mt-3">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0 text-white">View Product</h4>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Product Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="section">

                    <div class="form-group col-md-3 d-inline-block">
                        <label for="date_created" class="bold-label">Date Updated</label>
                        <p><?= date('m-d-Y'); ?></p>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label for="product_code" class="bold-label">Product Code</label>
                        <p><?= $product->product_code; ?></p>
                    </div>

                    <div class="form-group col-md-5 d-inline-block">
                        <label class="bold-label">Product Name</label>
                        <p><?= $product->product_name; ?></p>
                        <?= form_error('product_name'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Preferred Supplier</label>
                        <p><?= $select->supplier_name; ?> - <?= $select->company_name; ?></p>
                    </div>


                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Product Brand</label>
                        <p><?= $product->product_brand; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Product Category</label>
                        <p><?= $product->product_category; ?></p>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Barcode</label>
                        <p><?= $product->product_barcode; ?></p>
                        <?= form_error('product_barcode'); ?>
                    </div>


                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Unit of Measure</label>

                        <p><?= $product->product_uom; ?></p>

                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Quantity</label>
                        <p><?= $product->product_minimum_quantity; ?></p>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Price</label>
                        <p>₱ <?= number_format($product->product_price, 2); ?></p>
                    </div>
                </div>



            </div>
        </div>
        <div class="card-footer">
            <div class="text-left">
                <a class="btn btn-secondary" href="<?= base_url('main/product') ?>">
                    <i class="fas fa-reply"></i> Back to Product
                </a>
            </div>
        </div>
    </div>
</div>