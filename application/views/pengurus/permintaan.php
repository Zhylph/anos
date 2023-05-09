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
                         <a href="<?= base_url('admin/addpermintaan'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
                    </div>

                    <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
        						<th>Nama User</th>
        						<th>Nama Barang</th>
                                <th>Jumlah minta</th>
                                <th>Satuan</th>
                                <th>Tgl minta</th>
                                <th>Tgl perlu</th>
                                <th>Status</th>
                                <th>Jumlah disetujui</th>
                                <th>Catatan</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
  
                            <?php foreach ($permintaan as $pm) : ?>
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $pm['nama_user'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pm['nama_barang'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pm['jumlah_permintaan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pm['satuan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pm['tanggal_permintaan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pm['tanggal_dibutuhkan'] ?>
                                    </td>
                                    <td>
                                        <div>
                                        <?php if ($pm['status_persetujuan'] == 'belum disetujui') { ?>
                                            <text class="badge badge-warning"><?php echo $pm['status_persetujuan']; ?></text><br>
                                        <?php }  ?>
                                        <?php if ($pm['status_persetujuan'] == 'disetujui') { ?>
                                            <text class="badge badge-success"><?php echo $pm['status_persetujuan'];?></text><br>
                                            <text class="badge"><?php echo $pm['tanggal_persetujuan'];?></text><br>
                                        <?php }  ?>
                                        <?php if ($pm['status_persetujuan'] == 'ditolak') { ?>
                                            <text class="badge badge-danger"><?php echo $pm['status_persetujuan'] ;?></text><br>
                                            <text class="badge"><?php echo $pm['tanggal_persetujuan'];?></text><br>

                                        <?php }  ?>
                                        </div>
                                        <div>
                                        <?php if ($pm['status_penyerahan'] == 'belum diserahkan') { ?>
                                            <text class="badge badge-warning"><?php echo $pm['status_penyerahan']; ?></text><br>
                                        <?php }  ?>
                                        <?php if ($pm['status_penyerahan'] == 'diserahkan') { ?>
                                            <text class="badge badge-success"><?php echo $pm['status_penyerahan']; ?></text><br>
                                            <text class="badge"><?php echo $pm['tanggal_penyerahan'];?></text><br>

                                        <?php }  ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $pm['jumlah_disetujui']; ?>
                                    </td>
                                    <td>
                                        <text class="badge"><?php echo $pm['catatan']; ?></text><br>
                                    </td>
                                    <td>
                                        <?php echo $pm['bukti'] ?>
                                    </td>
                                    <td>
                                        <div>                                       
                                        <?php if($this->session->userdata("id_role") == "1" ) { ?>
                                        <?php if ($pm['status_persetujuan'] == 'belum disetujui') { ?>
                                            <a href="" data-toggle="modal" data-target="#terima-data_<?php echo $pm['id_permintaan']?>" class="btn btn-success btn-sm">setujui</a><br><br>
                                            <a href="" data-toggle="modal" data-target="#tolak-data_<?php echo $pm['id_permintaan']?>" class="btn btn-danger btn-sm"> tolak </a><br><br>
                                        <?php }  ?>
                                        <?php } ?>
                                        <?php if($this->session->userdata("id_role") == "2") { ?>
                                        <?php if ($pm['status_persetujuan'] == 'disetujui' and $pm['status_penyerahan'] == 'belum diserahkan') { ?>
                                            <text class="badge badge-success"><?php echo $pm['status_persetujuan'];?></text>
                                            <a href="" data-toggle="modal" data-target="#serahkan_<?php echo $pm['id_permintaan']?>" class="btn btn-warning btn-sm">serahkan</a><br><br>
                                        <?php }  ?>
                                        <?php } ?>
                                        <?php if($this->session->userdata("id_role") == "1") { ?>
                                        <?php if ($pm['status_persetujuan'] == 'ditolak') { ?>
                                            <text class="badge badge-danger"><?php echo $pm['status_persetujuan'] ;?></text>
                                        <?php }  ?>
                                        <?php } ?>
                                        </div>
                                        <div>
                                        <?php if ($pm['status_penyerahan'] == 'diserahkan') { ?>
                                            <text class="badge badge-success"><?php echo $pm['status_persetujuan'];?></text>
                                            <text class="badge badge-success"><?php echo $pm['status_penyerahan'];?></text>
                                        <?php }  ?>
                                        </div> 

                                    </td>
                                
                                </tr>
        						<?php $i++; ?>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
       
        </div>

        <!-- Modal terima -->
        <?php foreach ($permintaan as $pm) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="terima-data_<?php echo $pm['id_permintaan']?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Setujui</h4>
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    </div>
                    <form class="form-horizontal" action="<?= base_url('admin/terimaPermintaan') ?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-112">
                                
                                    <input type="hidden"   id="id_permintaan" name="id_permintaan" value="<?php echo $pm['id_permintaan']; ?>">
                                    Jumlah Disetujui : <input type="text" class="form-control" id="jumlah_disetujui" name="jumlah_disetujui" value="<?php echo $pm['jumlah_permintaan']; ?>"><br>
                                    <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan....">
                                    <input type="hidden" id="id_barang" name="id_barang" value="<?php echo $pm['id_barang']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="submit"> Terima&nbsp;</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <!-- END Modal Terima -->


        <!-- Modal Tolak -->
        <?php foreach ($permintaan as $pm) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tolak-data_<?php echo $pm['id_permintaan']?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Mengapa ditolak?</h4>
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    </div>
                    <form class="form-horizontal" action="<?= base_url('admin/tolakPermintaan') ?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-112">
                                    <input type="hidden" id="id_permintaan" name="id_permintaan" value="<?php echo $pm['id_permintaan']; ?>">
                                    <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan....">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="submit"> Tolak&nbsp;</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- END Modal Tolak -->

        <!-- Modal serahkan -->
        <?php foreach ($permintaan as $pm) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="serahkan_<?php echo $pm['id_permintaan']?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Mengapa ditolak?</h4>
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    </div>
                    <form class="form-horizontal" action="<?= base_url('admin/serahkanPermintaan') ?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-112">
                                    <input type="hidden" id="id_permintaan" name="id_permintaan" value="<?php echo $pm['id_permintaan']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="submit"> Serahkan&nbsp;</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- END Modal Serahkan -->
        