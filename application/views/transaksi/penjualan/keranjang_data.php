<?php $no = 1;if ($keranjang->num_rows() > 0) {
	foreach ($keranjang->result() as $k => $data): ?>
		<tr>
			<td><?=$no++;?></td>
			<td><?=$data->barcode;?></td>
			<td><?=$data->nama_item;?></td>
			<td><?=$data->harga;?></td>
			<td><?=$data->qty;?></td>
			<td><?=$data->diskon_item;?></td>
			<td id="total"><?=$data->total;?></td>
			<td>
				<button class="btn btn-success btn-sm" id="edit_keranjang" data-toggle="modal" data-target="#modal-item-edit"
				data-idkeranjang="<?=$data->id_keranjang;?>"
				data-barcode="<?=$data->barcode;?>"
				data-produk="<?=$data->item_produk;?>"
				data-harga="<?=$data->keranjang_harga;?>"
				data-qty="<?=$data->qty;?>"
				data-diskon="<?=$data->diskon_item;?>"
				data-total="<?=$data->total;?>"><i class="fa fa-edit"></i></button>

				<button class="btn btn-danger btn-sm" id="hapus_keranjang" data-idkeranjang="<?=$data->id_keranjang;?>"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
	<?php	endforeach;?>
<?php } else {
	echo '<tr><td colspan="8" class="text-center">Tidak ada item!</td></tr>';

}?>
