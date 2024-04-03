<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .container {
        background: #f9f9f9;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: 50px auto 0;
        font-family: 'Source Sans Pro', sans-serif;
        position: relative;
        /* Added position relative */
    }

    .receipt_header {
        text-align: center;
        margin-bottom: 15px;
    }

    .receipt_header h1 {
        font-size: 24px;
        margin-bottom: 5px;
        color: #333;
        text-transform: uppercase;
    }

    .receipt_header h2 {
        font-size: 14px;
        color: #777;
        font-weight: 300;
    }

    .receipt_body {
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: none;
        padding: 8px;
        text-align: left;
    }

    .recepit_cont,
    .customer_cont {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }

    h3 {
        color: #333;
        border-top: 1px dashed #333;
        padding-top: 10px;
        margin-top: 15px;
        text-align: center;
        text-transform: uppercase;
        font-size: 12px;
    }

    .print-button {
        color: #333;
        display: block;
        text-align: center;
        margin-top: 15px;
        font-size: 16px;
        cursor: pointer;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .container,
        .container * {
            visibility: visible;
        }

        /* Adjustments for printing */
        .container {
            max-width: 300px;
            /* Set the max-width for the receipt */
            width: 100%;
            /* Make sure the receipt occupies the full width of the printed page */
            margin: 0 auto;
            /* Center the receipt on the printed page */
            padding: 10px;
            /* Add some padding */
            border: 1px solid #333;
            /* Add a border for a bordered appearance */
            box-shadow: none;
            /* Remove the box shadow */
            position: static;
            /* Set position to static */
        }

        .receipt_header h1 {
            font-size: 20px;
            /* Decrease the font size of the header */
            margin-bottom: 3px;
            /* Adjust the margin */
        }

        .receipt_header h2 {
            font-size: 12px;
            /* Decrease the font size of the sub-header */
            margin-bottom: 10px;
            /* Adjust the margin */
        }

        .receipt_body {
            margin-top: 5px;
            /* Adjust the margin */
        }

        table {
            margin-top: 5px;
            /* Adjust the margin */
        }

        th,
        td {
            padding: 5px;
            /* Adjust the padding */
        }

        .recepit_cont,
        .customer_cont {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 12px;
            /* Decrease the font size */
        }

        .recepit_cont div,
        .customer_cont div {
            flex-basis: 48%;
            /* Adjust the width */
        }

        h3 {
            margin-top: 10px;
            /* Adjust the margin */
            font-size: 10px;
            /* Decrease the font size */
        }

        .print-button {
            display: none;
            /* Hide the print button when printing */
        }
    }

    /* Additional CSS for displaying customer name on the same line */
    .customer_cont {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        align-items: baseline;
        /* Align items to the baseline */
    }

    .customer_cont div {
        flex-basis: 30%;
        /* Adjust the width as needed */
    }

    .customer_cont #customer {
        flex-basis: 70%;
        /* Adjust the width as needed */
        font-weight: bold;
        text-align: right;
        /* Align the text to the right */
    }
</style>

<div class="container">
    <div class="receipt_header">
        <h1> GENSAN FEEDMILL, INC.</h1>
        <h3> Outbound Receipt</h3>
        <h2>Prepared By: <?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?></h2>
    </div>
    <div class="receipt_body">
        <div class="items">
            <table>
                <thead>
                    <th>ITEM NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                </thead>
                <tbody id="itemTableBody"></tbody>
            </table>
        </div>
    </div>
    <div class="customer_cont">
        <div>Customer:</div>
        <div id="customer"></div>
    </div>
    <div class="recepit_cont">
        <div>Total:</div>
        <div id="totalAmount"></div>
    </div>
    <h3>Reference No.: <span id="referenceNo"></span> | Date: <?php echo date('m/d/y'); ?></h3>
    <div class="print-button" id="printButton">
        <i class="fas fa-print"></i> Print
    </div>
</div>

<!-- Your JavaScript imports and scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve stored product data from localStorage
        var storedProducts = localStorage.getItem('paymentPageCartItems');
        var products = JSON.parse(storedProducts);

        // Display products in the table
        var itemTableBody = document.getElementById('itemTableBody');
        var totalAmount = 0;

        products.forEach(function(product) {
            var row = document.createElement('tr');
            row.innerHTML = '<td>' + product.productName + '</td>' +
                '<td>' + product.quantity + '</td>' +
                '<td>' + product.productPrice.toFixed(2) + '</td>';
            itemTableBody.appendChild(row);

            // Calculate total amount
            totalAmount += parseFloat(product.productPrice);
        });

        // Display total amount
        document.getElementById('totalAmount').textContent = '₱' + totalAmount.toFixed(2);

        // Retrieve stored payment data from localStorage
        var storedPaymentData = localStorage.getItem('paymentData');
        var paymentData = JSON.parse(storedPaymentData);

        // Retrieve and display reference number
        var storedReferenceNo = localStorage.getItem('referenceNo');
        document.getElementById('referenceNo').textContent = storedReferenceNo;

        // Retrieve and display customer name
        var customerName = localStorage.getItem('customerName');
        document.getElementById('customer').textContent = customerName;

        // Handle printing
        var printButton = document.getElementById('printButton');
        if (printButton) {
            printButton.addEventListener('click', function() {
                printReceipt();
            });
        }

        function printReceipt() {
            // Hide the print button before printing
            var printButton = document.getElementById('printButton');
            if (printButton) {
                printButton.style.display = 'none';
            }

            // Trigger the print dialog
            window.print();

            // Revert the display property after a short delay
            setTimeout(function() {
                if (printButton) {
                    printButton.style.display = 'block';
                }
            }, 1000); // Adjust the delay as needed
        }

        // Automatically trigger the print dialog
        printReceipt();
    });

    function clearCartItems() {
        cartItems = []; // Clear the cart items
        updateCartDisplay(); // Update the table (payment-table) in the HTML 
    }

    window.addEventListener('beforeunload', function(event) {
        localStorage.removeItem('cartItems');
        clearCartItems();
    });

    function updateGeneratedTime() {
        var currentDate = new Date();
        var options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            timeZoneName: 'short'
        };

        var formattedDate = currentDate.toLocaleDateString('en-US', options);
        document.getElementById('generated-time').textContent = 'Generated on ' + formattedDate;
    }

    // Call the function initially 
    updateGeneratedTime();
</script>