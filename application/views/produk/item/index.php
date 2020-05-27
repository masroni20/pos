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
						<h3 class="card-title">Data item</h3>
						<div class="float-right">
							<a href="<?=base_url('item/tambah');?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="tabel1">
							<thead>
								<tr>
									<th>#</th>
									<th>Barcode</th>
									<th>Produk</th>
									<th>Kategori</th>
									<th>Unit</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;foreach ($row->result() as $item): ?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$item->barcode;?></td>
									<td><?=$item->nama_item;?></td>
									<td><?=$item->nama_kategori;?></td>
									<td><?=$item->nama_unit;?></td>
									<td><?=$item->harga;?></td>
									<td><?=$item->stok;?></td>
									<td>
										<a class="btn btn-success btn-sm" href="<?=base_url('item/edit/');?><?=$item->id_item;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?=base_url('item/delete/');?><?=$item->id_item;?>"><i class="fa fa-trash"></i></a>
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
