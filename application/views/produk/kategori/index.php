<div class="content">
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-4 offset-3">
				<!-- Notifikasi -->
				<?=$this->session->flashdata('pesan');?>
			</div>
			<div class="col-md-6 offset-2">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Data Kategori</h3>
						<div class="float-right">
							<a href="<?=base_url('kategori/tambah');?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover" id="tabel1">
							<thead>
								<tr>
									<th style="width: 5%">#</th>
									<th>Nama Kategori</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;foreach ($row->result() as $kategori): ?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$kategori->nama_kategori;?></td>
									<td>
										<a class="btn btn-success btn-sm" href="<?=base_url('kategori/edit/');?><?=$kategori->id_kategori;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?=base_url('kategori/delete/');?><?=$kategori->id_kategori;?>"><i class="fa fa-trash"></i></a>
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
