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
						<h3 class="card-title">Data Customer</h3>
						<div class="float-right">
							<a href="<?=base_url('customer/tambah');?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="tabel1">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Customer</th>
									<th>No. Telephone</th>
									<th>Jenis Kelamin</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;foreach ($row->result() as $customer): ?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$customer->nama_customer;?></td>
									<td><?=$customer->telp;?></td>
									<td><?=$customer->jenis_kelamin;?></td>
									<td><?=$customer->alamat;?></td>
									<td>
										<a class="btn btn-success btn-sm" href="<?=base_url('customer/edit/');?><?=$customer->id_customer;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?=base_url('customer/delete/');?><?=$customer->id_customer;?>"><i class="fa fa-trash"></i></a>
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
