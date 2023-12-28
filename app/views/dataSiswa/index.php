<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa</title>
    <!-- Load File bootstrap.min.css yang ada difolder css -->
 
    <link href="<?= BASEURL ?>/data/css/bootstrap.min4.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/data/css/datatables.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/data/css/buttons.dataTables.min.css" rel="stylesheet">
<!-- jQuery -->




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .align-middle {
        vertical-align: middle !important;
    }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


</head>

<body >
    <!-- Membuat Menu Header / Navbar -->
    <nav class="navbar navbar-light bg-light d-flex justify-content-between align-items-center py-3">
  <h3 class=" text-lg">DATA SISWA</h3>
 <a class="badge badge-secondary p-3 text-lg"  href="<?= BASEURL ?>/home">Kembali Ke Menu Utama</a>
</nav>

    <?php if (Flasher::check()) : ?>
            <?php $flash = Flasher::flash() ?>
            <div class="alert alert-<?= $flash['tipe'] ?> alert-dismissible  show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?= $flash['pesan'] ?>
            </div>
        <?php endif; ?>
    </div>
   
    <div style="padding: 0 15px;">
    <input type="hidden" id="baseURL" value="<?= BASEURL ?>">
    <!-- Tambahkan button untuk import Excel di halaman -->

        <a class="btn btn-primary" href="<?= BASEURL ?>/dataSiswa/form-simpan">Tambah Siswa</a><br><br>
        <div class="row">
            <div class="col-md-6">
            <form action="<?= BASEURL ?>/dataSiswa/importExcel" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputExcel" name="file_excel" accept=".xls,.xlsx">
                    <label class="custom-file-label" for="inputExcel">Pilih file Excel</label>
                </div>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" name="import_excel">Import Excel</button>
                </div>
            </div>
        </form>
            </div>
        </div>
       
        <!-- Buat sebuah div dengan class row -->
        <div class="row mt-2">
            <div class="col-xs-12 col-sm-6">
                <!-- Input Group adalah salah satu komponen yang disediakan bootstrap -->
                <div class="input-group">
                    <!-- Buat sebuah textbox dan beri id keyword -->
                    <input type="text" class="form-control h-6" placeholder="Pencarian..." id="keyword">
                    <button class="btn btn-warning reset">Reset</button>
                   
                </div>
            </div>
        </div>
        <br>
        <h2><i class="bi bi-0-circle-fill"></i></h2>
        <!-- Buat sebuah div dengan id="view" yang digunakan untuk menampung data yang ada pada tabel siswa di database -->
        <div class="table-responsive ">
            <table id="dataTable" class="table table-bordered">
                <thead class="thead-dark">
                    <th class="text-center">NO</th>
                    <th class="text-center">FOTO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>TELP</th>
                    <th>ALAMAT</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                <?php

        $no = 1;
        foreach ($data['siswa'] as $data) {
        ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $no; ?></td>
                    <td class="align-middle text-center">
                        <img src=" <?= BASEURL . "/img/" . $data['foto'] ?>" width="80" height="80">
                       
                    </td>
                    <td class="align-middle"><?php echo $data['nis']; ?></td>
                    <td class="align-middle"><?php echo $data['nama']; ?></td>
                    <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
                    <td class="align-middle"><?php echo $data['telp']; ?></td>
                    <td class="align-middle"><?php echo $data['alamat']; ?></td>
                    <td class="align-middle  text-center ">
                        <a class="btn btn-warning" href="<?= BASEURL ?>/dataSiswa/form-ubah/<?= $data['id'] ?>">Ubah</a>
                        <a href="#" class="btn btn-danger delete-button" data-id="<?= $data['id'] ?>">Hapus</a>

                    </td>
                </tr>
                <?php
            $no++;
        }
        ?>
        </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="<?= BASEURL ?>/data/js/jquery.min.js"></script> 
    <script src="<?= BASEURL ?>/data/js/datatables.js"></script> 
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script>
    document.getElementById('inputExcel').addEventListener('change', function(e) {
        // Mendapatkan nama file yang dipilih
        var fileName = e.target.files[0].name;

        // Mengganti teks label dengan nama file yang dipilih
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });
</script>
  
 


    <script>
        
  const baseURL = document.getElementById('baseURL').value;
