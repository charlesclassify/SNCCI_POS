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
            <a class="nav-link active" data-toggle="tab" href="#module1">Sales Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#module2">Receiving Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#module3">Inventory Report</a>

        </li>
        <!-- Add more modules as needed -->
    </ul>


    <!-- Purchase Order Report -->

    <div class="tab-content" id="moduleTabContent">
        <!-- Module 1 Content -->
        <div class="tab-pane fade show active" id="module1">
            <table class="table" id="user-datatables-module1">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Date Created</th>
                        <th>Customer</th>
                        <th>Total Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sa as $sales) { ?>
                        <tr>
                            <td><?= $sales->reference_no ?></td>
                            <td><?= $sales->date_created ?></td>
                            <td><?= ucfirst($sales->customer_name) ?></td>
                            <td>₱<?= $sales->total_cost ?></td>
                            <td>
                                <a href="<?php echo site_url('main/print_sales_report/' . $sales->sales_no_id); ?>" style="color: darkcyan; padding-left:6px;"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Receiving Report -->
        <div class="tab-pane fade" id="module2">
            <table class="table" id="user-datatables-module2">
                <thead>
                    <tr>
                        <th>Goods Received No.</th>
                        <th>Supplier</th>
                        <th>Date Received</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gr as $grs) { ?>
                        <tr>
                            <td><?= $grs->goods_received_no ?></td>
                            <td><?= $grs->supplier_name ?></td>
                            <td><?= $grs->date_received ?></td>
                            <td>₱<?= $grs->gr_total_cost ?></td>
                            <td>
                                <span class="badge bg-success"><?= ucfirst($grs->status) ?></span>
                            </td>
                            <td>
                                <a href="<?php echo site_url('main/print_goods_received/' . $grs->goods_received_no_id); ?>" style="color: darkcyan; padding-left:6px;"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- Inventory Adjustment Report -->
        <div class="tab-pane fade" id="module3">
            <table class="table" id="user-datatables-module3">
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
    </div>
</div>