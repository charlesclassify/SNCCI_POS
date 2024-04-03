<h4>Inventory Adjustment</h4>
<div class="card card-outline card-success">
    <div class="card-header  ">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th>Code</th>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Critical Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;

                    foreach ($product as $pro) : ?>
                        <tr class="text-center">
                            <td><?php echo $pro->product_code; ?></td>
                            <td><?php echo $pro->product_name; ?></td>
                            <td><?php echo $pro->product_brand; ?></td>
                            <td><?php echo $pro->product_quantity; ?></td>
                            <td>₱<?php echo $pro->product_price; ?></td>
                            <td>
                                <div class="progress">
                                    <?php if ($pro->product_quantity <= 20) : ?>
                                        <div class="progress-bar progress-bar-striped bg-danger" style="width: <?php echo $pro->product_quantity; ?>%"></div>
                                    <?php elseif ($pro->product_quantity <= $pro->product_minimum_quantity) : ?>
                                        <div class="progress-bar progress-bar-striped bg-warning" style="width: <?php echo $pro->product_quantity; ?>%"></div>
                                    <?php else : ?>
                                        <div class="progress-bar progress-bar-striped" style="width: <?php echo $pro->product_quantity; ?>%"></div>
                                    <?php endif; ?>
                                </div>

                            </td>
                            <td>
                                <a href="<?php echo site_url('main/add_stock/' . $pro->product_id); ?>"><button type="button" class="btn btn-sm btn-success" id="btn_po">Adjust</button></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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