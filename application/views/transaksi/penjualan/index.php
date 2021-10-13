<!-- main content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<div class="form-group row">
							<label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
							<div class="col-9">
								<input type="date" class="form-control" name="tanggal" id="tanggal" value="<?=date('Y-m-d');?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="user" class="col-sm-3 col-form-label">Kasir</label>
							<div class="col-9">
								<input type="text" class="form-control" name="user" id="user" readonly value="<?=$this->fungsi->user_login()->nama;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="customer" class="col-sm-3 col-form-label">Customer</label>
							<div class="col-9">
								<select name="customer" id="customer" class="form-control">
									<option value="">Umum</option>
									<?php foreach ($customer->result() as $key => $data): ?>
										<option value="<?=$data->id_customer;?>"><?=$data->nama_customer;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<div class="form-group row">
							<label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
							<div class="col-9">
								<div class="input-group mb-1">
									<input type="hidden" id="id_item">
									<input type="hidden" id="harga">
									<input type="hidden" id="stok">
									<input type="text" class="form-control" id="barcode" name="barcode" required autofocus autocomplete="off">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_item"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="qty" class="col-sm-3 col-form-label">Qty</label>
							<div class="col-9">
								<input type="number" class="form-control" name="qty" id="qty" autocomplete="off" value="1" min="1">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-9 float-right">
								<button type="button" class="btn btn-primary" id="add_cart">
									<i class="fa fa-cart-plus"></i> Tambah
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<div class="text-right">
							<h4>Invoice : <b><span id="invoice"><?=$invoice;?></span></b></h4>
							<h1><b><span id="grand_total2">0</span></b></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- .row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-primary card-outline">
					<div class="card-body table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Barcode</th>
									<th>Item Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Discount Item</th>
									<th>Total</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="tabel_keranjang">
								<?php $this->load->view('transaksi/penjualan/keranjang_data');?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- .row -->
		<div class="row">
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<div class="form-group row">
							<label for="sub_total" class="col-sm-5 col-form-label">Sub Total</label>
							<div class="col-7">
								<input type="number" class="form-control" name="sub_total" id="sub_total" readonly value="0">
							</div>
						</div>
						<div class="form-group row">
							<label for="diskon" class="col-sm-5 col-form-label">Diskon</label>
							<div class="col-7">
								<input type="text" class="form-control" name="diskon" id="diskon" autocomplete="off" value="0" min="0">
							</div>
						</div>
						<div class="form-group row">
							<label for="grand_total" class="col-sm-5 col-form-label">Grand Total</label>
							<div class="col-7">
								<input type="text" class="form-control" name="grand_total" id="grand_total" readonly value="0">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- .col-md-3 -->
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<div class="form-group row">
							<label for="cash" class="col-sm-5 col-form-label">Cash</label>
							<div class="col-7">
								<input type="number" class="form-control" name="cash" id="cash" value="0" min="0">
							</div>
						</div>
						<div class="form-group row">
							<label for="change" class="col-sm-5 col-form-label">Change</label>
							<div class="col-7">
								<input type="text" class="form-control" name="change" id="change" readonly value="0">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- .col-md-3 -->
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<div class="form-group">
							<label for="catatan">Catatan</label>
							<textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- .col-md-3 -->
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<p><button class="btn btn-warning" id="batal_pembayaran"><i class="fa fa-refresh"></i> Batal</button></p>

						<p><button class="btn btn-success" id="proses_pembayaran"><i class="fa fa-paper-plane"></i> Proses Pembayaran</button></p>
					</div>
				</div>
			</div>
			<!-- .col-md-3 -->
		</div>
		<!-- .row -->


	</div>
</div>


<!-- modal tambah item produk-->
<div class="modal fade show" id="modal_item" aria-modal="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Select Item Produk</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover" id="tabel1">
					<thead>
						<tr>
							<th>Barcode</th>
							<th>Nama</th>
							<th>Unit</th>
							<th>Harga</th>
							<th>Stok</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($item as $data): ?>
							<tr>
								<td><?=$data->barcode;?></td>
								<td><?=$data->nama_item;?></td>
								<td><?=$data->nama_unit;?></td>
								<td><?=rupiah($data->harga);?></td>
								<td><?=$data->stok;?></td>
								<td>
									<button class="btn btn-primary btn-sm" id="select"
									data-id="<?=$data->id_item;?>"
									data-barcode="<?=$data->barcode;?>"
									data-nama="<?=$data->nama_item;?>"
									data-harga="<?=$data->harga;?>"
									data-stok="<?=$data->stok;?>"
									><i class="fa fa-check"></i> Select</button>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- modal edit item produk -->
<div class="modal fade show" id="modal-item-edit" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Item Produk</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="item_idkeranjang">
				<div class="form-group">
					<label for="item_produk"> Item Produk</label>
					<div class="row">
						<div class="col-md-5">
							<input type="text" id="item_barcode" class="form-control" readonly>
						</div>
						<div class="col-md-7">
							<input type="text" id="item_produk" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="item_harga">Harga</label>
					<input type="number" id="item_harga" class="form-control" min="0">
				</div>
				<div class="form-group">
					<label for="item_qty">Qty</label>
					<input type="number" id="item_qty" class="form-control" min="1">
				</div>
				<div class="form-group">
					<label for="item_total_sebelum">Total sebelum Diskon</label>
					<input type="number" id="item_total_sebelum" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="item_diskon">Diskon per Item</label>
					<input type="number" id="item_diskon" class="form-control" min="0">
				</div>
				<div class="form-group">
					<label for="item_total_setelah">Total setelah Diskon</label>
					<input type="number" id="item_total_setelah" class="form-control" min="0" readonly>
				</div>
			</div>
			<div class="card-footer">
				<div class="float-right">
					<button type="button" class="btn btn-success" id="update_keranjang"><i class="fa fa-paper-plane"></i> Simpan</button>
				</div>
			</div>

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
