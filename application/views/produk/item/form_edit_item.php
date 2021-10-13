<div class="content">
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<!-- form start -->
					<div class="col-md-6 offset-md-2">
						<div class="card-header">
							<div class="float-right">
								<a class="btn btn-warning" href="<?=base_url('item');?>"><i class="fa fa-undo"></i> Kembali</a>
							</div>
						</div>
						<form class="form-horizontal" action="" method="post">
							<div class="card-body">
								<div class="form-group row">
									<input type="hidden" name="id_item" value="<?=$row->id_item;?>">
									<label class="col-sm-4 col-form-label" for="barcode">Barcode</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?=form_error('barcode') ? 'is-invalid' : null;?>" name="barcode" id="barcode" readonly value="<?=$this->input->post('barcode') ?? $row->barcode;?>">
										<?=form_error('barcode', '<span class="error invalid-feedback">', '</span>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="nama_item">Produk</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?=form_error('nama_item') ? 'is-invalid' : null;?>" name="nama_item" id="nama_item" value="<?=$this->input->post('nama_item') ?? $row->nama_item;?>">
										<?=form_error('nama_item', '<span class="error invalid-feedback">', '</span>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="id_kategori">Kategori</label>
									<div class="col-sm-8">
										<select name="id_kategori" id="id_kategori" class="form-control">
											<?php foreach ($kategori as $kat): ?>
												<option value="<?=$kat->id_kategori;?>" <?=$kat->id_kategori == $row->id_kategori ? 'selected' : null;?>><?=$kat->nama_kategori;?></option>
											<?php endforeach;?>
										</select>
										<?=form_error('id_kategori', '<span class="error invalid-feedback">', '</span>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="id_unit">Unit</label>
									<div class="col-sm-8">
										<select name="id_unit" id="id_unit" class="form-control">
											<?php foreach ($units as $unit): ?>
												<option value="<?=$unit->id_unit;?>" <?=$unit->id_unit == $row->id_unit ? 'selected' : null;?>><?=$unit->nama_unit;?></option>
											<?php endforeach;?>
										</select>
										<?=form_error('id_unit', '<span class="error invalid-feedback">', '</span>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label" for="harga">Harga</label>
									<div class="col-sm-8">
										<input type="text" class="form-control <?=form_error('harga') ? 'is-invalid' : null;?>" name="harga" id="harga" value="<?=$this->input->post('harga') ?? $row->harga;?>">
										<?=form_error('harga', '<span class="error invalid-feedback">', '</span>');?>
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
