<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">FOTO</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>JENIS KELAMIN</th>
            <th>TELP</th>
            <th>ALAMAT</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $no = 1;
        foreach ($data['siswa'] as $data) {
        ?>
        <tr>
            <td class="align-middle text-center"><?php echo $no; ?></td>
            <td class="align-middle text-center">
                <img src="foto/<?php echo $data['foto']; ?>" width="80" height="80">
            </td>
            <td class="align-middle"><?php echo $data['nis']; ?></td>
            <td class="align-middle"><?php echo $data['nama']; ?></td>
            <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
            <td class="align-middle"><?php echo $data['telp']; ?></td>
            <td class="align-middle"><?php echo $data['alamat']; ?></td>
            <td class="align-middle">
                <?php echo "<a href='form_ubah.php?id=".$data['id']."'>Ubah</a>"; ?><br>
                <?php echo "<a href='proses_hapus.php?id=".$data['id']."'>Hapus</a>"; ?>
            </td>
        </tr>
        <?php
            $no++;
        }
        ?>
    </table>
</div>