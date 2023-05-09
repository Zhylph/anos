<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('user/edit'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">User ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $user['user_id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $user['tempat_lahir']; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input class="form-control <?php echo form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" type="date" name="tanggal_lahir" value="<?php echo $user->tanggal_lahir ?>" />
                    </div>
                    <div class="invalid-feedback">
                        <?php echo form_error('tanggal_lahir') ?>
                    </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="no_telp" class="col-sm-2 col-form-label">No. Telpon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $user['no_telp']; ?>" >
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>


            </form>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 