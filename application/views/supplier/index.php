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
						<h3 class="card-title">Data Supplier</h3>
						<div class="float-right">
							<a href="<?=base_url('supplier/tambah');?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="tabel1">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Supplier</th>
									<th>No. Telphone</th>
									<th>Alamat</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;foreach ($row->result() as $supplier): ?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$supplier->nama_supplier;?></td>
									<td><?=$supplier->telp;?></td>
									<td><?=$supplier->alamat;?></td>
									<td><?=$supplier->keterangan;?></td>
									<td>
										<a class="btn btn-success btn-sm" href="<?=base_url('supplier/edit/');?><?=$supplier->id_supplier;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?=base_url('supplier/delete/');?><?=$supplier->id_supplier;?>"><i class="fa fa-trash"></i></a>
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
