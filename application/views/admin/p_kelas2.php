        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-lg-12">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
                                <th>Kode Kelas</th>
                                <th>Nama Kelas</th>
                                <th>Nama Lengkap</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            <?php foreach ($kelas2 as $k2) : ?>
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $k2['kode_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo $k2['nama_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo $k2['nama_lengkap'] ?>
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
        <script>
		window.print();
	</script>