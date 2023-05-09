        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Edit Nomor Surat</h1>

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
                            <a href="<?php echo site_url('user') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/editsurat'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id_surat" value="<?php echo $skeluar->id_surat ?>" readonly />
                                <input type="hidden" name="nomor_surat" value="<?php echo $skeluar->nomor_surat ?>" readonly />
                                <input type="hidden" name="bulan" value="<?php echo $skeluar->bulan ?>" readonly />
                                <input type="text" name="username" value="<?php echo $skeluar->username ?>" readonly />
                                <input type="hidden" name="tanggal_surat" value="<?php echo $skeluar->tanggal_surat ?>" readonly />

                                <div class="form-group">
                                    <label for="no_surat" class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                                    <div class="col-sm-4">
                                        <select name="id_klasifikasi" id="id_klasifikasi" class="form-control">
                                            <?php foreach ($klasifikasi as $b) : ?>
                                                <option value="<?= $b['id_klasifikasi']; ?>"><?= $b['nama_klasifikasi']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="perihal" class="col-sm-2 col-form-label">Unit Pengolah</label>
                                    <div class="col-sm-4">
                                        <select name="id_unit" id="id_unit" class="form-control">
                                            <option value="<?php echo $skeluar->id_unit ?>">Pilih Unit Pengolah</option>
                                            <?php foreach ($unit as $b) : ?>
                                                <option value="<?= $b['id_unit']; ?>"><?= $b['nama_unit']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="klasifikasi" class="col-sm-2 col-form-label">Uraian</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control col-sm-8" type="text" name="uraian"> <?php echo form_error('uraian') ? 'is-invalid' : ''  ?> <?php echo $skeluar->uraian ?>   </textarea>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('uraian') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_dipakai" class="col-sm-2 col-form-label">Tanggal Surat</label>
                                        <div class="col-sm-6">
                                            <input class="form-control col-sm-8 <?php echo form_error('tanggal_dipakai') ? 'is-invalid' : '' ?>" type="date" name="tanggal_dipakai" value="<?php echo $skeluar->tanggal_dipakai ?>" />
                                        </div>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('tanggal_dipakai') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan_surat" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control col-sm-14" type="text" name="keterangan"><?php echo form_error('tujuan_surat') ? 'is-invalid' : '' ?> <?php echo $skeluar->keterangan ?></textarea>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('keterangan') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="file_berkas" class="col-sm-2 col-form-label">File Surat</label>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input class="file-input" <?php echo form_error('file_surat') ? 'is-invalid' : '' ?> type="file" name="file_surat" />
                                                <input type="hidden" name="old_file" value="<?php echo $skeluar->file_surat ?>" />
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('file_surat') ?>
                                                    <label class="custom-file-label" for="file_surat">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <input class="btn btn-facebook" type="submit" name="btn" value="Save" />
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->