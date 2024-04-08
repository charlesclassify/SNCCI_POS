<style>
	.bold-label {
		font-weight: bold;
	}


	h1 {
		text-align: center;
	}



	@media (max-width: 767px) {
		h1 {
			margin-left: 0;
		}
	}

	.form-group {
		margin: 10px;
	}
</style>

<div class="container mt-3">


	<h4>Edit Product</h4>


	<!-- Flash Messages -->
	<?= $this->session->flashdata('add_user_submit'); ?>
	<?= $this->session->flashdata('add_user_error'); ?>

	<div class="row justify-content-center">

		<div class="card">
			<div class="card-body">
				<?= form_open_multipart('main/edit_product_submit/' . $product->product_id, array('onsubmit' => 'return confirm(\'Are you sure you want to update this product?\')')); ?>
				<div class="section">
					<h5>Product Information</h5>

					<div class="form-group col-md-3 d-inline-block">
						<label for="date_created" class="bold-label">Date Updated</label>
						<input type="text" id="date_created" name="date_created" value="<?= date('m-d-Y'); ?>" readonly class="form-control">
					</div>
					<div class="form-group col-md-3 d-inline-block">
						<label for="product_code" class="bold-label">Product Code</label>
						<input type="text" id="product_code" name="product_code" value="<?= set_value('product_code', $product->product_code); ?>" class="form-control" readonly>

					</div>
					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Product Name</label>
						<input type="text" placeholder="Product Name" name="product_name" value="<?= set_value('product_name', $product->product_name); ?>" class="form-control" required>
						<?= form_error('product_name'); ?>
						<?php $productname = $product->product_name; ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Brand</label>
						<input type="text" placeholder="Enter Brand" name="product_brand" value="<?= set_value('product_brand', $product->product_brand); ?>" class="form-control" required>
						<?= form_error('product_brand'); ?>
					</div>


					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Product Category</label>
						<select class="form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" name="product_category" required>
							<option selected hidden value="<?= $product->product_category ?>"><?= $product->product_category ?></option>

							<option value=" Maintenance, Repairs, Operations">Maintenance, Repairs, Operations</option>
							<option value="Merchandise Inventory">Merchandise Inventory</option>
						</select>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Barcode</label>
						<input type="text" placeholder="Enter Barcode" name="product_barcode" min="0" value="<?= set_value('product_barcode', $product->product_barcode); ?>" class="form-control" id="product_barcode" required>
						<?= form_error('product_barcode'); ?>
					</div>


					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Unit of Measure</label>

						<select class="form-control form-control" name="product_uom" id="uom" title="Please enter unit" required>
							<option value="<?= set_value('product_uom', $product->product_uom); ?>" selected hidden><?= set_value('product_uom', $product->product_uom); ?></option>
							<?php foreach ($unit as $pro) { ?>
								<option value="<?= $pro->unit ?>"><?= $pro->unit ?></option>
							<?php } ?>
						</select>

					</div>
					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Minimum Quantity</label>
						<input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_quantity" value="<?= set_value('product_minimum_quantity', $product->product_minimum_quantity); ?>" class="form-control" id="product_minimum_quantity" required>
						<?= form_error('product_minimum_quantity'); ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Price</label>
						<input type="number" placeholder="Enter Price" min="0" name="product_price" value="<?= set_value('product_price', $product->product_price); ?>" class="form-control" id="product_price" required>
						<?= form_error('product_price'); ?>
					</div>

				</div>



				<!--div class="section">
					<h5>Image</h5>
					<div class="form-group col-md-6 d-inline-block">
						<label for="product_image" class="bold-label">Product Image</label>
						<input type="file" id="product_image" name="product_image" value="<?= set_value('product_image'); ?>" class="form-control <?= form_error('product_image') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?= form_error('product_image'); ?></span>
					</div>
				</div-->

				<input type="hidden" name="product_id" value="<?= $product->product_id; ?>">

				<div class="card-footer bg-transparent text-end">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
					<a class="btn btn-secondary btn-sm" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>

				</div>
			</div>
		</div>

	</div>

</div>