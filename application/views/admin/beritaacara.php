<!DOCTYPE html>
<html><head>
    <title></title>
    <style type="text/css">
        .disp {
            float: right;
            text-align: center;
            padding: 1.5rem 0;
            margin-bottom: .5rem;
        }

        .logo {
            float: left;
            position: relative;
            width: 110px;
            height: 110px;
            margin: 0 0 0 1rem;
        }

        .status {
            font-size: 17px !important;
            font-weight: normal;
            margin-bottom: -.1rem;
        }

        .disp {
            float: right;
            text-align: center;
            margin: -.5rem 0;
        }

        .logo {
            float: left;
            position: relative;
            width: 50px;
            height: 50px;
            margin: .5rem 0 0 .5rem;
        }

        .up {
            text-transform: uppercase;
            margin: 0;
            line-height: 1.5rem;
            font-size: 1.5rem;
        }

        .status {
            margin: 0;
            font-size: 1.3rem;
            margin-bottom: .5rem;
            text-align: center;
        }

        #alamat {
            margin-top: -15px;
            font-size: 13px;
        }

        i {
            color: blue;
        }

        #alamat {
            font-size: 16px;
        }

        .separator {
            border-bottom: 2px solid #616161;
            margin: -1.3rem 0 1.5rem;
            border-color: rgb(0, 0, 0);
        }

        #lead {
            width: auto;
            position: relative;
            margin: 25px 0 0 60%;
        }

        .lead {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: -10px;
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head><body>

<div class="disp center">
        <img class="logo" src="./assets/selidah.png">
        <h6 class="up">PEMERINTAH KABUPATEN BARITO KUALA</h6>
        <h5 class="up" id="nama">DINAS PERKEBUNAN DAN PETERNAKAN</h5>
        <span id="alamat">Jl. Jend. Sudirman, Marabahan, Ulu Benteng, Marabahan, Kabupaten Barito Kuala, Kalimantan Selatan 70513</span>
        <h6 class="status">Telp :(0511) 6701091</i></h6>
        <div class="separator"></div>
    </div>

    <h6 class="status">BERITA ACARA SERAH TERIMA BARANG PAKAI HABIS</i></h6>
    <?php
        foreach ($permintaan as $p) : ?>

                <p>Pada hari ini <?= date('d F Y', strtotime($p['tanggal_penyerahan'])); ?>, kami yang bertanda tangan dibawah ini :
    
                <table id="table2" width="100%" border="0" class="center">
                    <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>DIAH EMA LISTIANI, A.Md.</td>
                    </tr>    
                    <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Pengurus Barang</td>
                    </tr>   
                </table>
                <p>Selanjutnya disebut pihak kesatu(I) </p>
                <br>
                <table id="table2" width="100%" border="0" class="center">
                    <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $p['nama_user'];?> </td>
                    </tr>    
                    <tr>
                    <td>Bidang</td>
                    <td>:</td>
                    <td><?= $p['bidang'];?></td>
                    </tr>   
                </table>
                <p>Selanjutnya disebut pihak kedua (II)</p>
                <br>
                <p>Dengan ini menyatakan bahwa pihak kesatu (I) telah menyerahkan Barang Habis Pakai berupa :</p>
                <table id="table2" width="100%" border="0" class="center">
                    <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td width="300px"><?= $p['nama_barang'];?></td>
                    </tr>  
                    <tr>
                    <td>Klasifikasi Barang</td>
                    <td>:</td>
                    <td><?= $p['jenis_barang'];?></td>
                    </tr>   
                    <tr>
                    <td>Jumlah Barang </td>
                    <td>:</td>
                    <td><?= $p['jumlah_disetujui'];?></td>
                    </tr>  
                    <tr>
                    <td>Satuan Barang</td>
                    <td>:</td>
                    <td><?= $p['satuan'];?></td>
                    </tr>   
                </table>
                <p>Kepada Pihak Kedua(II) dan Pihak Kedua telah menerima dari Pihak kesatu(I) sesuai dengan ketentuan yang berlaku</p>
                <p>Demikian berita acara serah terima ini kami buat dengan sesungguhnya.</p>
       
<?php endforeach; ?>
            
    <div id="lead">
        <p align="center">Kepala Dinas</p>
        <div style="height: 50px;"></div>

        <p class="lead" align="center">H. SUWARTONO SUSANTO, SP.,MS</p>
        <p align="center">NIP. 19650530 198509 1 001</p>

    </div>
    </div>

</body></html>