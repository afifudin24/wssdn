<!DOCTYPE html>
<html>

<head>
    <title>Daftar baru</title>

    <style>
    /* Your existing styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: cover;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    h2 {
        color: #007BFF;
        font-size: 28px;
        margin-bottom: 20px;
        justify-content: center;
        align-items: center;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        width: 80%;
        /* Adjust the form width */
        max-width: 600px;
        margin: auto;
    }

    table {
        width: 100%;
    }

    tr,
    td {
        padding: 10px;
    }

    textarea {
        width: 100%;
        height: 100px;
        resize: vertical;
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="text"],
    select {
        width: calc(100% - 16px);
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <center>
        <h2>Formulir Pendaftaran siswa</h2>
    </center>
    <form border="1" method="POST" action="<?= BASEURL ?>/operator/new" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" placeholder="Nama lengkap"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <textarea name="alamat"></textarea>
                </td>

            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><input type="radio" name="jenis_kelamin" value="P">Perempuan</td>
                <td><input type="radio" name="jenis_kelamin" value="L">Laki Laki</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>
                    <select class="form-control" name="agama" id="agama" required>
                        <option value="">--- Pilih Agama ---</option>
                        <?php if ($data['agama'] != []) : ?>
                        <?php foreach ($data['agama'] as $k) : ?>
                        <option value="<?= $k['id_agama'] ?>"><?= $k['nama_agama'] ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Sekolah Asal</td>
                <td><input type="text" name="sekolah_asal" placeholder="Sekolah Asal"></td>
            </tr>
            <tr>
                <!-- Add this row for photo upload -->
                <td>Foto</td>
                <td><input type="file" name="foto" accept="image/*" required></td>
            </tr>
            <tr>
                <td><button type="submit" class="btn btn-success" name="submit">Simpan Data</button>
                </td>
            </tr>
        </table>
    </form>


</body>

</html>