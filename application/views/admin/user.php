        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-lg-12">

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card mb-3">
        		    <div class="card-header">
                         <a href="<?= base_url('admin/adduser'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
                    </div>

                    <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
        						<th>Nama Pegawai</th>
        						<th>Bidang</th>
                                <th>Username</th>
                                <th>Hak Akses</th>
                                <?php if($this->session->userdata("id_role") == "0") { ?>
                                <th>Aksi</th>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            <?php foreach ($user as $u) : ?>
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $u['nama_user'] ?>
                                    </td>
                                    <td>
                                        <?php echo $u['bidang'] ?>
                                    </td>
                                    <td>
                                        <?php echo $u['username'] ?>
                                    </td>
                                    <td>
                                         <?php echo $u['role'] ?> 
                                    </td>
                                    <?php if($this->session->userdata("id_role") == "0") { ?>

                                    <td>
                                        <a href="<?php echo site_url('admin/edituser/' . $u['id_user']) ?>" class="btn btn-small"><i class="fas fa-edit"></i> </a>
                                        <a onclick="deleteConfirm('<?php echo site_url('admin/deleteuser/' . $u['id_user']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <?php } ?>

        						<?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>