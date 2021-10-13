<?php
// jika id penjualan salah redirect ke halaman penjualan
if ($penjualan->id_penjualan == null) {
	redirect(base_url('penjualan'));
	exit;
}

?>
<html moznomarginboxes mozdisalowselectionprint>
<head>
  <title>Pos - Print Invoice</title>
  <style>
    html {font-family: "Verdana, Arial";}
    .container  {
      width: 80mm;
      font-size: 12px;
      padding: 5px;
    }
    .title  {
      text-align: center;
      font-size: 13px;
      padding-bottom: 5px;
      border-bottom: 1px dashed;
    }
    .head {
      margin-top: 5px;
      margin-bottom: 10px;
      padding-bottom: 10px;
      border-bottom: 1px solid;
    }
    .table {
      width: 100%;
      font-size: 12px;
    }
    .kiri {text-align: left;}
    .kanan {text-align: right;}
    .terimakasih {
      margin-top: 10px;
      padding-top: 10px;
      text-align: center;
      border-top: 1px dashed;
    }
    @media print {
      @page {
        width: 80mm;
        margin: 0mm;
      }
    }
  </style>
</head>

<body onload="window.print()">
 <div class="container">
  <div class="title">
    <b>Athaila Produktion</b>
    <br>
    Jl. Babakan Wadana
  </div>
  <div class="head">
    <table class="table">
      <tr>
        <td class="kiri"><?=date('d F Y H:i', $penjualan->created);?></td>
        <td class="kanan"> Kasir :</td>
        <td class="kanan"><?=$penjualan->nama;?></td>
      </tr>
      <tr>
        <td class="kiri"><?=$penjualan->invoice;?></td>
        <td class="kanan">Pelanggan :</td>
        <td class="kanan"><?=$penjualan->nama_customer == null ? 'Umum' : $penjualan->nama_customer;?></td>
      </tr>
    </table>
  </div>
  <div class="transaksi">
    <table class="table">
      <?php $arr_diskon = array();?>
      <?php foreach ($items as $item => $value): ?>
        <tr>
          <td class="kiri"><?=$value->nama_item;?></td>
          <td class="kanan"><?=$value->qty;?></td>
          <td class="kanan"><?=rupiah($value->harga);?></td>
          <td class="kanan"><?=rupiah(($value->harga - $value->diskon_item) * $value->qty);?></td>
        </tr>
        <?php if ($value->diskon_item > 0) {$arr_diskon[] = $value->diskon_item;}?>
      <?php endforeach;?>
      <?php foreach ($arr_diskon as $key => $value): ?>
        <tr>
          <td colspan="3" class="kanan">Disc Item: <?=($key + 1);?></td>
          <td class="kanan"><?=rupiah($value);?></td>
        </tr>
      <?php endforeach;?>
      <tr>
        <td colspan="4" style="border-bottom:1px dashed; "></td>
      </tr>
      <tr>
        <td colspan="3" class="kanan">Sub Total</td>
        <td class="kanan"><?=rupiah($penjualan->total_akhir);?></td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td colspan="2" style="border-bottom: 1px dashed;"></td>
      </tr>
      <?php if ($penjualan->diskon > 0): ?>
        <tr>
          <td colspan="3" class="kanan">Disc Pembelian</td>
          <td class="kanan"><?=rupiah($penjualan->diskon);?></td>
        </tr>
      <?php endif;?>
      <tr>
        <td colspan="3" class="kanan">Grand Total</td>
        <td class="kanan"><?=rupiah($penjualan->total_akhir);?></td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td colspan="2" style="border-bottom: 1px dashed;"></td>
      </tr>
      <tr>
        <td colspan="3" class="kanan">Cash</td>
        <td class="kanan"><?=rupiah($penjualan->cash);?></td>
      </tr>
      <tr>
        <td colspan="3" class="kanan">Kembalian</td>
        <td class="kanan"><?=rupiah($penjualan->kembalian);?></td>
      </tr>
    </table>
  </div>

  <div class="terimakasih">
    ~~~~~ Terima Kasih ~~~~~
    <br>
    www.atahila.com
  </div>
</div>
</body>
</html>
