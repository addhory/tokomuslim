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

echo form_open_multipart(base_url('admin/konfigurasi'),' class="form-horizontal"');
 ?>

 <div class="form-group form-group-lg">
  	<label class="col-md-3 control-label">Nama Website</label>
  <div class="col-md-8">
    <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value=
    "<?php echo $konfigurasi->namaweb ?>" required>
  </div>
</div>

 <div class="form-group">
  	<label class="col-md-3 control-label">Tagline</label>
  <div class="col-md-8">
    <input type="text" name="tagline" class="form-control" placeholder="Tagline" value=
    "<?php echo $konfigurasi->tagline ?>" required>
  </div>
</div>
 
 <div class="form-group">
    <label class="col-md-3 control-label">Website</label>
  <div class="col-md-8">
    <input type="text" name="website" class="form-control" placeholder="Website" value=
    "<?php echo $konfigurasi->website ?>" required>
  </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Email</label>
  <div class="col-md-8">
    <input type="text" name="email" class="form-control" placeholder="Email" value=
    "<?php echo $konfigurasi->email ?>" required>
  </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label">Keyword</label>
  <div class="col-md-8">
    <textarea name="keywords" class="form-control" placeholder="Keyword"><?php echo $konfigurasi->keywords ?></textarea>
  </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Metatext</label>
  <div class="col-md-8">
    <textarea name="metatext" class="form-control" placeholder="Metatext"><?php echo $konfigurasi->metatext ?></textarea>
  </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Deskripsi Website</label>
  <div class="col-md-8">
    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Website"><?php echo $konfigurasi->deskripsi ?></textarea>
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