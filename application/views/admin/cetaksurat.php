        <!-- Begin Page Content -->
        <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script> <!-- Load file jquery -->
</head>
<body style="padding: 0 px;">
<form method="get" action="">
<div class="row">
<div class="col-sm-3 col-md-2">
<div class="form-group">
<label>Filter Berdasarkan</label>
  <select name="filter" id="filter" class="form-control">
      <option value="">Pilih</option>
      <option value="1">Per Tanggal</option>
      <option value="2">Per Bulan</option>
      <option value="3">Per Tahun</option>
  </select>
</div>
</div>
</div>
<div class="row" id="form-tanggal">
    <div class="col-sm-3 col-md-2">
        <input type="date" class="form-control datepicker" name="tanggal1" required>
    </div>
        <label class="mt-2">s/d</label>
    <div class="col-sm-3 col-md-2">
        <input type="date" class="form-control datepicker" name="tanggal2" required>
    </div>
</div>

<div class="row">
<div class="col-sm-3 col-md-2" id="form-bulan">
<div class="form-group">
<label>Bulan</label>
<select name="bulan" class="form-control">
        <option value="">Pilih</option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
</div>
</div>
<div class="col-sm-3 col-md-2" id="form-tahun">
<div class="form-group">
<label>Tahun</label>
<select name="tahun" class="form-control">
        <option value="">Pilih</option>
        <?php
foreach($option_tahun as $data){ // Ambil data tahun dari model yang dikirim dari controller
  echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
}
        ?>
    </select>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Tampilkan</button>
<a href="cetaksurat" class="btn btn-default">Reset Filter</a>
</form>
<hr />
<a href="<?php echo $url_export; ?>" class="btn btn-success btn-xs">EXPORT EXCEL <?php echo $label; ?> </a><br /><br />

<div class="row">
    <div class="col-lg-12">

        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="card mb-3">
        <div class="card-header">
             <a href="<?= base_url('admin/addsurat'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
        </div>

        <div class="card-body">
        <table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <label>Menampilkan <?php echo $label; ?> </label><br /><br />

            <thead>
                <tr>
                <th>#</th>
        			<th>Nomor Surat</th>
        			<th>Kode Klasifikasi</th>
        			<th>Unit Pengolah</th>
        			<th>Uraian</th>
        			<th>Tanggal Surat</th>
        			<th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $no = 1;
							$bulan_romawi = array(
								'01' => 'I',
								'02' => 'II',
								'03' => 'III',
								'04' => 'IV',
								'05' => 'V',
								'06' => 'VI',
								'07' => 'VII',
								'08' => 'VIII',
								'09' => 'IX',
								'10' => 'X',
								'11' => 'XI',
								'12' => 'XII'
							);
                foreach($Surat as $data) {
                    $data_array = json_decode(json_encode($data), true);
                ?>
                    <tr>
                    <td><?= $no; ?></td>
                    <td><?= $data_array['nama_klasifikasi'].'/'. $data_array['nomor_surat'] . '-' .  $data_array['nama_unit'] .'/RSUD/' . str_replace(array_keys($bulan_romawi), array_values($bulan_romawi), $data_array['bulan']. '/' .date('y')); ?></td>
                    <td><?= $data_array['nama_klasifikasi']; ?></td>
                    <td><?= $data_array['nama_unit']; ?></td>
                    <td><?= $data_array['uraian']; ?></td>
                    <td><?= date('d F Y', strtotime($data_array['tanggal_dipakai'])); ?></td>
                    <td><?= $data_array['keterangan']; ?></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> <!-- Load file bootstrap.min.js -->
<script src="<?php echo base_url('assets/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script> <!-- Load file bootstrap-datepicker.min.js -->
<script>
    $(document).ready(function(){ // Ketika halaman selesai di load
    setDatePicker() // Panggil fungsi setDatePicker
    $('#form-tanggal, #form-bulan, #form-tahun, #form-nama').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
    $('#filter').change(function(){ // Ketika user memilih filter
    if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
        $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
        $('#form-tanggal').show(); // Tampilkan form tanggal
    }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
        $('#form-tanggal').hide(); // Sembunyikan form tanggal
        $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
    }else if($(this).val() == '3'){ // Jika filternya 3 (per tahun)
        $('#form-tanggal, #form-bulan, #form-nama').hide(); // Sembunyikan form tanggal dan bulan
        $('#form-tahun').show(); // Tampilkan form tahun
    }else{
        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sembunyikan form tanggal dan bulan
        $('#form-nama').show();
    }
    $('#form-tanggal input, #form-bulan select, #form-tahun select, #form-nama select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
    })
    })
    function setDatePicker(){
    $(".datepicker").datepicker({
    format: "yyyy-mm-dd",
    todayHighlight: true,
    autoclose: true
        }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
    }
    </script>
</table>
</body>
</html>


