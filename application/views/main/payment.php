<style>
    #numeric-keypad {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 5px;
    }

    .numeric-button {
        font-size: 1.5rem;
        padding: 10px;
        text-align: center;
        background-color: #5a6268;
        border: 1px solid #ccc;
        cursor: pointer;
        color: #fff;
    }

    .numeric-button:hover {
        background-color: #ddd;
    }

    .clear-button,
    .checkout-button,
    .back-button {
        padding: 15px;
        color: #fff;
        font-weight: bold;
        font-size: larger;
    }

    .clear-button,
    .checkout-button {
        background-color: #FF0000;
    }

    .clear-button:hover,
    .checkout-button:hover {
        background-color: #C0A810;
    }

    .clear-button:hover {
        background-color: #C0A810;
    }

    .payment-button {
        grid-column: span 2;
        padding: 20px;
        background-color: #EED11A;
        color: #fff;
    }

    .payment-button:hover {
        background-color: #C0A810;
    }

    .back-button {
        grid-column: span 1;
        padding: 15px;
        background-color: #807F7E;
        color: #fff;
        font-weight: bold;
        font-size: larger;
    }

    .back-button:hover {
        background-color: #5E5B58;
    }
</style>
<?php echo form_open('', array('onsubmit' => 'return confirm(\'Are you sure you want to post this sales?\')')); ?>
<div class="card shadow" style="max-width: 2000px; margin: 0 auto; height: auto;">
    <div class="card-header text-center">
        <h2>Payment</h2>
    </div>
    <div class="card-body" style="flex-grow: 1; position: relative;">
        <div class="row">
            <div class="col-md-7 text-center">
                <div class="border p-3">
                    <p class="total-price" name="total_cost" style="font-size: 50px;">Total Amount: ₱<span id="total">0.00</span></p>
                    <div class="form-group">
                        <label for="customerName">Customer Name:</label>
                        <input type="text" class="form-control" name="customer_name" id="customerName" placeholder="Enter customer name" required>
                    </div>
                    <input type="hidden" value="<?= $ref_no ?>" name="reference_no" readonly class="form-control form-control-sm">
                    <input type="hidden" value="<?= date('Y-m-d'); ?>" name="date_created" readonly class="form-control form-control-sm">
                </div>

                <!-- Numeric Keypad for Weight Input -->
                <div id="numeric-keypad">
                    <a href="javascript:void(0);" class="btn btn-secondary back-button" onclick="confirmBack()"> Back <i class="fas fa-arrow-left"></i></a>
                    <input type="submit" value="Check Out" name="btn_add_sales" id="submit_pr" class="btn btn-warning payment-button">
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div>
                        <div class="card-body" id="buttong" style="max-height: 30vh; overflow-y: auto; display: flex; flex-direction: column; justify-content: space-between; color: #FFF;">
                            <table class="table table-bordered text-center" id="table_field">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Product Name</th>
                                        <th style="width: 15%;">Quantity</th>
                                        <th style="width: 20%;">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="row_content" id="row_product">
                                    <!-- Your table rows go here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script>
    function confirmBack() {
        var confirmMessage = "Are you sureyou want to go back and make new transactions?";

        // Display a confirmation dialog
        var userConfirmed = window.confirm(confirmMessage);

        // Check the user's choice
        if (userConfirmed) {
            // If the user clicked "OK," navigate back to the dashboard page
            window.location.href = "<?php echo site_url('main/pos'); ?>";
        }
        // If the user clicked "Cancel" or closed the dialog, stay on the payment page
    }
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success('<?php echo $this->session->flashdata('success'); ?>');
        <?php } elseif ($this->session->flashdata('error')) { ?>
            toastr.error('<?php echo $this->session->flashdata('error'); ?>');
        <?php } ?>
    });
    // Submit event handler for the form
    $(document).ready(function() {
        $('form').submit(function() {
            // Get the customer name entered by the user
            var customerName = $('#customerName').val();

            // Store the customer name in localStorage
            localStorage.setItem('customerName', customerName);
        });
    });
    $(document).ready(function() {
        var totalPriceForCheckout = localStorage.getItem('totalPriceForCheckout');
        var cashPayment = 0;

        if (totalPriceForCheckout !== null && totalPriceForCheckout !== undefined) {
            $('#total').text(parseFloat(totalPriceForCheckout).toFixed(2));
        } else {
            $('#total').text('N/A');
        }

        function loadCartItems() {
            var cartItems = localStorage.getItem('cartItems');

            if (cartItems) {
                cartItems = JSON.parse(cartItems);

                // Store cart items in a consistent key
                localStorage.setItem('paymentPageCartItems', JSON.stringify(cartItems));

                // Iterate through cart items and display them on the payment page
                cartItems.forEach(function(item) {
                    var cartItem = $('<tr data-product-name="' + item.productName + '" data-product-price="' + item.productPrice.toFixed(2) + '"></tr>');
                    cartItem.append('<td><input type="text" name="product[]" value="' + item.productName + '" class="form-control" readonly></td>');
                    cartItem.append('<td><input type="number" name="quantity[]" value="' + item.quantity + '" class="form-control product-quantity" readonly></td>');
                    cartItem.append('<td><input type="text" name="product_price[]" value="' + item.productPrice.toFixed(2) + '" class="form-control" readonly></td>');
                    // Append the cart item to the cart table
                    $('#table_field tbody').append(cartItem);
                });

                // Update the total price in the cart
                updateTotal();
            }
        }

        // Call the function to load cart items when the page is ready
        loadCartItems();

        // Intercept form submission to ensure proper data is sent
        $('form').submit(function() {
            // Ensure the form data is correctly populated before submitting
            var form = $(this);
            var formData = form.serializeArray();

            // Log form data to the console for debugging (optional)
            console.log(formData);

            // Add additional checks or adjustments to formData if needed

            return true; // Allow the form to be submitted
        });

    });
</script>