<style>
    /* Adjust tab pane styles for better visibility on dark background */
    .tab-pane {
        background-color: #fff;
        /* Dark background color */
        color: #000;
        /* Text color */
        padding: 20px;
        /* Add padding for better readability */
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* Optional: Customize active tab styles */
    .nav-link.active {
        background-color: #555;
        /* Active tab background color */
    }
</style>
<div class="container">
    <h4>Report Dashboard</h4>

    <!-- Navigation for Modules -->
    <ul class="nav nav-tabs" id="moduleTabs">

        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#module2">Receiving Report</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#module4">Inventory Report</a>

        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#module5">Sales Report</a>
        </li>
        <!-- Add more modules as needed -->
    </ul>


    <!-- Purchase Order Report -->

    <div class="tab-content" id="moduleTabContent">
        <!-- Receiving Report -->
        <div class="tab-pane fade show active" id="module2">
            <table class="table" id="user-datatables-module2">
                <thead>
                    <tr>
                        <th>Receiving No</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Inbound Quantity</th>
                        <th>Date</th>
                        <th>Incharge</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($receiving as $r) { ?>
                        <tr>
                            <td><?= $r->receiving_no ?></td>
                            <td><?= $r->product_code ?></td>
                            <td><?= $r->product_name ?></td>
                            <td><?= $r->inbound_quantity ?></td>
                            <td><?= $r->date ?></td>
                            <td><?= $r->username ?></td>
                            <td>
                                <a href="<?php echo site_url('main/inbound_receipt/' . $r->receiving_no); ?>" style="color: darkcyan; padding-left:6px;"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Goods Return Report -->


        <!-- Inventory Adjustment Report -->
        <div class="tab-pane fade" id="module4">
            <table class="table" id="user-datatables-module4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Product</th>
                        <th>Old Quantity</th>
                        <th>New Quantity</th>
                        <th>Date Adjusted</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ia as $inv) { ?>
                        <tr>
                            <td><?= $inv->inventory_adjustment_id ?></td>
                            <td><?= $inv->product_name ?></td>
                            <td><?= $inv->old_quantity ?></td>
                            <td><?= $inv->new_quantity ?></td>
                            <td><?= $inv->date_adjusted ?></td>
                            <td><?= $inv->reason ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Sales Report -->
        <div class="tab-pane fade" id="module5">
            <table class="table" id="user-datatables-module5">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Date Created</th>
                        <th>Payment Method</th>
                        <th>Total Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sa as $sales) { ?>
                        <tr>
                            <td><?= $sales->reference_no ?></td>
                            <td><?= $sales->date_created ?></td>
                            <td><?= ucfirst($sales->payment_method) ?></td>
                            <td>₱<?= $sales->total_cost ?></td>
                            <td>
                                <a href="<?php echo site_url('main/print_sales_report/' . $sales->sales_no_id); ?>" style="color: darkcyan; padding-left:6px;"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> <!-- Add more modules as needed -->
    </div>
</div>