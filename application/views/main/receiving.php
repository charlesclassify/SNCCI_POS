<style>
    .modal-header {
        background-color: #008081;
    }

    .modal-title {
        color: white;
    }

    .form-group {
        margin: 10px;
    }
</style>


<form id="receivingForm" action="<?= site_url('main/receive_quantity/' . $product->product_id); ?>" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="staticBackdropReceiving" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Product Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-7 d-inline-block">
                        <label for="product_name" class="bold-label">Product Name: <strong><?= $product->product_name ?> </strong></label>
                    </div>
                    <div class="form-group col-7 d-inline-block">
                        <label for="product_quantity" class="bold-label">Current Quantity: <strong><?= $product->product_quantity ?></strong></label>
                    </div>
                    <div class="form-group col-11 d-inline-block">

                        <input type="number" id="product_quantity" name="product_quantity" class="form-control form-control text" placeholder="Enter Quantity" min="1" required>
                    </div>
                    <div class="form-group col-11 d-inline-block">
                        <label class="bold-label">Supplier</label>
                        <select class="form-control form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Supplier" name="supplier" required>
                            <option value="" selected hidden>Select Supplier</option>
                            <?php foreach ($suppliers as $supp) { ?>
                                <option value="<?= $supp->supplier_name ?> - <?= $supp->company_name ?>"><?= $supp->supplier_name ?> - <?= $supp->company_name ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-11 d-inline-block">
                        <label for="product_image" class="bold-label">Upload Image (Optional)</label>
                        <input type="file" id="product_image" name="product_image" value="<?= set_value('product_image'); ?>" class="form-control <?= form_error('product_image') ? 'is-invalid' : ''; ?>">
                        <span style="color: red;"><?= form_error('product_image'); ?></span>
                    </div>


                    <div class="form-group col-11 d-inline-block">
                        <label for="comments" class="bold-label">Comments</label>
                        <input type="text" id="comments" name="comments" class="form-control form-control text" placeholder="Enter Comments" required>
                    </div>

                    <input type="hidden" name="product_id" class="form-control form-control text" placeholder="Enter Quantity" required>
                    <div class="modal-footer">
                        <button type="submit" onclick="return confirm('Are you sure you want to add quantity to this product?')" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <input type="hidden" name="rn" class="form-control form-control text" value="<?= $rn ?>" required>
                <input type="hidden" name="product_name" id="product_name" class="form-control form-control text" value="<?= $product->product_name ?>" required>
                <input type="hidden" name="product_code" id="product_code" class="form-control form-control text" value="<?= $product->product_code ?>" required>
                <input type="hidden" name="product_id" class="form-control form-control text" value="<?= $product->product_id ?>" required>
                <input type="hidden" name="product_uom" class="form-control form-control text" value="<?= $product->product_uom ?>" required>
                <input type="hidden" name="username" class="form-control form-control text" value="<?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?>" required>

            </div>
        </div>
    </div>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Place your script code here
        document.getElementById('receivingForm').addEventListener('submit', function(event) {
            // Prevent default form submission behavior
            event.preventDefault();

            // Retrieve form values
            var productCode = $("#product_code").val();
            var productName = $("#product_name").val();
            var quantity = $("#product_quantity").val();
            var comments = $("#comments").val();

            // Construct an object with form data
            var inbound = {
                product_code: productCode,
                product_name: productName,
                product_quantity: quantity,
                comments: comments
            };

            // Store the object in local storage
            localStorage.setItem('inbound', JSON.stringify(inbound));

            // Log the stored data
            console.log('Data stored in local storage:');
            console.log(inbound);

            // Proceed with form submission
            this.submit();
        });

        // Check if local storage contains the data
        var inboundData = localStorage.getItem('inbound');
        if (inboundData) {
            // Parse the JSON string back to an object
            var inbound = JSON.parse(inboundData);

            // Use the data as needed, e.g., populate form fields
            $("#product_code").text(inbound.product_code);
            $("#product_name").text(inbound.product_name);
            $("#product_quantity").text(inbound.product_quantity);
            $("#comment").text(inbound.comments);

            // Logging retrieved data
            console.log('Data retrieved from local storage:');
            console.log(inbound);
        } else {
            console.log('No data found in local storage.');
        }
    });
</script>