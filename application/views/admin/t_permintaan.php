        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Permintaan</h1>

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
                            <a href="<?php echo site_url('admin/permintaan') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                        <form action="<?= site_url('admin/addpermintaan'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_opusernameen_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                        
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="id_user"
                                value="<?php echo $username['id_user'] ?>" hidden></input>
                            </div>           
                        </div>
                        <div class="form-group row">
                            <label for="id_role" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select name="id_barang" id="id_barang" class="form-control">
                                    <option value="">Nama Barang</option>
                                        <?php foreach ($Barang as $br) : ?>
                                            <option value="<?= $br['id_barang']; ?>"><?= $br['nama_barang']; ?></option>
                                        <?php endforeach; ?>
                                        <?= form_error('id_barang', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Jumlah Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jumlah_permintaan" placeholder="Masukkan jumlah barang..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Tanggal Permintaan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_permintaan" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Tanggal Dibutuhkan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_dibutuhkan" placeholder=""></input>
                            </div>
                        </div>
                                <input type="text" class="form-control" name="status_persetujuan" value="belum disetujui" hidden></input>
                                <input type="text" class="form-control" name="status_penyerahan" value="belum diserahkan" hidden></input>

                                <input class="btn btn-success" type="submit" name="btn" value="Simpan" />
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->