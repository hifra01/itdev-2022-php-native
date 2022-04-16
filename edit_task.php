<?php
    include('db.php');

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $id = $_POST["id"];
        $namaKegiatan = $_POST["namaKegiatan"];
        $jenisKegiatan = $_POST["jenisKegiatan"];
        $deadlineKegiatan = $_POST["deadlineKegiatan"];
        $keterangan = $_POST["keterangan"];
    
        $query = $conn->prepare("UPDATE kegiatan SET nama_kegiatan = ?, jenis_kegiatan = ?, deadline_kegiatan = ?, keterangan = ? WHERE id = ?");
        
        $query->bind_param('sssss', $namaKegiatan, $jenisKegiatan, $deadlineKegiatan, $keterangan, $id);
    
        $result = $query->execute();
    
        if (!$result) {
            die("Execution failed");
        }
    
        header("Location: index.php");
    
    }

    if ($_GET['id'] === null) {
        die('ID required!');
    }

    $id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM kegiatan WHERE id = ?");

    $query->bind_param('s', $id);

    $result = $query->execute();

    if (!$result) {
        die("Execution failed");
    }

    $data = mysqli_fetch_assoc($query->get_result());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit tugas</title>
</head>
<body>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div>
            <label for="namaKegiatan">Nama kegiatan</label>
            <input type="text" name="namaKegiatan" id="namaKegiatan" value="<?= $data['nama_kegiatan'] ?>">
        </div>
        <div>
            <label for="jenisKegiatan">Jenis kegiatan</label>
            <select name="jenisKegiatan" id="jenisKegiatan">
                <option value="mendesak" <?= $data['jenis_kegiatan'] === 'mendesak' ? 'selected' : '' ?> >Mendesak</option>
                <option value="tidak mendesak" <?= $data['jenis_kegiatan'] !== 'mendesak' ? 'selected' : '' ?> >Tidak mendesak</option>
            </select>
        </div>
        <div>
            <label for="deadlineKegiatan">Deadline kegiatan</label>
            <input type="date" name="deadlineKegiatan" id="deadlineKegiatan" value="<?= $data['deadline_kegiatan'] ?>">
        </div>
        <div>
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="5"><?= $data['keterangan'] ?></textarea>
        </div>
        <input type="submit" value="Perbarui tugas">
    </form>
</body>
</html>