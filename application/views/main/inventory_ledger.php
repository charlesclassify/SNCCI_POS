<h4>Inventory Ledger</h4>

<div class="container">
    <form method="POST" action="" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="date_from" class="form-label text-white">Date From:</label>
            <input type="date" id="date_from" name="date_from" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="date_to" class="form-label text-white">Date To:</label>
            <input type="date" id="date_to" name="date_to" class="form-control" required>
        </div>
        <div class="col-md-5">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-success">Search</button>
        </div>
    </form>

    <?php if (isset($_POST['date_from']) && isset($_POST['date_to'])) : ?>
        <?php
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $ledger = $this->inventory_ledger_model->get_ledger_by_date_range($date_from, $date_to);
        ?>

        <?php if (!empty($ledger)) : ?>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ledger-table" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Date Posted</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ledger as $row) : ?>
                                    <tr class="text-center">
                                        <td><?= $row->date_posted ?></td>
                                        <td><?= $row->product_name ?></td>
                                        <td><?= $row->quantity ?></td>
                                        <td><?= $row->unit ?></td>
                                        <td><?= $row->price ?></td>
                                        <td>
                                            <?php
                                            $activityBadgeClass = '';
                                            switch ($row->activity) {
                                                case 'Purchase':
                                                    $activityBadgeClass = 'badge bg-primary';
                                                    break;
                                                case 'Received':
                                                    $activityBadgeClass = 'badge bg-success';
                                                    break;
                                                case 'Returned':
                                                    $activityBadgeClass = 'badge bg-danger';
                                                    break;
                                                case 'Sold':
                                                    $activityBadgeClass = 'badge bg-info';
                                                    break;
                                                case 'Sales Returned':
                                                    $activityBadgeClass = 'badge bg-danger';
                                                    break;
                                                default:
                                                    $activityBadgeClass = 'badge bg-secondary';
                                                    break;
                                            }
                                            ?>
                                            <span class="<?= $activityBadgeClass ?>"><?= ucfirst($row->activity) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php else : ?>
            <p>No data found for the selected date range.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>