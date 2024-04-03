<h4>Unit Management </h4>
<h1 class="m-0 text-dark">

    <a href="<?php echo site_url('main/product'); ?>" class="btn btn-success btn-sm"><i class="fas fa-boxes"></i> Products</a>
    <a href="<?php echo site_url('main/unit'); ?>" class="btn btn-success btn-sm"><i class="fas fa-barcode"></i> Unit Management</a>

</h1>
<div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="card-header  ">

        <a href="<?php echo site_url('main/add_unit'); ?>" class="btn btn-success btn-sm "><i class="fas fa-plus"></i> Add New Unit</a>

        <div class="float-right">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;

                    foreach ($unit as $pc) : ?>
                        <tr class="text-center">

                            <td><?= $no++ ?></td>
                            <td><?php echo $pc->unit; ?></td>
                            <td>

                                <a href="<?php echo site_url('main/edit_unit/' . $pc->unit_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit product category"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo site_url('main/delete_unit/' . $pc->unit_id); ?>" onclick="return confirm('Are you sure you want to delete product category?')" style="color:red; padding-left:6px;" title="Click here to delete product category"><i class="fas fa-trash"></i></a>

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