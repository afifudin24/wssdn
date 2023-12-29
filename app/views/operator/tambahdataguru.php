<!DOCTYPE html>
<html>

<head>
    <!-- ... Your existing head section ... -->
    <style>
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

    form {
        width: 50%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <!-- ... Your existing body section ... -->

    <!-- Form to add new data -->
    <h2>Tambah Data Guru</h2>
    <form method="post" action="<?= BASEURL ?>/operator/newguru">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>
        <label for="foto">Upload Foto:</label>
        <input type="file" name="foto" accept="image/*" required><br>
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Perempuan">Perempuan</option>
            <option value="Laki-laki">Laki-laki</option>
        </select><br>

        <label for="agama">Agama:</label>
        <td>
            <select class="form-control" name="agama" id="agama" required>
                <option value="">--- Pilih Agama ---</option>
                <?php if ($data['agama'] != []) : ?>
                <?php foreach ($data['agama'] as $k) : ?>
                <option value="<?= $k['id_agama'] ?>"><?= $k['nama_agama'] ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </td><br>

        <label for="lulusan">Lulusan:</label>
        <input type="text" name="lulusan" required><br>

        <input type="submit" value="Tambah Data">
    </form>

    <!-- ... Your existing table and other HTML content ... -->
</body>

</html>