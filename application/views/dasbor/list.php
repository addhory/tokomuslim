<!-- Title Page -->



<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				<div class="leftbar p-r-20 p-r-0-sm">
					<!--  -->
                    <?php include('menu.php') ?>
					

				</div>
			</div>

			<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">

				
                    <div class="alert alert-success">
                        <h1>Selamat Datang <i><strong><?php echo $this->session->userdata('nama_pelanggan'); ?></strong></i></h1>
                    </div>
					<?php 
                    // kalau ada transaksi
                    if($header_transaksi){ ?>
                            <table class ="table table-bordered" width="100%">
                                <thead>
                                    <tr class="bg-warning" >
                                        <th style="text-align: center">NO</th>
                                        <th style="text-align: center">KODE</th>
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
                                        <td style="text-align: center"><?php echo $item->kode_transaksi ?></td>
                                        <td style="text-align: center"><?php echo date('d-m-Y', strtotime($item->tanggal_transaksi)) ?></td>
                                        <td style="text-align: center"><?php echo number_format($item->jumlah_transaksi) ?></td>
                                        <td style="text-align: center"><?php echo $item->total_item ?></td>
                                        <td style="text-align: center"><?php echo $item->status_bayar ?></td>
                                        <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url('dasbor/detail/'.$item->kode_transaksi)?>"class="btn btn-success btn-sm"><i class="fa fa-eye"></i>Detail</a> &nbsp;
                                            <a href="<?php echo base_url('dasbor/konfirmasi/'.$item->kode_transaksi)?>"class="btn btn-info btn-sm"><i class="fa fa-check"></i>Konfirmasi Bayar</a>

                                        </div>
                                        
                                        
                                        </td>
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

