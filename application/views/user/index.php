<div class="content">
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-4">
				<?=$this->session->flashdata('pesan');?>
			</div>
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">
							Data Pengguna
						</h3>
						<div class="float-right">
							<a class="btn btn-primary" href="<?=base_url('user/tambah');?>"><i class="fa fa-user-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover" id="tabel1">
							<thead>
								<tr>
									<th style="width: 5%">#</th>
									<th>Username</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Level</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;foreach ($row->result() as $user): ?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$user->username;?></td>
									<td><?=$user->nama;?></td>
									<td><?=$user->alamat;?></td>
									<td><?=$user->level == 1 ? 'Admin' : 'Kasir';?></td>
									<td>
										<a class="btn btn-success btn-sm" href="<?=base_url('user/edit/');?><?=$user->id_user;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?=base_url('user/delete/');?><?=$user->id_user;?>"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</div>
</div>
