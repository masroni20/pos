<div class="content">
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<!-- form start -->
					<div class="col-md-6 offset-md-2">
						<div class="card-header">
							<h3 class="card-title">Tambah Customer</h3>
							<div class="float-right">
								<a class="btn btn-warning" href="<?=base_url('customer');?>"><i class="fa fa-undo"></i> Kembali</a>
							</div>
						</div>
						<form class="form-horizontal" action="<?=base_url('customer/tambah');?>" method="post">
							<div class="card-body">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="nama">Nama Customer</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?=form_error('nama') ? 'is-invalid' : null;?>" name="nama" id="nama" value="<?=$this->form_validation->set_value('nama');?>">
										<?=form_error('nama', '<span class="error invalid-feedback">', '</span>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"for="telp">No. Telp</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?=form_error('telp') ? 'is-invalid' : null;?>" name="telp" id="telp" value="<?=$this->form_validation->set_value('telp');?>">
										<?=form_error('telp', '<span class="error invalid-feedback">', '</span>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"for="jenis_kelamin">Jenis Kelamin</label>
									<div class="col-sm-8">
										<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
											<option value="L">Laki-Laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="alamat">Alamat</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?=form_error('alamat') ? 'is-invalid' : null;?>" name="alamat" id="alamat" value="<?=$this->form_validation->set_value('alamat');?>">
										<?=form_error('alamat', '<span class="error invalid-feedback">', '</span>');?>
									</div>
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
