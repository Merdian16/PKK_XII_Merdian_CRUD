<?php 
//dipanggil function
require 'function.php';

//diambil dati URL
$id = $_GET["id"];

//query untuk merubah dari yg ada di dalam database
$sws = query("SELECT * FROM siswa WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["update"])){
    //cek apakah data berhasil ditambahkan atau tidak
    if(ubah($_POST) > 0){
        echo"
        <script>
        alert('data telah berhasil dirubah!');
        document.location.href = 'index.php';
        </script>
        ";
    }else{
        echo"
        <script>
        alert('data telah gagal dirubah!');
        document.location.href = 'index.php';
        </script>
        ";
    }
}

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <title>Update Data Siswa</title>
 </head>
 <body>

     <h1>Update Data Siswa</h1>
 <form action="" method="post">
     <input type="hidden" name="id" value="<?= $sws["id"]; ?>">
        <ul>
            <li>
                <label for="nis">NIS:</label>
                <input type="text" name="nis" id="nis"value="<?= $sws["nis"]; ?>" >
        </li>
            <li>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" value="<?= $sws["nama"]; ?>">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?= $sws["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan:</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $sws["jurusan"]; ?>">
            </li>
            <li>
                 <label for="gambar">Gambar:</label>
                <input type="text" name="gambar" id="gambar" value="<?= $sws["gambar"]; ?>">
            </li>
            <li>
                 <button type="submit" name="update">Update Data</button>
            </li>
        </ul>
    </form>
 </body>
 </html>