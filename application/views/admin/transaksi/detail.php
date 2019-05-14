<p class ="pull-right">
    <div class="btn-group pull-right">
        <a href="<?php echo base_url('admin/transaksi/cetak'.$header_transaksi->kode_transaksi) ?>"target="_blank" title="Cetak" class ="btn btn-success btn-sm">
            <i class="fa fa-print"></i>Cetak
        
        </a> &nbsp;
        <a href="<?php echo base_url('admin/transaksi'.$header_transaksi->kode_transaksi) ?>"title="Kembali" class ="btn btn-info btn-sm">
            <i class="fa fa-backward"></i>Kembali
        
        </a>

    </div>

</p>

<div class="clearfix"></div><hr>


<table class ="table table-bordered" >
    <thead>
        <tr>
            <th width="20%">Nama Pelanggan</th>
            <th>: <?php echo $header_transaksi->nama_pelanggan ?></th>
        </tr>
        <tr>
            <th width="20%">KODE TRANSAKSI</th>
            <th>: <?php echo $header_transaksi->kode_transaksi ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tanggal</td>
            <td>: <?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi))?></td>
        </tr>   
        <tr>
            <td>Jumlah total</td>
            <td>: <?php echo $header_transaksi->jumlah_transaksi?></td>
        </tr> 
        <tr>
            <td>Status bayar</td>
            <td>: <?php echo $header_transaksi->status_bayar?></td>
        </tr>  
        <tr>
            <td>Bukti bayar</td>
            <td>: <?php if($header_transaksi->bukti_bayar==""){ echo 'Belum ada data';}else{ ?>
                <img src="<?php echo base_url('assets/upload/image'.$header_transaksi->bukti_bayar) ?>" class ="img img-thumbnail" width = "200">
            <?php } ?>
            </td>
        </tr>  
        <tr>
            <td>Tanggal bayar</td>
            <td>: <?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_bayar))?></td>
        </tr>  
        <tr>
            <td>Jumlah bayar</td>
            <td>: Rp <?php echo number_format($header_transaksi->jumlah_bayar, '0', ',', '.')?></td>
        </tr>  
        <tr>
            <td>Pembayaran dari</td>
            <td>: <?php echo $header_transaksi->nama_bank?> No. Rekening <?php echo $header_transaksi->rekening_pembayaran ?> a.n <?php echo $header_transaksi->rekening_pelanggan ?></td>
        </tr>  
        <tr>
            <td>Pembayaran ke rekening</td>
            <td>: <?php echo $header_transaksi->bank?> No. Rekening <?php echo $header_transaksi->nomor_rekening ?> a.n <?php echo $header_transaksi->nama_pemilik ?></td>
        </tr>  
    </tbody>
</table>

<hr>

<table class ="table table-bordered" width="100%">
    <thead>
        <tr class="bg-success">
            <th>NO</th>
            <th>KODE</th>
            <th>NAMA PRODUK</th>
            <th>JUMLAH</th>
            <th>HARGA</th>
            <th>SUB TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($transaksi as $item) {?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $item->kode_produk ?></td>
            <td><?php echo $item->nama_produk ?></td>
            <td><?php echo number_format($item->jumlah) ?></td>
            <td><?php echo number_format($item->harga) ?></td>
            <td><?php echo number_format($item->total_harga) ?></td>
        </tr>    
        <?php $i++; }?>                            
    </tbody>
</table>