<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .container {
        display: block;
        width: 280px;
        /* Adjusted width for receipt-like appearance */
        background: #fff;
        padding: 10px;
        margin: 0 auto;
        border: 1px solid #000;
        /* Adding border for receipt effect */
        margin-top: 50px;
    }

    .receipt_header {
        text-align: center;
        margin-bottom: 10px;
    }

    .receipt_header h1 {
        font-size: 16px;
        margin-bottom: 3px;
        color: #000;
        text-transform: uppercase;
    }

    .receipt_header h3 {
        font-size: 10px;
        color: #727070;
        font-weight: 300;
        margin-bottom: 5px;
    }

    .receipt_header h2 {
        font-size: 10px;
        color: #727070;
        font-weight: 300;
    }

    .receipt_body {
        margin-top: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: none;
        /* Remove border for a cleaner look */
        padding: 3px 0;
        /* Adjusted padding for a more compact layout */
        font-size: 10px;
        /* Reduced font size for better fit */
    }

    .items th,
    .items td {
        padding: 3px 0;
        /* Adjusted padding for a more compact layout */
    }

    .customer_cont {
        font-size: 10px;
        /* Reduced font size for better fit */
        margin-top: 5px;
    }

    .recepit_cont,
    .change_cont {
        font-size: 10px;
        /* Reduced font size for better fit */
        margin-top: 5px;
    }

    h3 {
        color: #000;
        border-top: 1px dashed #000;
        padding-top: 5px;
        margin-top: 8px;
        text-align: center;
        text-transform: uppercase;
        font-size: 8px;
        /* Reduced font size for better fit */
    }

    .print-button {
        color: #000;
        display: none;
        text-align: center;
        /* Hide print button in print view */
    }

    /* Hide sidebar and navbar in print view */
    @media print {

        .navbar,
        #layoutSidenav_nav {
            display: none;
        }
    }

    @media print {
        .container {
            border: none;
            /* Remove border in print view */
            width: 100%;
            /* Use full width in print view */
            max-width: none;
            /* Remove max-width in print view */
            padding: 5px;
            /* Adjusted padding for print view */
            margin: 0;
        }

        .receipt_header h1 {
            font-size: 14px;
            /* Adjusted font size for print view */
        }

        .receipt_header h3,
        .receipt_header h2 {
            font-size: 8px;
            /* Adjusted font size for print view */
        }

        .items th,
        .items td {
            font-size: 8px;
            /* Adjusted font size for print view */
        }

        .customer_cont,
        .recepit_cont,
        .change_cont {
            font-size: 8px;
            /* Adjusted font size for print view */
        }

        h3 {
            font-size: 7px;
            /* Adjusted font size for print view */
        }
    }
</style>

<div class="container">
    <div class="receipt_header">
        <h1> GENSAN FEEDMILL, INC.</h1>
        <h2>WAREHOUSE</h2>
        <h3> OUTBOUND RECEIPT</h3>
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
                <tbody id="itemTableBody">
                    <?php foreach ($view as $row) { ?>
                        <tr>
                            <td><?= $row->product_name; ?></td>
                            <td><?= $row->quantity; ?></td>
                            <td><?= $row->product_price; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="customer_cont">
        <div>Customer:</div>
        <div id="customer"><?= $code->customer_name ?></div>
    </div>
    <div class="recepit_cont">
        <div>Total:</div>
        <div id="totalAmount"><?= $code->total_cost ?></div>
    </div>
    <h3>Reference No.: <?= $code->reference_no ?> | Date: <?= $code->date_created ?></h3>
    <div class="print-button" id="printButton">
        <i class="fas fa-print"></i> Print
    </div>
</div>
<script>
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
</script>