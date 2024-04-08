<style>
    /* Numeric Keypad Styles */
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
    }

    .numeric-button:hover {
        background-color: #ddd;
    }

    .clear-button {
        grid-column: span 1;
        background-color: #ff5555;
        color: #fff;
    }

    .payment-button {
        grid-column: span 3;
        padding: 15px;
        background-color: #EED11A;
        color: #fff;
    }

    .payment-button:hover {
        background-color: #C0A810;
    }

    .clear-button:hover {
        background-color: #cc0000;
    }

    .add-weight-button {
        background-color: #55cc55;
        color: #fff;
    }

    .add-weight-button:hover {
        background-color: #009900;
    }

    #cart-items {
        max-height: 450px;
        /* Adjust the height as needed */
        overflow-y: auto;
    }

    .selected-item {
        background-color: #d9edf7;
    }

    .delete-item {
        cursor: pointer;
    }

    #product-list {
        white-space: nowrap;
        /* Prevent line breaks */
        overflow-x: auto;
        /* Add horizontal scroll if necessary */
    }

    /* Add margin to each product card in the horizontal list */
    #product-list .d-inline-block {
        margin-right: 8px;
        /* Adjust the margin to your preference */
    }

    .total-price {
        font-weight: bold;
    }

    .card-title {
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 90%;
        /* Adjust the maximum width as needed */
    }

    .product-card {
        width: 280px;
        height: 300px;
        border-radius: 12px;
        position: relative;
    }

    .card {
        margin: 10px auto;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Column - Product List -->
            <div class="col-md-8">
                <div class="card shadow" style="max-height: 100vh; overflow-y: auto;">
                    <div class="card-header">
                        <h3>Product List</h3>
                        <!-- Add the search input and button inside the card header -->
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" id="product-search" placeholder="Search for a product">
                            <button class="btn btn-success" id="search-button">Search</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="product-table">
                            <thead>
                                <tr class="text-center">
                                    <th>Product Name</th>
                                    <th>UoM</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="product-list-body" class="text-center">
                                <?php foreach ($result as $product) { ?>
                                    <tr class="product-row" data-product-name="<?php echo $product->product_name; ?>" data-product-price="<?php echo $product->product_price; ?>" data-product-code="<?php echo $product->product_code; ?>" data-product-barcode="<?php echo $product->product_barcode; ?>">
                                        <td><?php echo $product->product_name; ?></td>
                                        <td><?php echo $product->product_uom; ?></td>
                                        <td>₱<?php echo $product->product_price; ?></td>
                                        <td><?php echo $product->product_quantity; ?></td>
                                        <td><button class="btn btn-success add-to-cart">Add to Cart</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav aria-label="Product Pagination">
                            <ul class="pagination justify-content-center" id="pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Right Column - Cart -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Cart</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="cart-items">
                            <table class="table table-bordered text-center" id="table_field">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Product Name</th>
                                        <th style="width: 15%;">Quantity</th>
                                        <th style="width: 20%;">Price</th>
                                        <th style="width: 20%;">Total</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row_content" id="row_product">
                                </tbody>
                            </table>
                        </ul>
                        <p class="total-price">Total Amount: ₱<span id="total">0.00</span></p>

                        <!-- Numeric Keypad for Weight Input -->
                        <div id="numeric-keypad">
                            <button class="btn btn-secondary numeric-button" data-key="1">1</button>
                            <button class="btn btn-secondary numeric-button" data-key="2">2</button>
                            <button class="btn btn-secondary numeric-button" data-key="3">3</button>
                            <button class="btn btn-secondary numeric-button" data-key="4">4</button>
                            <button class="btn btn-secondary numeric-button" data-key="5">5</button>
                            <button class="btn btn-secondary numeric-button" data-key="6">6</button>
                            <button class="btn btn-secondary numeric-button" data-key="7">7</button>
                            <button class="btn btn-secondary numeric-button" data-key="8">8</button>
                            <button class="btn btn-secondary numeric-button" data-key="9">9</button>
                            <button class="btn btn-secondary numeric-button" data-key="0">0</button>
                            <button class="btn btn-secondary numeric-button" data-key=".">.</button>
                            <button class="btn btn-secondary clear-button">Clear</button>
                            <a href="<?php echo site_url('main/payment'); ?>" class="btn btn-success payment-button">
                                Payment <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this script at the end of your page, after including jQuery -->
    <script>
        $(document).ready(function() {
            // Variables for pagination
            var currentPage = 1;
            var productsPerPage = 10;
            var totalProducts = <?php echo count($result); ?>;
            var totalPages = Math.ceil(totalProducts / productsPerPage);
            var productsData = <?php echo json_encode($result); ?>;

            // Function to display products for the current page
            function displayProducts() {
                var startIndex = (currentPage - 1) * productsPerPage;
                var endIndex = startIndex + productsPerPage;
                var filteredProducts = productsData;

                // Filter products based on search term (product name or product code)
                var searchTerm = $('#product-search').val().toLowerCase().trim();
                if (searchTerm !== '') {
                    filteredProducts = productsData.filter(function(product) {
                        return product.product_name.toLowerCase().includes(searchTerm) || product.product_code.toLowerCase().includes(searchTerm) || product.product_barcode.toLowerCase().includes(searchTerm);
                    });
                }

                // Slice the filtered products based on pagination
                var productsToDisplay = filteredProducts.slice(startIndex, endIndex);

                $('#product-list-body').empty();
                productsToDisplay.forEach(function(product) {
                    var productRow = '<tr class="product-row" data-product-name="' + product.product_name + '" data-product-price="' + product.product_price + '" data-product-code="' + product.product_code + '" data-product-barcode="' + product.product_barcode + '">';
                    productRow += '<td style="font-size: 12px; font-weight: bold">' + product.product_name + '</td>';
                    productRow += '<td>' + product.product_uom + '</td>';
                    productRow += '<td>' + '₱' + product.product_price + '</td>';
                    productRow += '<td>' + product.product_quantity + '</td>';
                    productRow += '<td><button class="btn btn-success add-to-cart">Add to Cart</button></td>';
                    productRow += '</tr>';
                    $('#product-list-body').append(productRow);
                });

                // Update pagination
                updatePagination();
            }

            // Function to update pagination
            // Function to update pagination
            function updatePagination() {
                $('#pagination').empty();

                var maxPagesToShow = 10; // Maximum number of pages to display at once
                var startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
                var endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

                for (var i = startPage; i <= endPage; i++) {
                    var liClass = (i === currentPage) ? 'page-item active' : 'page-item';
                    var pageLink = '<li class="' + liClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                    $('#pagination').append(pageLink);
                }

            }

            // Pagination click event
            $('#pagination').on('click', '.page-link', function(event) {
                event.preventDefault();
                currentPage = parseInt($(this).data('page'));
                displayProducts();
            });

            // Initial display of products and pagination
            displayProducts();

            // Pagination click event
            $('#pagination').on('click', '.page-link', function(event) {
                event.preventDefault();
                currentPage = parseInt($(this).text());
                displayProducts();
            });

            // Search button click event
            $('#search-button').on('click', function() {
                currentPage = 1; // Reset to the first page when searching
                displayProducts();
            });

            // Search input keyup event for live search
            $('#product-search').on('input', function() {
                currentPage = 1; // Reset to the first page when searching
                displayProducts();
            });

            // Add to Cart button click event remains unchanged
            $('#product-table').on('click', '.add-to-cart', function() {
                var productName = $(this).closest('.product-row').data('product-name');
                var productPrice = parseFloat($(this).closest('.product-row').data('product-price'));

                // Check if the product is already in the cart
                if (isProductInCart(productName)) {
                    toastr.error('This product is already in the cart.');
                    return; // Exit the function to prevent adding duplicates
                }

                // Create a new cart item element with quantity input
                var cartItem = $('<tr data-product-name="' + productName + '" data-product-price="' + productPrice.toFixed(2) + '"></tr>');
                cartItem.append('<td>' + productName + '</td>');
                cartItem.append('<td><input class="form-control form-control-sm product-quantity" type="number" value="1" min="0"></td>');
                cartItem.append('<td>₱' + productPrice.toFixed(2) + '</td>');
                cartItem.append('<td class="product-total">' + productPrice.toFixed(2) + '</td>');
                cartItem.append('<td><button class="btn btn-danger delete-item">Delete</button></td>');

                // Append the cart item to the cart table
                $('#table_field tbody').append(cartItem);

                // Update the total price in the cart
                updateTotal();

                // Store the cart items in localStorage
                updateLocalStorage();
            });

            // Function to update localStorage with cart items
            function updateLocalStorage() {
                var cartItems = [];

                // Iterate through cart items and store them in an array
                $('#table_field tbody').find('tr').each(function() {
                    var item = {
                        productName: $(this).data('product-name'),
                        productPrice: parseFloat($(this).data('product-price')),
                        quantity: parseFloat($(this).find('.product-quantity').val())
                    };
                    cartItems.push(item);
                });

                // Store the cart items array in localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }

            // Event handler for updating quantities and calculating total prices
            $('#table_field tbody').on('input', '.product-quantity', function() {
                // Update the quantity in the localStorage
                updateLocalStorage();

                var quantity = parseFloat($(this).val());
                var productPrice = parseFloat($(this).closest('tr').data('product-price'));
                var totalPrice = quantity * productPrice;

                // Update the total price and individual product's total
                $(this).closest('tr').find('.product-total').text(totalPrice.toFixed(2));
                updateTotal();
            });

            // Event handler for deleting items from the cart
            $('#table_field tbody').on('click', '.delete-item', function() {
                var listItem = $(this).closest('tr');
                var itemPrice = parseFloat(listItem.data('product-price'));
                var quantity = parseFloat(listItem.find('.product-quantity').val());

                // Calculate the total price of the item being deleted
                var totalPriceOfItem = itemPrice * quantity;

                // Update the total price by subtracting the total price of the item
                updateTotal(-totalPriceOfItem);

                // Remove the item from the cart
                listItem.remove();

                // Update localStorage after removing the item
                updateLocalStorage();
            });

            // Function to update the total price when adding or deleting items from the cart
            function updateTotal(change = 0) {
                // Calculate and update the total price for all products in the cart
                var total = 0;
                $('#table_field tbody').find('tr').each(function() {
                    var productPrice = parseFloat($(this).data('product-price'));
                    var quantity = parseFloat($(this).find('.product-quantity').val());
                    quantity = isNaN(quantity) ? 0 : quantity; // Ensure quantity is a valid number
                    var totalPrice = quantity * productPrice;
                    total += totalPrice;
                    // Update the individual product's total
                    $(this).find('.product-total').text(totalPrice.toFixed(2));
                });

                // Add the change to the total (if any)
                total += change;

                $('#total').text(total.toFixed(2));

                // Store the total price in localStorage
                localStorage.setItem('totalPriceForCheckout', total);
            }

            // Function to check if a product is already in the cart
            function isProductInCart(productName) {
                var inCart = false;
                $('#table_field tbody').find('tr').each(function() {
                    var cartProductName = $(this).data('product-name');
                    if (cartProductName === productName) {
                        inCart = true;
                        return false; // Exit the loop early since we found a match
                    }
                });
                return inCart;
            }

            // Event handler for clearing all quantities when the "Clear" button is clicked
            $('#numeric-keypad .clear-button').on('click', function() {
                // Set the quantity to zero for all rows in the cart
                $('.product-quantity').val(0);
                // Trigger the input event to recalculate totals
                $('.product-quantity').trigger('input');
            });

            // Event handler for clearing the quantity of a specific row
            $('#table_field tbody').on('click', '.clear-row', function(event) {
                event.stopPropagation(); // Stop the event from propagating to the parent elements
                var row = $(this).closest('tr');
                // Set the quantity to zero for the specific row
                row.find('.product-quantity').val(0);
                // Trigger the input event to recalculate totals
                row.find('.product-quantity').trigger('input');
            });

            // Event handler for checking if the cart is empty before allowing payment
            $('#numeric-keypad .payment-button').on('click', function() {
                if ($('#table_field tbody tr').length === 0) {
                    toastr.error('Please add items to the cart before proceeding to payment.');
                    return false; // Prevent the default behavior (e.g., following the link)
                }
            });

        });

        // Event handler for numeric keypad buttons
        $('#numeric-keypad .numeric-button').on('click', function() {
            var key = $(this).data('key');
            var selectedQuantityField = $('.selected-quantity');

            if (key === 'Clear') {
                // Clear the quantity field
                selectedQuantityField.val(0);
            } else {
                // Append the pressed key to the quantity field
                var currentValue = selectedQuantityField.val();
                selectedQuantityField.val(currentValue + key);
            }

            // Trigger the input event to recalculate totals
            selectedQuantityField.trigger('input');
        });

        // Event handler for selecting a quantity field in the cart
        $('#table_field tbody').on('click', '.product-quantity', function() {
            // Remove the "selected-item" class from all quantity fields
            $('.product-quantity').removeClass('selected-quantity');

            // Add the "selected-item" class to the clicked quantity field
            $(this).addClass('selected-quantity');
        });
    </script>
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) { ?>
                toastr.success('<?php echo $this->session->flashdata('success'); ?>');
            <?php } elseif ($this->session->flashdata('error')) { ?>
                toastr.error('<?php echo $this->session->flashdata('error'); ?>');
            <?php } ?>
        });
    </script>
</body>