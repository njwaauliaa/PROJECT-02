<?php
include 'db_koneksi.php';

$query = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
</head>
<body>
    <h2>Daftar Pengguna</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kata Sandi</th>
            <th>Peran</th>
            <th>Tanggal Dibuat</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id_pengguna'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['kata_sandi'] ?></td>
            <td><?= $row['peran'] ?></td>
            <td><?= $row['tanggal_dibuat'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
