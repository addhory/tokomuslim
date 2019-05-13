<!-- Title Page -->



<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
				<div class="leftbar p-r-20 p-r-0-sm">
					<!--  -->
                    <?php include('menu.php') ?>
					

				</div>
			</div>

			<div class="col-sm-6 col-md-9 col-lg-9 p-b-50">

				<!-- Product -->
                    <h1><?php echo $title ?></h1>
                    <hr>
                    <p>Berikut adalah riwayat belanja anda</p>
                    <?php 
                    // kalau ada transaksi
                    if($header_transaksi){ ?>
                            <table class ="table table-bordered" width="100%">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>NO</th>
                                        <th>KODE</th>
                                        <th>NAMA PRODUK</th>
                                        <th>JUMLAH</th>
                                        <th>HARGA</th>
                                        <th>SUB TOTAL</th>
                                        <th>ACTION</th>
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
                    <?php } else { ?>
                        <p class = "alert alert-success">
                            <i class="fa fa-warning"></i> Belum ada data transaksi
                        </p>
                    <?php } ?>


				<!-- Pagination -->
				
			</div>
		</div>
	</div>
</section>

