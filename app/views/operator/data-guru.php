<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>
    <style>
    /* Your existing styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    h2 {
        color: #007BFF;
        margin-bottom: 20px;
    }

    a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        margin-bottom: 20px;
        display: inline-block;
        background-color: #007BFF;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    a:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    p {
        margin-top: 20px;
        color: #333;
    }

    button {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c82333;
    }

    /* Pagination styles */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }

    .pagination li {
        margin-right: 10px;
    }

    .pagination a {
        text-decoration: none;
        background-color: #007BFF;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .pagination a:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <center>
        <h2><?= $data['title']?></h2>
        <a href="<?= BASEURL ?>/operator/newguru"> + Tambah Data</a>
    </center>

    <form method="post" action="">
        <button type="submit" name="delete_selected">Delete Selected</button>
        <table border="1">
            <tr>
                <th>No</th>
                <th><input type="checkbox" id="select_all"> Select All</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Lulusan</th>
                <center>
                    <th>Aksi</th>
                </center>
            </tr>
            <?php
                $no = 1;
                foreach ($data['dataGuru'] as $sw) {
                ?>
            <tr>
                <td class="align-middle text-center"><?php echo $no; ?></td>
                <td><input type="checkbox" name="selected_ids[]" value="<?php echo $sw['id_guru']; ?>"></td>
                <td><img src="<?= BASEURL ?>/img/<?php echo $sw['foto']; ?>" alt=""
                        style="width: 100%; max-height: 100px;"><?php echo $sw['foto']; ?></td>
                <td><?php echo $sw['nama']; ?></td>
                <td><?php echo $sw['alamat']; ?></td>
                <td><?php echo $sw['jenis_kelamin']; ?></td>
                <td><?php echo $sw['nama_agama']; ?></td>
                <td><?php echo $sw['lulusan']; ?></td>
                <td class="align-middle">
                    <a href="<?= BASEURL ?>/operator/updateguru/<?= $sw['id_guru'] ?>">Ubah</a><br>
                    <a href="<?= BASEURL ?>/operator/deleteguru/<?= $sw['id_guru'] ?>"
                        Onclick="return confirm('yakin ?')">Hapus</a>

                </td>
            </tr>
            <?php
                 $no++;
                }
            ?>

        </table>

    </form>

    <!-- Pagination -->
    <ul class="pagination">
        <?php for ($i = 1; $i <= $data['pages']; $i++) : ?>
        <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
    </ul>
    <p>Jumlah data : <?= $data['totalDataGuru']?></p>

    <p><a href="index.php">kembali</a></p>

    <script>
    // JavaScript for select all checkbox
    document.getElementById('select_all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = !checkbox.checked;
        });
    });
    </script>
</body>

</html>