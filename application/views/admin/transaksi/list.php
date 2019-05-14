<table class ="table table-bordered" width="100%">
    <thead>
        <tr class="bg-warning" >
            <th style="text-align: center">NO</th>
            <th style="text-align: center">PELANGGAN</th>
            <th style="text-align: center">TANGGAL</th>
            <th style="text-align: center">JUMLAH TOTAL</th>
            <th style="text-align: center">JUMLAH ITEM</th>
            <th style="text-align: center">STATUS</th>
            <th style="text-align: center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($header_transaksi as $item) {?>
        <tr>
            <td><?php echo $i ?></td>
            <td style="text-align: left">Nama : <?php echo $item->nama_pelanggan ?>
                <br><small>
                    Telepon : <?php echo $item->telepon ?>
                    <br> Email: <?php echo $item->email ?>
                    <br>Alamat Kirim: <br><?php echo nl2br($item->alamat) ?>
                </small>
            
            </td>
            <td style="text-align: center"><?php echo date('d-m-Y', strtotime($item->tanggal_transaksi)) ?></td>
            <td style="text-align: center"><?php echo number_format($item->jumlah_transaksi) ?></td>
            <td style="text-align: center"><?php echo $item->total_item ?></td>
            <td style="text-align: center"><?php echo $item->status_bayar ?></td>
            <td>
            <div class="btn-group " >
                <a href="<?php echo base_url('admin/transaksi/detail/'.$item->kode_transaksi)?>"class="btn btn-success btn-sm"><i class="fa fa-eye"></i>Detail</a> &nbsp;
                <a href="<?php echo base_url('admin/transaksi/cetak/'.$item->kode_transaksi)?>"target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i>Cetaik</a>
                <a href="<?php echo base_url('admin/transaksi/status/'.$item->kode_transaksi)?>"class="btn btn-warning btn-sm"><i class="fa fa-check"></i>Update Status</a>
            </div>
            
            
            </td>
        </tr>    
        <?php $i++; }?>                            
    </tbody>
</table>