<div class="content">
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<!-- form start -->
					<div class="col-md-6 offset-md-2">
						<div class="card-header">
							<div class="float-right">
								<a class="btn btn-warning" href="<?=base_url('stok/in');?>"><i class="fa fa-undo"></i> Kembali</a>
							</div>
						</div>
						<form class="form-horizontal" action="<?=base_url('stok/in/proses');?>" method="post">
							<div class="card-body">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="tanggal">Tanggal</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=date('Y-m-d');?>">
									</div>
								</div>
								<div class="from-group row">
									<label for="barcode" class="col-sm-4 col-form-label">Barcode</label>
									<div class="col-sm-8">
										<div class="input-group mb-3">
											<input type="hidden" id="id_item" name="id_item">
											<input type="text" class="form-control" id="barcode" name="barcode" required autofocus>
											<div class="input-group-append">
												<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_item"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama_item" class="col-sm-4 col-form-label">Nama Item</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nama_item" name="nama_item" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="item_unit" class="col-sm-4 col-form-label">Item Unit</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="item_unit" name="item_unit" readonly value="-">
									</div>
									<label for="stok" class="col-sm-2 col-form-label">Stok</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="stok" name="stok" readonly value="-">
									</div>
								</div>
								<div class="form-group row">
									<label for="detail" class="col-sm-4 col-form-label">Detail</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="detail" name="detail" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="supplier" class="col-sm-4 col-form-label">Supplier</label>
									<div class="col-sm-8">
										<select class="form-control" name="supplier" id="supplier">
											<option value="">-Pilih-</option>
											<option value="">-Pilih-</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="qty" class="col-sm-4 col-form-label">Qty</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="qty" name="qty" required>
									</div>
								</div>

								<!-- /.card-body -->

								<div class="card-footer float-right">
									<button type="submit" class="btn btn-primary">Simpan</button>
									<button type="reset" class="btn btn-danger">Reset</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade show" id="modal_item" aria-modal="true">
		<div class="modal-dialog">
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
									<td><?=$data->harga;?></td>
									<td><?=$data->stok;?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
