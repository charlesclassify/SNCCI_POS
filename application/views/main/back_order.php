    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Back Order</h1></br>
            <h1 class="text-dark">
                <a href="<?php echo site_url('main/goods_received'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-boxes"></i> To Be Received</a>
                <a href="<?php echo site_url('main/goods_received_list'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-list"></i> Goods Received List</a>
                <a href="<?php echo site_url('main/back_order'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-reply"></i> Back Order</a>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('main/index') ?>">Home</a></li>
                <li class="breadcrumb-item active">Back Order</li>
            </ol>
        </div><!-- /.col -->

    </div><!-- /.row -->

    <div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="card-header  ">
            <a href="<?php echo site_url('main/back_order_list'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-list"></i> Back Order List </a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                        <thead>
                            <tr class="text-center">
                                <th>Goods Received No.</th>
                                <th>Supplier</th>
                                <th>Date Received</th>
                                <th>Total Cost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gr as $pur) { ?>
                                <tr class="text-center">

                                    <td><?= $pur->purchase_order_no ?></td>
                                    <td><?= $pur->supplier_name ?></td>
                                    <td><?= $pur->date_created ?></td>
                                    <td>₱<?= $pur->total_cost ?></td>
                                    <td>
                                        <?php if ($pur->status == "Received") { ?>

                                            <span class="badge bg-success">
                                                <?= ucfirst($pur->status) ?>
                                            </span>

                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge bg-warning">
                                                <?= ucfirst($pur->status) ?>
                                            </span>

                                        <?php
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($pur->status == "Received") { ?>

                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?php echo site_url('main/post_back_order/' . $pur->purchase_order_no_id); ?>" style="color: darkcyan; padding-left:6px;" title="Click here to post goods received">
                                                <i class="fas fa-inbox" aria-hidden="true"></i>
                                            </a>
                                        <?php
                                        } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) { ?>
                toastr.success('<?php echo $this->session->flashdata('success'); ?>');
            <?php } elseif ($this->session->flashdata('error')) { ?>
                toastr.error('<?php echo $this->session->flashdata('error'); ?>');
            <?php } ?>
        });
    </script>