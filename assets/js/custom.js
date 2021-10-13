$(document).ready(function() {
	$(document).on('click', '#select', function() {
		// mengambil data dari tombol select 
		var id_item = $(this).data('id');
		var barcode = $(this).data('barcode');
		var nama_item = $(this).data('nama');
		var unit = $(this).data('unit');
		var harga = $(this).data('harga');
		var stok = $(this).data('stok');

		// input ke tiap-tiap elemet
		$('#id_item').val(id_item);
		$('#barcode').val(barcode);
		$('#nama_item').val(nama_item);
		$('#item_unit').val(unit);
		$('#harga').val(harga);
		$('#stok').val(stok);
		$('#modal_item').modal('hide');
	});

	// menampilkan detail stok
	$(document).on('click', '.modal-detail', function() {

		// var id_item = $(this).data('id');
		var barcode = $(this).data('barcode');
		var nama_item = $(this).data('nama_item');
		var detail = $(this).data('detail');
		var supplier = $(this).data('supplier');
		var qty = $(this).data('qty');
		var tanggal = $(this).data('tanggal');

		// input ke tiap-tiap elemet
		// $('#id_item').val(id_item);
		$('#barcode').text(barcode);
		$('#nama_item').text(nama_item);
		$('#detail').text(detail);
		$('#supplier').text(supplier);
		$('#qty').text(qty);
		$('#tanggal').text(tanggal);
	});

/*batas halaman penjualan*/
	// add_cart menambahkan ke tabel keranjang
	$(document).on('click', '#add_cart', function() {
		var id_item = $("#id_item").val();
		var harga = $("#harga").val();
		var stok = $("#stok").val();
		var qty = $("#qty").val();

		// jika produk belum dipilih
		if (id_item == '') {
			alert('Produk belum dipilih!')
			$("#barcode").focus()
		} else if (stok < 3) {
			// jika stok produk kurang dari 1 (bisa di setting)
			alert('Stok tidak mencukupi')
			$("#id_item").val('')
			$("#barcode").val('')
			$("#barcode").focus()
		} else {
			// kirim data menggunakan ajax
			$.ajax({
				url: "penjualan/proses",
				type: 'POST',
				dataType: 'json',
				data: {
					'add_cart': true,
					'id_item': id_item,
					'harga': harga,
					'qty': qty
				},
				success: function(result) {
					// jika sukses
					// console.log(result);
					if (result.success == true) {
						// alert('Berhasil menambahkan cart ke db');
						$("#tabel_keranjang").load('penjualan/keranjang_data',function(){
							kalkulasi();
						});
						// hapus value di beberapa element
						$("#id_item").val('');
						$("#barcode").val('');
						$("#qty").val(1);
						$("#barcode").focus();
						
					} else {
						// jika gagal
						alert('Gagal menambahkan item ke keranjang!');
					}
				}
			});	
		}
	});

	// hapus item di tabel keranjang
	$(document).on('click', '#hapus_keranjang', function() {
		if (confirm('Apakah anda yakin?')) {
			var idkeranjang = $(this).data('idkeranjang');
			$.ajax({
				url: 'penjualan/hapus_keranjang',
				type: 'POST',
				dataType: 'json',
				data: {'idkeranjang': idkeranjang},
				success: function (result) {
					if (result.success == true) {
						$("#tabel_keranjang").load('penjualan/keranjang_data',function(){
							kalkulasi();
						});
					} else {
						alert('Gagal menghapus item keranjang');
					}
				}
			});
			
		}
	});

	// edit item di tabel keranjang
	$(document).on('click', '#edit_keranjang', function() {
		// mengambil data dari tombol select 
		var idkeranjang = $(this).data('idkeranjang');
		var barcode = $(this).data('barcode');
		var produk = $(this).data('produk');
		var harga = $(this).data('harga');
		var qty = $(this).data('qty');
		var diskon = $(this).data('diskon');
		var total = $(this).data('total');

		// input ke tiap-tiap elemet
		$('#item_idkeranjang').val(idkeranjang);
		$('#item_barcode').val(barcode);
		$('#item_produk').val(produk);
		$('#item_harga').val(harga);
		$('#item_qty').val(qty);
		$('#item_diskon').val(diskon);
		$('#item_total_sebelum').val(harga * qty);
		$('#item_total_setelah').val(total);
	});

	// update tabel keranjang dan ke database
	$(document).on('click', '#update_keranjang', function() {
		var idkeranjang = $("#item_idkeranjang").val();
		var harga = $("#item_harga").val();
		var qty = $("#item_qty").val();
		var diskon = $("#item_diskon").val();
		var total = $("#item_total_setelah").val();

		// harga tidak boleh kosong
		if (harga == '' || harga < 1) {
			alert('Harga tidak boleh kosong!')
			$("#item_harga").focus()
		} else if (qty == '' || qty < 1) {
			// kuantiti tidak boleh kosong minimal 1
			alert('Qty tidak boleh kosong!')
			$("#item_qty").val(1)
			$("#item_qty").focus()
		} else {
			// update database menggunakan ajax
			$.ajax({
				url: "penjualan/proses",
				type: 'POST',
				dataType: 'json',
				data: {
					'edit_cart': true,
					'idkeranjang': idkeranjang,
					'harga': harga,
					'qty': qty,
					'diskon': diskon,
					'total': total
				},
				success: function(result) {
					// jika sukses
					// console.log(result);
					if (result.success == true) {
						// alert('Berhasil menambahkan cart ke db');
						$("#tabel_keranjang").load('penjualan/keranjang_data',function(){
							kalkulasi();
						});
						$('#modal-item-edit').modal('hide');
					} else {
						// jika gagal
						alert('Data item keranjang tidak terupdate!');
					}
				}
			});	
		}
	});

	// update live di modal
	function count_edit_modal() {
		var harga = $("#item_harga").val()
		var qty = $("#item_qty").val()
		var diskon = $("#item_diskon").val()

		item_total_sebelum = harga * qty
		$("#item_total_sebelum").val(item_total_sebelum)

		total = (harga - diskon) * qty
		$("#item_total_setelah").val(total)

		if(diskon == '') {
			$("#item_diskon").val(0)
		}
	}

	// jika kolom harga, qyt, dan diskon di edit otomatis terupdate
	$(document).on('keyup mouseup', '#item_harga, #item_qty, #item_diskon', function() {
		count_edit_modal();
		kalkulasi();
	});

	// hitung kalkulasi diskon, total belanja dan kembalian
	function kalkulasi() {
		var subtotal = 0;
		$("#tabel_keranjang tr").each(function() {
			subtotal += parseInt($(this).find('#total').text())
		})

		isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)
		var diskon = $('#diskon').val()
		var grand_total = subtotal - diskon
		if (isNaN(grand_total)) {
			$('#grand_total').val(0)
			$('#grand_total2').text(0)
		} else {
			$('#grand_total').val(grand_total)
			$('#grand_total2').text(grand_total)
		}

		var cash = $('#cash').val()
		cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)
		change = $("#change").val()
		if (isNaN(change)) {
			$("#change").val(0)
			$("#cash").val(0)
		}
		if(diskon == '') {
			$("#diskon").val(0)
		}
	}

	// jika kolom diskon diskon dan cash di edit load kalkulasi
	$(document).on('keyup mouseup', '#diskon, #cash', function() {
		kalkulasi();
	});

	// panggil fungsi kalkulasi
	kalkulasi();

	// proses pembayaran
	$(document).on('click', '#proses_pembayaran', function() {
		var id_pelanggan = $("#customer").val()
		var subtotal = $("#sub_total").val()
		var diskon = $("#diskon").val()
		var grandtotal = $("#grand_total").val()
		var cash = $("#cash").val()
		var change = $("#change").val()
		var catatan = $("#catatan").val()
		var tanggal = $("#tanggal").val()

		if (subtotal < 1) {
			alert('Belum ada produk item yang dipilih!')
			$("#barcode").focus()
		} else if (cash < 1){
			alert('Jumlah uang cash belum diinput!')
			$("#cash").focus()
		} else {
			// jika semua filed sudah sukses
			if (confirm('Yakin proses transaksi sudah benar?')) {
				// jika ya, jalankan ajax input ke database
				$.ajax({
					url: 'penjualan/proses',
					type: 'POST',
					dataType: 'json',
					data: {
						'proses_pembayaran': true,
						'id_pelanggan': id_pelanggan,
						'subtotal': subtotal,
						'diskon': diskon,
						'grandtotal': grandtotal,
						'cash': cash,
						'kembalian': change,
						'catatan': catatan,
						'tanggal': tanggal
					},
					success: function (result) {
						// console.log(result)
						if (result.success == true) {
							alert('Transaksi berhasil!');
							$("#tabel_keranjang").load('penjualan/keranjang_data',function(){
								kalkulasi();
								window.open('penjualan/cetak/' + result.id_penjualan, '_blank')
							});
						} else {
							// jika gagal
							alert('Transaksi gagal!');
							location.href='penjualan';
						}
					}
				});
				
			}
		}
	});

	// batalkan pembayaran 
	$(document).on('click', '#batal_pembayaran', function() {
		if (confirm('Apakah anda yakin?')) {
			$.ajax({
				url: 'penjualan/hapus_keranjang',
				type: 'POST',
				dataType: 'json',
				data: {'batal_pembayaran': true},
				success: function (result) {
					if (result.success == true) {
						// alert('Berhasil menambahkan cart ke db');
						$("#tabel_keranjang").load('penjualan/keranjang_data',function(){
							kalkulasi();
						});
						$("#diskon").val(0)
						$("#cash").val(0)
						$("#customer").val(0).change()
						$("#barcode").val('')
						$("#barcode").focus()
					}
				}
			})
			
		}
	});
});
