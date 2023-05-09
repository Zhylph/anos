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
                    <?php if($this->session->userdata("id_role") == "2") { ?>
        		    <div class="card-header">
                         <a href="<?= base_url('admin/addpenerimaan'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
                    </div>
                    <?php }?>
                    
                    <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
        						<th>Nama Barang</th>
        						<th>Jenis Barang</th>
                                <th>Tanggal Penerimaan</th>
                                <th>Tanggal Pembelian</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Nama Toko</th>
                                <th>Alamat</th>
                                <th>Bukti</th>
                                <?php if($this->session->userdata("id_role") == "2") { ?>
                                <th>Aksi</th>
                                <?php }?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            <?php foreach ($penerimaan as $pr) : ?>
                                
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $pr['nama_barang'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['jenis_barang'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['tanggal_penerimaan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['tanggal_pembelian'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['jumlah_penerimaan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['satuan'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['harga_penerimaan'] ?>
                                    </td><td>
                                        <?php echo $pr['nama_toko'] ?>
                                    </td>
                                    <td>
                                        <?php echo $pr['alamat_toko'] ?>
                                    </td>
                                    <td>
                                    <a href="<?= base_url('upload/berkas/' . $pr['bukti_penerimaan']) ?>" target="_blank" class="btn btn-small"><i class="fas fa-file"></i> </a>
                                    </td>
                                    <?php if($this->session->userdata("id_role") == "2") { ?>
                                    <td>
                                        <a onclick="deleteConfirm('<?php echo site_url('admin/deletepenerimaan/' . $pr['id_penerimaan']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
                                    </td>
                                    <?php }?>
                                </tr>
        						<?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>