<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru</title>
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
    <h2>Edit Data Guru</h2>
    <form method="post" action="<?= BASEURL ?>/operator/updateguru/<?= $data['guru']['id'] ?>"
        enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['guru']['id']; ?>">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $data['guru']['nama']; ?>" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $data['guru']['alamat']; ?>" required><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Perempuan" <?php echo $data['guru']['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>
                Perempuan
            </option>
            <option value="Laki-laki" <?php echo $data['guru']['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>
                Laki-laki
            </option>
        </select><br>

        <label for="agama">Agama:</label>
        <select class="form-control" name="agama" id="agama">
            <?php foreach ($data['agama'] as $k) : ?>
            <?php if ($k['id_agama'] == $data['guru']['agama']) : ?>
            <option value="<?= $k['id_agama'] ?>" selected><?= $k['nama_agama'] ?></option>
            <?php else : ?>
            <option value="<?= $k['id_agama'] ?>"><?= $k['nama_agama'] ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select><br>

        <label for="lulusan">Lulusan:</label>
        <input type="text" name="lulusan" value="<?php echo $data['guru']['lulusan']; ?>" required><br>

        <label for="photo">Upload Photo:</label>
        <input type="file" name="photo"><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>

</html>