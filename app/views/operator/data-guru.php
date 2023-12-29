<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
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
        overflow-x: auto;
        /* Enable horizontal scrolling */
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
        margin: 0 10px;
        /* Added margin */
    }

    .pagination a:hover {
        background-color: #0056b3;
    }

    .btnpdf {
        margin: 10px 0px;
        background-color: green;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btndlt {
        margin: 10px 0px;
        background-color: #dc3545;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
</head>

<body>
    <center>
        <h2><?= $data['title'] ?></h2>
        <a href="<?= BASEURL ?>/operator/form-simpan-guru"> + Tambah Data</a>
    </center>

    <form method="post" action="">
        <button type="submit" name="delete_selected" class="btndlt">Delete Selected</button>
        <br>
        <table border="1" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th><input type="checkbox" id="select_all"> Select All</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Lulusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data['dataGuru'] as $sw) {
                ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $no; ?></td>
                    <td><input type="checkbox" name="selected_ids[]" value="<?php echo $sw['id']; ?>"></td>
                    <td><?php echo $sw['nama']; ?></td>
                    <td><?php echo $sw['alamat']; ?></td>
                    <td><?php echo $sw['jenis_kelamin']; ?></td>
                    <td><?php echo $sw['nama_agama']; ?></td>
                    <td><?php echo $sw['lulusan']; ?></td>
                    <td class="align-middle">
                        <a href="<?= BASEURL ?>/operator/form-ubah-guru/<?= $sw['id'] ?>">Ubah</a><br>
                        <a href="<?= BASEURL ?>/operator/deleteguru/<?= $sw['id'] ?>"
                            onclick="return confirm('yakin ?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->

        <p>Jumlah data : <?= $data['totalDataGuru'] ?></p>
    </form>
    <p><a href="<?= BASEURL ?>/operator/">kembali</a></p>

    <!-- JavaScript for select all checkbox -->
    <script>
    document.getElementById('select_all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = !checkbox.checked;
        });
    });
    </script>
    <!-- Include jQuery v3.5.1 -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include DataTables and Buttons -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            "paging": true,
            "ordering": true,
            "pageLength": 20,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [{
                    extend: 'pdfHtml5',
                    className: 'btnpdf',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5]
                    },
                    customize: function(doc) {
                        // Add a custom header to the PDF
                        doc.content.unshift({
                            text: 'DATA Guru SDN 5',
                            fontSize: 14,
                            bold: true,
                            fillColor: 'gray', // Gray background color
                            color: 'black', // Text color
                            alignment: 'center', // Center-align the text
                            margin: [0, 10]
                        });
                    }
                },
                {
                    extend: 'print',
                    className: 'btnpdf',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5], // Specify columns to include in print
                        stripHtml: false // Preserve HTML in the printed table
                    }
                }
            ]
        });
    });
    </script>

</body>

</html>