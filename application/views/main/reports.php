<div class="container">
    <h4>Report Dashboard</h4>

    <!-- Navigation for Modules -->
    <ul class="nav nav-tabs" id="moduleTabs">
        <li class="nav-item">

            <a class="nav-link active" data-bs-toggle="tab" href="#module1" role="tab" aria-controls="module1" aria-selected="true">Sales Report</a>

        </li>
        <li class="nav-item">

            <a class="nav-link" data-bs-toggle="tab" href="#module2" role="tab" aria-controls="module2" aria-selected="false">Receiving Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#module3" role="tab" aria-controls="module3" aria-selected="false">Inventory Report</a>

        </li>
        <!-- Add more modules as needed -->
    </ul>

    <!-- Purchase Order Report -->

    <div class="tab-content" id="moduleTabContent">
        <!-- Module 1 Content -->
        <div class="tab-pane fade show active" id="module1" role="tabpanel" aria-labelledby="module1-tab">
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
        <div class="tab-pane fade active" id="module2" role="tabpanel" aria-labelledby="module2-tab">
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

        <!-- Inventory Adjustment Report -->
        <div class="tab-pane fade active" id="module3" role="tabpanel" aria-labelledby="module3-tab">

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
        <div class="tab-pane fade active" id="module3">
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
    </div>
</div>