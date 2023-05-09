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
                    <?php if($this->session->userdata("id_role") == "0" or $this->session->userdata("id_role") == "1") { ?>
        		    <div class="card-header">
                         <a href="<?= base_url('admin/addunit'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
                    </div>
                    <?php } ?>
                    <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
        						<th>Nama Unit</th>
                                <?php if($this->session->userdata("id_role") == "0" or $this->session->userdata("id_role") == "1") { ?>
                                <th>Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            <?php foreach ($Unit as $jb) : ?>
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $jb['nama_unit'] ?>
                                    </td>
                                    <?php if($this->session->userdata("id_role") == "0" or $this->session->userdata("id_role") == "2") { ?>
                                    <td>
                                        <a href="<?php echo site_url('admin/editUnit/' . $jb['id_unit']) ?>" class="btn btn-small"><i class="fas fa-edit"></i> </a>
                                        <a onclick="deleteConfirm('<?php echo site_url('admin/deleteUnit/' . $jb['id_unit']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
                                    </td>
                                    <?php } ?>
                                </tr>
        						<?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>