// Gunakan baseURL seperti yang Anda butuhkan dalam skrip JavaScript

    
$(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        "paging" : true,
        "ordering" : true,
        "pageLength": 20,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6] // Kolom yang diekspor
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
        
        ]
    } );
} );
$(".reset").click(function(){
        location.reload();

    })
  $('#keyword').on('input', function() {
    let keyword = $(this).val().trim();
    
    // Kirim permintaan Ajax ke server
    $.ajax({
        type: 'POST',
        url: baseURL + "/datasiswa/carisiswa", // Ganti dengan URL endpoint di server Anda
        data: { keyword: keyword },
        success: function(response) {
            console.log(response);
            // Ubah tabel dengan data yang diterima dari server
            $('#dataTable tbody').empty();

        // Mengiterasi melalui respons dan menambahkan setiap item sebagai baris baru pada tabel
        response.forEach(function(data, index) {
            $('#dataTable tbody').append(`
                <tr>
                    <td class="align-middle text-center">${index + 1}</td>
                    <td class="align-middle text-center">
                        <img src="${baseURL}/img/${data.foto}" width="80" height="80">
                    </td>
                    <td class="align-middle">${data.nis}</td>
                    <td class="align-middle">${data.nama}</td>
                    <td class="align-middle">${data.jenis_kelamin}</td>
                    <td class="align-middle">${data.telp}</td>
                    <td class="align-middle">${data.alamat}</td>
                    <td class="align-middle align-center text-center d-flex justify-content-center text-align-center">
                        <a class="btn btn-warning" href="${baseURL}/dataSiswa/form-ubah/${data.id}">Ubah</a>
                        <a href="#" class="btn btn-danger delete-button" data-id="${data.id}">Hapus</a>
                    </td>
                </tr>
            `);
        });
        $('.delete-button').click(function () {
            // Ambil ID dari data yang akan dihapus dari data-id atribut
            const id = $(this).data('id');

            // Tambahkan ID ke URL aksi hapus pada modal
            const modal = $('#confirmDeleteModal');
            modal.find('#confirmDeleteButton').attr('data-href', '<?= BASEURL ?>/dataSiswa/hapus_data/' + id);
            modal.modal('show');
        });

        // Event listener saat tombol konfirmasi hapus di-klik dalam modal
        $('#confirmDeleteButton').click(function () {
            // Ambil URL aksi hapus dari data-href atribut pada tombol
            const deleteUrl = $(this).attr('data-href');

            // Lakukan aksi hapus dengan pergi ke URL aksi hapus
            window.location.href = deleteUrl;
        });
            
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

  


// Fungsi untuk memperbarui tabel dengan hasil pencarian

  });

    </script>

    <!-- Load File jquery.min.js yang ada di folder js -->

    <script src="<?= BASEURL ?>/data/js/bootstrap.min4.js"></script>
  
   
   
    <!-- Load File bootstrap.min.js yang ada di folder js -->
    <script>
    $(document).ready(function () {
        // Event listener saat tombol hapus di-klik
        $('.delete-button').click(function () {
            // Ambil ID dari data yang akan dihapus dari data-id atribut
            const id = $(this).data('id');

            // Tambahkan ID ke URL aksi hapus pada modal
            const modal = $('#confirmDeleteModal');
            modal.find('#confirmDeleteButton').attr('data-href', '<?= BASEURL ?>/dataSiswa/hapus_data/' + id);
            modal.modal('show');
        });

        // Event listener saat tombol konfirmasi hapus di-klik dalam modal
        $('#confirmDeleteButton').click(function () {
            // Ambil URL aksi hapus dari data-href atribut pada tombol
            const deleteUrl = $(this).attr('data-href');

            // Lakukan aksi hapus dengan pergi ke URL aksi hapus
            window.location.href = deleteUrl;
        });
    });
</script>
   
</body>

</html>
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <!-- Tombol untuk mengkonfirmasi hapus -->
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/admin/tambah-buku" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="judul">Judul Buku</label>
                                <input class="form-control" type="text" name="judul" id="judul" required>
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit</label>
                                <select class="form-control" name="penerbit" id="penerbit" required>
                                    <option value="">--- Pilih Penerbit ---</option>
                                    <?php if ($data['penerbit'] != []) : ?>
                                    <?php foreach ($data['penerbit'] as $p) : ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['nama_penerbit'] ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun Terbit</label>
                                <input class="form-control" type="number" name="tahun" id="tahun" required>
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input class="form-control" type="text" name="penulis" id="penulis" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="cover">Cover Buku</label>
                                <input class="form-control" type="file" name="cover" id="cover" required>
                            </div>
                            <div class="form-group">
                                <label for="descripsi">Deskripsi</label>
                                <textarea class="form-control" type="text" name="descripsi" id="descripsi"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input class="form-control" type="text" name="isbn" id="isbn" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" name="kategori" id="kategori" required>
                                    <option value="">--- Pilih Kategori ---</option>
                                    <?php if ($data['kategori'] != []) : ?>
                                    <?php foreach ($data['kategori'] as $k) : ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit" name="submit">Tambah Buku</button>
                <button class="btn btn-danger" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div> -->