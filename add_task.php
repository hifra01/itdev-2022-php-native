<?php

include('db.php');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $namaKegiatan = $_POST["namaKegiatan"];
    $jenisKegiatan = $_POST["jenisKegiatan"];
    $deadlineKegiatan = $_POST["deadlineKegiatan"];
    $keterangan = $_POST["keterangan"];

    $query = $conn->prepare("INSERT INTO kegiatan (nama_kegiatan, jenis_kegiatan, deadline_kegiatan, keterangan) VALUES (?, ?, ?, ?)");
    
    $query->bind_param('ssss', $namaKegiatan, $jenisKegiatan, $deadlineKegiatan, $keterangan);

    $result = $query->execute();

    if (!$result) {
        die("Execution failed");
    }

    header("Location: index.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah tugas</title>
</head>
<body>
    <form action="#" method="post">
        <div>
            <label for="namaKegiatan">Nama kegiatan</label>
            <input type="text" name="namaKegiatan" id="namaKegiatan">
        </div>
        <div>
            <label for="jenisKegiatan">Jenis kegiatan</label>
            <select name="jenisKegiatan" id="jenisKegiatan">
                <option value="mendesak">Mendesak</option>
                <option value="tidak mendesak">Tidak mendesak</option>
            </select>
        </div>
        <div>
            <label for="deadlineKegiatan">Deadline kegiatan</label>
            <input type="date" name="deadlineKegiatan" id="deadlineKegiatan">
        </div>
        <div>
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
        </div>
        <input type="submit" value="Tambah tugas baru">
    </form>
</body>
</html>