<?php
    include('db.php');

    $query = "SELECT * FROM `kegiatan`";

    $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
</head>
<body>
    <h1>To-do list</h1>
    <a href="add_task.php">Tambah tugas baru</a>
    <br>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama kegiatan</th>
                <th>Jenis kegiatan</th>
                <th>Deadline kegiatan</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama_kegiatan'] ?></td>
                    <td><?= $row['jenis_kegiatan'] ?></td>
                    <td><?= $row['deadline_kegiatan'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['status'] ? 'selesai' : 'belum selesai' ?></td> <!-- ternary operator -->
                    <td>
                        <?php if (!$row['status']): ?>
                            <a href="mark_done.php?id=<?= $row['id'] ?>"><button>Selesai</button></a>
                        <?php endif ?>
                        <a href="edit_task.php?id=<?= $row['id'] ?>"><button>Edit</button></a>
                        <a href="delete_task.php?id=<?= $row['id'] ?>"><button>Hapus</button></a>
                    </td>
                </tr>
            <?php endwhile?>
        </tbody>
    </table>
</body>
</html>