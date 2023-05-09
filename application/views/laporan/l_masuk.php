<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header text-white bg-primary">
            <h6 class="m-0 font-weight-bold text-black">Cetak Riwayat Barang Masuk</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url() ?>admin/cetakbarangmasuk" method="post" target="_blank">
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="tanggal1" required>
                    </div>
                    <label class="mt-2">s/d</label>
                    <div class="col">
                        <input type="date" class="form-control" name="tanggal2" required>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
            <div class="row">
                <div class="col-lg-12">

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    
                    
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
                                   
                                </tr>
        						<?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>