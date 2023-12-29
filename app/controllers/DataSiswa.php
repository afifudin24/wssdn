<?php

class DataSiswa extends Controller {

    private $siswaModel;
    private $agamaModel;

    function __construct()
    {
        // if (SessionManager::checkSession()) {
        //     $this->payload = SessionManager::getCurrentSession();
        //     if ($this->payload->role != 1) {
        //         header('Location: ' . BASEURL . '/login');
        //     }
        // } else {
        //     header('Location: ' . BASEURL . '/login');
        // }

        $this->siswaModel = $this->model('Siswa_model');
        $this->agamaModel = $this->model('Agama_model');

    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->siswaModel->getAllSiswa(isset($keyword) ? $keyword : null);
        // $this->view('header', $data);
        $this->view('dataSiswa/index', $data);
        // $this->view('footer');
        
    }

    public function cariSiswa()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : null;
        
        // Lakukan pencarian siswa berdasarkan keyword
        $results = $this->siswaModel->cariSiswaByKeyword($keyword);

        // Set header untuk menandakan bahwa respons adalah JSON
        header('Content-Type: application/json');

        // Kirim hasil pencarian sebagai respons JSON
        echo json_encode($results);
        exit; // Pastikan untuk menghentikan eksekusi setelah mengirim respons
    }
}


    public function form_simpan()
    {
      
      
        $this->view('dataSiswa/form-simpan');
    }

    public function tambahSiswa(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/datasiswa/');
        }
      
      

       $result = $this->siswaModel->tambahSiswa($_POST);
    
    //    Flasher::setFlash('Berhasil menambahkan siswa', 'success');
        header('Location: ' . BASEURL . '/datasiswa');
    }
//     public function tambahSiswa() {
//         if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//             header('Location: ' . BASEURL . '/datasiswa/');
//             exit;
//         }
    
//         $data = $_POST;

//         // Prepared statement untuk query INSERT
//         $query = "INSERT INTO ilkomfina VALUES (null, :nis, :nama, :jenis_kelamin, :telp, :alamat, :foto)";
//         $stmt = $this->db->prepare($query);
        
//         // Loop untuk setiap data siswa
//         foreach ($data['nis'] as $key => $nis) {
//             // Lakukan binding parameter pada prepared statement
//             $stmt->bindParam(':nis', $nis);
//             $stmt->bindParam(':nama_siswa', $data['nama'][$key]);
//             $stmt->bindParam(':alamat', $data['alamat'][$key]);
//             $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin'][$key]);
//             $stmt->bindParam(':telp', $data['telp'][$key]);
        
//             // Proses upload foto jika dibutuhkan
//             $foto = 'default.png'; // Atur default jika tidak ada foto yang diupload
//             if (!empty($_FILES['foto']['name'][$key])) {
//                 $foto = $_FILES['foto']['name'][$key];
//                 move_uploaded_file($_FILES['foto']['tmp_name'][$key], "img/".$foto);
//             }
//             $stmt->bindParam(':foto', $foto);
        
//             try {
//                 // Eksekusi query
//                 $stmt->execute();
//             } catch (\PDOException $e) {
//                 if ($e->errorInfo[1] == 1062) {
//                     return 0; // Tangani jika ada kunci duplikat (1062 adalah kode MySQL untuk kunci duplikat)
//                     die;
//                 }
//                 // Tangani pesan kesalahan lain jika diperlukan
//                 echo "Error: " . $e->getMessage();
//             }
    
//         return true; // Atau nilai lain yang sesuai dengan kebutuhan Anda
//     }
// }
    


    public function updatesiswa($id = 0){
       
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/datasiswa/');
        } else if
        ($_SERVER['REQUEST_METHOD'] == 'POST') {
          var_dump($id);
          var_dump($_POST);
         
            $this->siswaModel->updateSiswa($id, $_POST);
            Flasher::setFlash('Siswa berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }
        // $this->siswaModel->tambahSiswa($_POST);
        // Flasher::setFlash('Berhasil menambahkan siswa', 'success');
        // header('Location: ' . BASEURL . '/datasiswa');
    }


    public function form_ubah($id = 0)
    {
       

        if ($id) {
            $data['siswa'] = $this->siswaModel->getDetailSiswa($id);
            $data['agama'] = $this->agamaModel->getAllAgama();

            $this->view('dataSiswa/form-ubah', $data);
        } else {
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }
    }

    public function hapus_data($id = 0)
    {
        
        if ($id) {
            $hapus = $this->siswaModel->hapusSiswa($id);
            
            if ($hapus == 0) {
                Flasher::setFlash('Siswa tidak ditemukan', 'danger');
                header('Location: ' . BASEURL . '/dataSiswa/index');
            } else {
                Flasher::setFlash('Siswa berhasil dihapus', 'success');
                header('Location: ' . BASEURL . '/dataSiswa/index');
            }
        } else {
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }
    }

    public function importExcel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_excel'])) {
            // Lokasi penyimpanan sementara file yang diupload
            $fileTmpPath = $_FILES['file_excel']['tmp_name'];
    
            // Nama file yang diupload
            $fileName = $_FILES['file_excel']['name'];
            
            // Cek apakah file yang diupload adalah file Excel
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowedExtensions = ['xls', 'xlsx'];
    
            if (in_array($fileExtension, $allowedExtensions)) {
                // Pindahkan file yang diupload ke lokasi yang diinginkan
                $targetPath = 'import/' . $fileName;
                move_uploaded_file($fileTmpPath, $targetPath);
    
                // Lakukan proses import dari file Excel ke database
                // Gunakan PHPExcel atau PHPSpreadsheet untuk membaca data dari file Excel
                // Lakukan logika untuk menyimpan data ke dalam database
    
                // Contoh menggunakan PHPSpreadsheet (menggunakan Composer)
                require  '../vendor/autoload.php';
               
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
                $worksheet = $spreadsheet->getActiveSheet();
    
                $highestRow = $worksheet->getHighestDataRow();
    
                // Misalnya, Anda ingin menyimpan data ke dalam array untuk proses lebih lanjut
                $dataToInsert = [];
    
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [
                        'nis' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                        'nama' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                        'jenis_kelamin' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
                        'telp' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                        'alamat' => $worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                        'foto' => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                        // Lanjutkan dengan mengambil data lainnya sesuai struktur Excel Anda
                    ];
    
                    // Tambahkan data ke dalam array untuk proses selanjutnya
                    $dataToInsert[] = $rowData;
                }
    
                // Lakukan proses penyimpanan data ke dalam database
                // Misalnya, Anda memiliki model untuk menyimpan data ke dalam tabel siswa
                // Anda dapat menggunakan model tersebut untuk menyimpan data
              $this->siswaModel->importDataFromExcel($dataToInsert);

            
                // Setelah data disimpan, Anda bisa menghapus file yang diupload jika perlu
                unlink($targetPath);
    
                // Set flash message untuk memberi notifikasi bahwa import berhasil
                // Flasher::setFlash('Data berhasil diimport dari Excel', 'success');
                header('Location: ' . BASEURL . '/dataSiswa');
            } else {
                // Jika file yang diupload bukan file Excel
                Flasher::setFlash('Format file tidak didukung, hanya file Excel yang diizinkan', 'danger');
                header('Location: ' . BASEURL . '/dataSiswa');
            }
        }
    }
    
}