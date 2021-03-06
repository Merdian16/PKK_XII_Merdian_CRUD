<?php 
//koneksi ke database

$koneksi = mysqli_connect("localhost", "root", "", "pkk");

function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while ($sws = mysqli_fetch_assoc($result)){
        $rows[] = $sws;
    }
    return $rows;
}

function tambah($data)
{
    global $koneksi;
    //ambil data dari form(input)
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);


    //uploud gambar
    $gambar = uploud();
    if(!$gambar){
        return false;
    }

    //query insert data
    $query ="INSERT INTO siswa
    VALUES (id, '$nis', '$nama', '$email', '$jurusan', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

    
}

function uploud(){
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $eror = $_FILES['gambar']['eror'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    if($eror === 4){
        echo "<script>
            alert('pilih gambar dahulu!');
            </script>";
            return false;
    }

    $ekstensiGambarValid =['JPG','jpeg','png','jpg','PNG','JPEG'];
    $ekstensiGambar = explode('-', $namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo "<script>
        alert('yang anda uploud bukan gambar');
        </script>";
    }
}

function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($koneksi);

}

function cari($keyword){
    $query = "SELECT * FROM siswa
                WHERE
                nis LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";
        return query($query);
}
 ?>