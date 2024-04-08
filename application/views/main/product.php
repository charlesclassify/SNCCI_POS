<h4>Product Management</h4>

<div class="col-sm-6">

</div>
<?php if (isset($_SESSION['UserLoginSession']['role']) && $_SESSION['UserLoginSession']['role'] == USER_ROLE_ADMIN) : ?>
  <h1 class="m-0 text-dark">
    <a href="<?php echo site_url('main/product'); ?>" class="btn btn-primary btn-sm btn-success"><i class="fas fa-boxes"></i> Products</a>
    <a href="<?php echo site_url('main/unit'); ?>" class="btn btn-primary btn-sm btn-success"><i class="fas fa-barcode"></i> Unit Management</a>
  </h1>
<?php endif; ?>
<div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
  <?php if (isset($_SESSION['UserLoginSession']['role']) && $_SESSION['UserLoginSession']['role'] == USER_ROLE_ADMIN) : ?>
    <div class="card-header">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <a href="<?php echo site_url('main/add_product'); ?>" class="btn btn-success btn-sm"><i class="fas fa-box"></i> Add Product</a>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="card-body">
    <div class="table-responsive">
      <table id="productTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>UoM</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          if (isset($result) && !empty($result)) {
            foreach ($result as $key => $row) {
              $product_id = $row->product_id;
              $product_name = ucfirst($row->product_name);
              $product_code = $row->product_code;
              $product_price = $row->product_price;
              $product_quantity = $row->product_quantity;
              $product_uom = $row->product_uom;

          ?>
              <tr class="text-center">
                <td><?= $no++ ?></td>
                <td><b><?php echo $product_name; ?></b></td>
                <td><?php echo $product_code; ?></td>
                <td>₱<?php echo $product_price; ?></td>
                <td><?php echo $product_quantity; ?></td>
                <td><?php echo $product_uom; ?></td>
                <td>
                  <?php if (isset($_SESSION['UserLoginSession']['role']) && $_SESSION['UserLoginSession']['role'] == USER_ROLE_ADMIN || $_SESSION['UserLoginSession']['role'] == USER_ROLE_INBOUND_USER) : ?>
                    <a href="#" class="addReceivedQuantitiesBtn" data-productid="<?php echo $product_id; ?>" style="color:green; padding-left:6px;" title="Click here to add product quantity" data-bs-toggle="modal"><i class="fas fa-plus-circle"></i></a>
                  <?php endif; ?>
                  <a href="<?php echo site_url('main/view_product/') . $product_id; ?>" style="color:darkcyan; padding-left:6px;"><i class=" fas fa-eye"></i></a>
                  <?php if (isset($_SESSION['UserLoginSession']['role']) && $_SESSION['UserLoginSession']['role'] == USER_ROLE_ADMIN) : ?>
                    <a href="<?php echo site_url('main/edit_product/') . $product_id; ?>" style="color:gold; padding-left:6px;"><i class=" fas fa-edit"></i></a>
                    <a href="<?php echo site_url('main/delete_product/') . $product_id; ?>" onclick="return confirm('Are you sure you want to delete this product?')" style="color:red; padding-left:6px;"><i class="fas fa-trash"></i></a>
                  <?php endif; ?>
                </td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div id="modalContainer"></div>
</div>
<script>
  // Add Quantity Modal
  document.addEventListener('DOMContentLoaded', function() {
    function handleReceiveButtonClick(event) {
      event.preventDefault();
      var productId = this.getAttribute('data-productid');
      console.log("Clicked button product ID:", productId);
      loadModalContent('<?php echo base_url('Main/receive_quantity/'); ?>' + productId, productId);
    }
    var receiveButtons = document.querySelectorAll('.addReceivedQuantitiesBtn');
    receiveButtons.forEach(function(button) {
      button.addEventListener('click', handleReceiveButtonClick);
    });
  });

  function loadModalContent(url, productId) {
    console.log("loadModalContent function called with product ID:", productId);
    fetch(url)
      .then(response => response.text())
      .then(data => {
        document.getElementById('modalContainer').innerHTML = data;
        document.querySelector('#modalContainer input[name="product_id"]').value = productId;
        $('#staticBackdropReceiving').modal('show');
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  document.addEventListener("DOMContentLoaded", function() {
    const productTable = $('#productTable').DataTable();

    // Event listener for delete button
    $('.delete-product-btn').on('click', function() {
      const productId = $(this).data('product-id');
      const confirmation = confirm('Are you sure you want to delete this product?');
      if (confirmation) {
        window.location.href = "<?php echo site_url('main/delete_product/'); ?>" + productId;
      }
    });

    const searchInput = document.getElementById("searchInput");

    searchInput.addEventListener("input", function() {
      const searchTerm = searchInput.value.trim().toLowerCase();

      productTable.search(searchTerm).draw();
    });
  });
  $(document).ready(function() {
    <?php if ($this->session->flashdata('success')) { ?>
      toastr.success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } elseif ($this->session->flashdata('error')) { ?>
      toastr.error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>
  });
</script>