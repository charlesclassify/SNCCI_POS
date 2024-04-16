<style>
    h4 {
        color: #008081;
    }
</style>

<?php echo form_open_multipart('main/add_stock_submit', array('onsubmit' => 'return confirm(\'Are you sure you want to adjust this quantity?\')')); ?>
<div class="container">
    <h4 class="mt-4">Stock Adjustment</h4>
    <div class="card mt-4">
        <div class="card-body text-center">
            <div class="row justify-content-center">

                <div class="form-group col-md-3">
                    <label for="old_quantity">Old Quantity</label>
                    <input type="number" id="old_quantity" value="<?= set_value('product_quantity', $product->product_quantity); ?>" class="form-control form-control-sm text-center" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="adjust_quantity">Adjust Quantity</label>
                    <input type="number" id="adjust_quantity" name="product_quantity" min="0" class="form-control form-control-sm text-center" required>
                    <?= form_error('product_quantity'); ?>
                </div>
                <div class="form-group col-md-3">
                    <label for="reason">Reason</label>
                    <input type="text" id="reason" name="reason" class="form-control form-control-sm text-center" required>
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" value="Post" name="btn_post_gr" id="btn_post_gr" class="btn btn-sm btn-primary">
                <a href="<?php echo site_url('main/inventory_adjustment'); ?>"><input type="button" value="Back" class=" btn btn-secondary btn-sm"></a>
            </div>
            <input type="hidden" name="product_id" value="<?= $product->product_id; ?>">
        </div>
    </div>
</div>

<script>
    $(function() {
        // When the admin key button is clicked
        $('#admin-key-btn').on('click', function() {
            // Check if the Adjust Quantity and Reason fields are not empty
            var quantity = $('#adjust_quantity').val();
            var reason = $('#reason').val();
            if (quantity !== '' && reason !== '') {
                // Prompt for the admin password
                var adminPassword = prompt('Enter Admin Key:');
                if (adminPassword === 'elizhen123') {
                    // If the password is correct, submit the main form
                    $('#main-form').submit();
                } else {
                    // If the password is incorrect, show an alert
                    alert('Incorrect password. Please try again.');
                }
            } else {
                // If they are empty, show a Toastr notification
                toastr.error('Please fill all the fields.');
            }
        });
    });
</script>