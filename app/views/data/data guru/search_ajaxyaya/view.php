<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">FOTO</th>
            <th>NIP</th>
            <th>NAMA</th>
            <th>JENIS KELAMIN</th>
            <th>TELP</th>
            <th>ALAMAT</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        // Include / load file koneksi.php
        include "koneksi.php";
        
        // Fetch data from the ilkomfina_guru table
        $sql = $pdo->prepare("SELECT * FROM ilkomfina_guru");
        $sql->execute();
        $no = 1; // For numbering the table, initially set to 1
        while ($data = $sql->fetch()) { // Fetch all data from the result of $sql execution
            ?>
            <tr>
                <td class="align-middle text-center"><?php echo $no; ?></td>
                <td class="align-middle text-center">
                    <img src="images/<?php echo $data['foto']; ?>" width="80" height="80">
                </td>
                <td class="align-middle"><?php echo $data['nip']; ?></td>
                <td class="align-middle"><?php echo $data['nama']; ?></td>
                <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
                <td class="align-middle"><?php echo $data['telp']; ?></td>
                <td class="align-middle"><?php echo $data['alamat']; ?></td>
                <td class="align-middle">
                    <?php echo "<a href='form_ubah_guru.php?id=" . $data['id'] . "'>Ubah</a>"; ?><br>
                    <?php echo "<a href='proses_hapus_guru.php?id=" . $data['id'] . "'>Hapus</a>"; ?>
                </td>
            </tr>
            <?php
            $no++; // Increase by 1 each time looping
        }
        ?>
    </table>
</div>