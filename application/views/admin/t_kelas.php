        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Kelas</h1>

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

                    <form action="<?= base_url('admin/addkelas'); ?>" method="post" enctype="multipart/form-data">
                        <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Kode Kelas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_kelas" placeholder="Kode Kelas"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Nama Kelas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas"></input>
                            </div>
                        </div>
                        <div class="class row justify-content-end">
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
        <!-- End of Main Content -->