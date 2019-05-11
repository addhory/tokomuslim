<?php 

if($this->session->flashdata('sukses')){
  echo '<p class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}

if (isset($error)) {
  echo '<p class=alert alert-warning">';
  echo $error;
  echo "</p>";
}

echo validation_errors('<div class="alert alert-warning">','</div>');

echo form_open_multipart(base_url('admin/konfigurasi/logo'),' class="form-horizontal"');
 ?>

 <div class="form-group form-group-lg">
  	<label class="col-md-3 control-label">Nama Website</label>
  <div class="col-md-8">
    <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value=
    "<?php echo $konfigurasi->namaweb ?>" required>
  </div>
</div>

 <div class="form-group">
  	<label class="col-md-3 control-label">Upload Logo</label>
  <div class="col-md-8">
    <input type="file" name="logo" class="form-control" placeholder="Upload Logo" value=
    "<?php echo $konfigurasi->logo ?>" required>
    <h4>Logo lama:</h4>
    <img src="<?php echo base_url('assets/upload/image/'.$konfigurasi->logo) ?>" class="img img-responsive img-thumbnail" width="200">
  </div>
</div>

 <div class="form-group">
  	<label class="col-md-3 control-label"></label>
  <div class="col-md-5">
    <button class="btn btn-success btn-lg" name="submit" type="submit" ">
    	<i class="fa fa-save"></i> Simpan
    </button>
    <button class="btn btn-info btn-lg" name="reset" type="reset" ">
    	<i class="fa fa-times"></i> Reset
    </button>
  </div>
</div>

 <?php  echo form_close(); ?>