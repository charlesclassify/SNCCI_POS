<style>
    .bold-label {
        font-weight: bold;
    }

    h1 {
        text-align: center;
    }


    @media (max-width: 767px) {
        h1 {
            margin-left: 0;
        }
    }
</style>

<div class="container mt-3">
    <h1>Product Registration</h1>
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this product?\')')); ?>

                <div class="form-sm col-2 d-inline-block">
                    <label for="product_code" class="bold-label">Product Code</label>
                    <input type="text" id="product_code" name="product_code" value="<?= $product_code ?>" class="form-control form-control-sm text" readonly>
                </div>
                <div class="form-group-sm col-2 d-inline-block">
                    <label class="bold-label">Date Added</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="product_dateadded" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group-sm col-4 d-inline-block">
                    <label class="bold-label">Product Name</label>
                    <input type="text" placeholder="Product Name" name="product_name" value="<?php echo set_value('product_name'); ?>" class="form-control form-control-sm" required>
                    <?php echo form_error('product_name'); ?>
                </div>
                <div class="form-group-sm col-3 d-inline-block">
                    <label class="bold-label">Preferred Supplier</label>
                    <select class="form-control form-control-sm selectpicker" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Supplier" name="supplier_id" required>
                        <option value="" selected hidden>Select Supplier</option>
                        <?php foreach ($suppliers as $supp) { ?>
                            <option value="<?= $supp->supplier_id ?>"><?= $supp->supplier_name ?> - <?= $supp->company_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group-sm col-4 d-inline-block">
                    <br>
                    <label class="bold-label">Barcode</label>
                    <input type="text" placeholder="Barcode" name="product_barcode" min="0" value="<?php echo set_value('product_barcode'); ?>" class="form-control form-control-sm" id="product_barcode" required><br />
                    <?php echo form_error('product_barcode'); ?>
                </div>
                <div class="form-group-sm col-4 d-inline-block">
                    <label class="bold-label">Product Category</label>
                    <select class="form-control form-control-sm selectpicker" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select category" name="product_category" required>
                        <option value="" selected hidden>Select Product Category</option>
                        <option>Hardware</option>
                        <option>Food</option>
                        <option>Medicine</option>
                    </select> <br />
                </div>
                <div class="form-group-sm col-2 d-inline-block">
                    <label class="bold-label">Margin (%)</label>
                    <input type="number" placeholder="Margin" name="product_margin" min="0" value="10" class="form-control form-control-sm" id="product-margin" required> <br />
                    <?php echo form_error('product_margin'); ?>
                </div>
                <div class="form-group-sm col-3 d-inline-block">
                    <label class="bold-label">VAT</label>
                    <select class="form-control form-control-sm" name="product_vat" required>
                        <option value="" selected hidden>Select Tax</option>
                        <option>12%</option>
                        <option>Non-VAT</option>
                    </select>
                </div>
                <div class="form-group col-3 d-inline-block">
                    <label class="bold-label">Inbound Threshold <i class="fa fa-question-circle" title="* Minimum quantity to trigger reordering"></i></label>
                    <input type="number" placeholder="Enter Quantity" name="product_inbound_threshold" min="0" value="<?php echo set_value('product_inbound_threshold'); ?>" class="form-control form-control-sm" id="product_inbound_threshold" pattern="[1-9][0-9]*([.,][0-9]+)?" title="Please enter a valid number" required>
                    <?php echo form_error('product_inbound_threshold'); ?>
                </div>
                <div class="form-group col-2 d-inline-block">
                    <label class="bold-label">Shelf life <i class="fa fa-question-circle" title="* Maximum no. of days this product can be stored"></i></label>
                    <input type="number" placeholder="Enter No. of Days" name="product_shelf_life" min="0" value="<?php echo set_value('product_shelf_life'); ?>" class="form-control form-control-sm" id="product_shelf_life" pattern="[1-9][0-9]*([.,][0-9]+)?" title="Please enter a valid number" required>
                    <?php echo form_error('product_shelf_life'); ?>
                </div>
                <div class="form-group col-3 d-inline-block">
                    <label class="bold-label">Recall Threshold from Expiry <i class="fa fa-question-circle" title="* No. of days from expiry to be returned to the supplier"></i></label>
                    <input type="number" placeholder="Enter Quantity" name="product_recall_threshold" min="0" value="<?php echo set_value('product_recall_threshold'); ?>" class="form-control form-control-sm" id="product_recall_threshold" pattern="[1-9][0-9]*([.,][0-9]+)?" title="Please enter a valid number" required>
                    <?php echo form_error('product_recall_threshold'); ?>
                </div>

                <div class="form-group col-3 d-inline-block">
                    <label class="bold-label">Minimum Quantity</label>
                    <input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_quantity" value="<?php echo set_value('product_minimum_quantity'); ?>" class="form-control form-control-sm" id="product_minimum_quantity" required>
                    <?php echo form_error('product_minimum_quantity'); ?>
                </div>
                <div class="form-group col-3 d-inline-block">
                    <label class="bold-label">Required Quantity</label>
                    <input type="number" placeholder="Enter Quantity" min="0" name="product_required_quantity" value="<?php echo set_value('product_required_quantity'); ?>" class="form-control form-control-sm" id="product_required_quantity" required>
                    <?php echo form_error('product_required_quantity'); ?>
                </div>
                <div class="form-group col-3 d-inline-block">
                    <label class="bold-label">Maximum Quantity</label>
                    <input type="number" placeholder="Enter Quantity" min="0" name="product_maximum_quantity" value="<?php echo set_value('product_maximum_quantity'); ?>" class="form-control form-control-sm" id="product_maximum_quantity" required>
                    <?php echo form_error('product_maximum_quantity'); ?>

                </div>

                <div class="section">
                    <h4>Inventory Information</h4>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Inbound Threshold</label>
                        <input type="number" placeholder="Enter Quantity" name="product_inbound_threshold" min="0" value="<?= set_value('product_inbound_threshold'); ?>" class="form-control" id="product_inbound_threshold" required>
                        <?= form_error('product_inbound_threshold'); ?>
                    </div>

                    <div class="form-group col-md-2 d-inline-block">
                        <label class="bold-label">Shelf life</label>
                        <input type="number" placeholder="Enter No. of Days" name="product_shelf_life" min="0" value="<?= set_value('product_shelf_life'); ?>" class="form-control" id="product_shelf_life" required>
                        <?= form_error('product_shelf_life'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Recall Threshold</label>
                        <input type="number" placeholder="Enter Quantity" name="product_recall_threshold" min="0" value="<?= set_value('product_recall_threshold'); ?>" class="form-control" id="product_recall_threshold" required>
                        <?= form_error('product_recall_threshold'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_quantity" value="<?= set_value('product_minimum_quantity'); ?>" class="form-control" id="product_minimum_quantity" required>
                        <?= form_error('product_minimum_quantity'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Required Quantity</label>
                        <input type number" placeholder="Enter Quantity" min="0" name="product_required_quantity" value="<?= set_value('product_required_quantity'); ?>" class="form-control" id="product_required_quantity" required>
                        <?= form_error('product_required_quantity'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Maximum Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_maximum_quantity" value="<?= set_value('product_maximum_quantity'); ?>" class="form-control" id="product_maximum_quantity" required>
                        <?= form_error('product_maximum_quantity'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Order Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_order_quantity" value="<?= set_value('product_minimum_order_quantity'); ?>" class="form-control" id="product_minimum_order_quantity" required>
                        <?= form_error('product_minimum_order_quantity'); ?>
                    </div>
                </div>

                <div class="section">
                    <h4>Image</h4>
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="product_image" class="bold-label">Product Image</label>
                        <input type="file" id="product_image" name="product_image" value="<?= set_value('product_image'); ?>" class="form-control <?= form_error('product_image') ? 'is-invalid' : ''; ?>" required>
                        <span style="color: red;"><?= form_error('product_image'); ?></span>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-transparent text-end">
                <div class="form-group col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear</button>
                    <a class="btn btn-secondary btn-sm" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>