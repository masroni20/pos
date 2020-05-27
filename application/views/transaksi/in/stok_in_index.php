<div class="content">
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-4">
				<!-- Notifikasi -->
				<?=$this->session->flashdata('pesan');?>
			</div>
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Data Stok In</h3>
						<div class="float-right">
							<a href="<?=base_url('stok/in/tambah');?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="tabel1">
							<thead>
								<tr>
									<th>#</th>
									<th>Barcode</th>
									<th>Item Produk</th>
									<th>Qty</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php $no = 1;foreach ($row as $data): ?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$data->barcode;?></td>
									<td><?=$data->nama_item;?></td>
									<td><?=$data->qty;?></td>
									<td><?=$data->tanggal;?></td>
									<td>
										<a class="btn btn-primary btn-sm modal-detail" href="#" data-toggle="modal" data-target="#modal-detail"
										data-barcode="<?=$data->barcode;?>"
										data-nama_item="<?=$data->nama_item;?>"
										data-detail="<?=$data->detail;?>"
										data-supplier="<?=$data->nama_supplier;?>"
										data-qty="<?=$data->qty;?>"
										data-tanggal="<?=$data->tanggal;?>"

										><i class="fa fa-eye"></i></a>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?=base_url('stok/in/delete/');?><?=$data->id_stok;?>/<?=$data->id_item;?>"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach;?>

						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal fade show" id="modal-detail" aria-modal="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Stok Masuk</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th>Barcode</th>
							<td id="barcode"></td>
						</tr>
						<tr>
							<th>Item Produk</th>
							<td id="nama_item"></td>
						</tr>
						<tr>
							<th>Detail</th>
							<td id="detail"></td>
						</tr>
						<tr>
							<th>Supplier</th>
							<td id="supplier"></td>
						</tr>
						<tr>
							<th>Qty</th>
							<td id="qty"></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td id="tanggal"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
