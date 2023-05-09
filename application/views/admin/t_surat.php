        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Surat Keluar</h1>

            <div class="row">
                <div class="col-lg-8">

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <a href="<?php echo site_url('admin/surat') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/addsurat'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" class="form-control" name="username" placeholder="ID" value="<?= ($_SESSION['username']) ?>" readonly>
                                <?php
                                echo form_input([
                                    'name' => 'nomor_surat',
                                    'class' => 'form-control',
                                    'value' => set_value('nomor_surat', $nomor_surat),
                                    'readonly' => 'readonly',
                                    'hidden' => 'hidden'
                                ]);
                                ?>
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                                    <div class="col-sm-4">
                                        <select name="id_klasifikasi" id="id_klasifikasi" class="form-control">
                                            <option value="">Kode Klasifikasi</option>
                                            <?php foreach ($klasifikasi as $k) : ?>
                                                <option value="<?= $k['id_klasifikasi']; ?>"><?= $k['nama_klasifikasi']; ?></option>
                                            <?php endforeach; ?>
                                            <?= form_error('nama_klasifikasi', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-2 col-form-label">Nama Unit</label>
                                    <div class="col-sm-4">
                                        <select name="id_unit" id="id_unit" class="form-control">
                                            <option value="">Nama Unit</option>
                                            <?php foreach ($unit as $u) : ?>
                                                <option value="<?= $u['id_unit']; ?>"><?= $u['nama_unit']; ?></option>
                                            <?php endforeach; ?>
                                            <?= form_error('nama_unit', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="uraian" class="col-sm-2 col-form-label">Uraian Surat</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" name="uraian" placeholder="Uraian Surat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_dipakai" class="col-sm-2 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="tanggal_dipakai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="uraian" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan Surat">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_surat" class="col-sm-2 col-form-label">File Surat</label>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_surat" name="file_surat">
                                            <label class="custom-file-label" for="image">Pilih file</label>
                                            <?= form_error('file_surat', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="class row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->