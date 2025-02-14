<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "domain_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tambah Domain
if (isset($_POST['add'])) {
    $domain = $_POST['domain'];
    $ssl_expiry = $_POST['ssl_expiry'];
    $email = $_POST['email'];
    $sql = "INSERT INTO domains (domain_name, ssl_expiry, email) VALUES ('$domain', '$ssl_expiry', '$email')";
    $conn->query($sql);
}

// Edit Domain
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $domain = $_POST['domain'];
    $ssl_expiry = $_POST['ssl_expiry'];
    $email = $_POST['email'];
    $sql = "UPDATE domains SET domain_name='$domain', ssl_expiry='$ssl_expiry', email='$email' WHERE id=$id";
    $conn->query($sql);
}

// Hapus Domain
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM domains WHERE id=$id";
    $conn->query($sql);
}

// Kirim Email Pemberitahuan
if (isset($_GET['notify'])) {
    $id = $_GET['notify'];
    $result = $conn->query("SELECT * FROM domains WHERE id=$id");
    $data = $result->fetch_assoc();

    $to = $data['email'];
    $subject = "Peringatan SSL Kadaluarsa untuk " . $data['domain_name'];
    $message = "Halo,\n\nSertifikat SSL untuk domain " . $data['domain_name'] . " akan kadaluarsa pada " . $data['ssl_expiry'] . ". Harap segera diperbarui.\n\nTerima kasih.";
    $headers = "From: no-reply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Email berhasil dikirim ke $to');</script>";
    } else {
        echo "<script>alert('Gagal mengirim email');</script>";
    }
}

// Ambil Data
$result = $conn->query("SELECT * FROM domains");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Domain</title>
</head>
<body>
    <h2>Daftar Domain</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Domain</th>
            <th>Masa Berlaku SSL</th>
            <th>Email</th>
            <th>Status SSL</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): 
            $status = (strtotime($row['ssl_expiry']) < time()) ? "<span style='color:red;'>Kadaluarsa</span>" : "<span style='color:green;'>Aktif</span>";
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['domain_name'] ?></td>
            <td><?= $row['ssl_expiry'] ? $row['ssl_expiry'] : 'SSL Tidak Tersedia' ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $status ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus domain ini?')">Hapus</a> |
                <a href="index.php?notify=<?= $row['id'] ?>">Kirim Notifikasi</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Tambah Domain</h2>
    <form method="POST">
        <input type="text" name="domain" placeholder="Nama Domain" required>
        <input type="date" name="ssl_expiry" required>
        <input type="email" name="email" placeholder="Email Pemberitahuan" required>
        <button type="submit" name="add">Tambah</button>
    </form>

    <?php if (isset($_GET['edit'])):
        $id = $_GET['edit'];
        $editResult = $conn->query("SELECT * FROM domains WHERE id=$id");
        $editData = $editResult->fetch_assoc();
    ?>
    <h2>Edit Domain</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <input type="text" name="domain" value="<?= $editData['domain_name'] ?>" required>
        <input type="date" name="ssl_expiry" value="<?= $editData['ssl_expiry'] ?>" required>
        <input type="email" name="email" value="<?= $editData['email'] ?>" required>
        <button type="submit" name="edit">Simpan</button>
    </form>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
