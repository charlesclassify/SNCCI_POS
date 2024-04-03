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

    .side h2 {
        font-size: 14px;
        color: #333;
        margin: 0px;
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

    .comment,
    #comment {
        font-size: 14px;
        color: #333;
        margin: 0px;
    }

    .recepit_cont,
    .cashpayment_cont,
    .change_cont {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }

    h3 {
        color: #333;
        border-top: 1px solid #333;
        padding-top: 10px;
        text-align: center;
        text-transform: uppercase;
        font-size: 12px;
    }

    .total {
        text-align: right;
        font-size: 14px;
        color: #333;
        margin: 0px;
    }

    h4 {

        color: #333;
        border-top: 1px dashed #333;
        margin: 0px;
        text-align: center;
        text-transform: uppercase;
        font-size: 12px;

    }

    .comment {
        margin: 0px;
    }


    h2 {
        margin: 0px;
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

        .container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

<div class="container">
    <div class="receipt_header">
        <h2><strong> GENSAN FEEDMILL, INC.</strong></h2>
        <h2>WAREHOUSE</h2>
        <h2><strong>INBOUND RECEIPT</strong></h2>
        <!--h2>Prepared By: </h2-->
    </div>
    <div class="receipt_body">
        <?php foreach ($receipt_details as $receipt) : ?>
            <div class="side">
                <h2>Clerk: <?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?></h2>
                <h2>Description | Quantity | UOM</h2>
            </div>
            <div class="items">
                <h3></h3>
                <div>
                    <span id="product_code"><?= $receipt->product_code ?></span>
                    <span id="product_name"><?= $receipt->product_name ?></span>
                    <span id="product_quantity"><?= $receipt->inbound_quantity ?></span>
                    <span id="product_quantity">(<?= $receipt->product_uom ?>)</span>
                </div>
            </div>

    </div>
    <h4></h4>
    <div class="total">
        <div>Total: ₱0.00</div>
        <div id="total"></div>
    </div>
    <div class="comment">
        <div>Comment: <?= $receipt->comments ?></div>
        <div id="comment"></div>
    </div>
    <div class="comment">

        <h3><?= $receipt->receiving_no ?> | <?= $receipt->date ?></h3>

    </div>

    <div class="print-button" id="printButton">
        <i class="fas fa-print"></i> Print
    </div>
<?php endforeach; ?>
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