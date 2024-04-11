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
            <h4 class="m-0">View Product</h4>
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

    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Product Movement</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="section">

                    <div class="table-responsive">
                        <table id="ledger-table" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Date Posted</th>
                                    <th>Product Name</th>
                                    <th>UoM</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ledger as $row) : ?>
                                    <tr class="text-center">
                                        <td><?= $row->date_posted ?></td>
                                        <td><?= $row->product_name ?></td>
                                        <td><?= $product->product_uom ?></td>
                                        <td><?= $row->quantity ?></td>
                                        <td><?= $row->unit ?></td>
                                        <td>₱<?= $row->price ?></td>
                                        <td>
                                            <?php
                                            $activityBadgeClass = '';
                                            switch ($row->activity) {
                                                case 'Inbound':
                                                    $activityBadgeClass = 'badge bg-success';
                                                    break;
                                                case 'Outbound':
                                                    $activityBadgeClass = 'badge bg-danger';
                                                    break;
                                            }
                                            ?>
                                            <span class="<?= $activityBadgeClass ?>"><?= ucfirst($row->activity) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
</div>