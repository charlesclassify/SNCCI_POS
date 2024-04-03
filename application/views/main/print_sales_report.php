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
        width: 100%;
        background: #fff;
        max-width: 300px;
        /* Adjust the width as needed */
        padding: 15px;
        margin: 50px auto 0;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }

    .receipt_header {
        text-align: center;
        margin-bottom: 15px;
    }

    .receipt_header h1 {
        font-size: 18px;
        margin-bottom: 5px;
        color: #000;
        text-transform: uppercase;
    }

    .receipt_header h2 {
        font-size: 12px;
        color: #727070;
        font-weight: 300;
    }

    .receipt_body {
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .recepit_cont {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 12px;
        color: #000;
        margin-top: 10px;
    }

    .cashpayment_cont {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 12px;
        color: #000;
        margin-top: 10px;
    }

    .change_cont {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 12px;
        color: #000;
        margin-top: 10px;
    }

    .items {
        margin-top: 15px;
    }

    .items th,
    .items td {
        padding: 10px;
        text-align: left;
    }

    h3 {
        color: #000;
        border-top: 1px dashed #000;
        padding-top: 10px;
        margin-top: 15px;
        text-align: center;
        text-transform: uppercase;
        font-size: 10px;
    }

    .print-button {
        color: #000;
        display: block;
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="receipt_header">
        <h1><i class="fas fa-shopping-basket"></i> COMPANY</h1>
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