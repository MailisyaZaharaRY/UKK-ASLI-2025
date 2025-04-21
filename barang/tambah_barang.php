<?php
include 'db.php';

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses tambah barang
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO Barang (NamaBarang, KategoriID, Stok, Harga, TanggalMasuk) 
            VALUES ('$nama', '$kategori', '$stok', '$harga', '$tanggal')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
        
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        h2 {
            color: #6c5ce7;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #6c5ce7;
            border: none;
            border-radius: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4 text-center"><i class="bi bi-plus-circle"></i> Tambah Barang</h2>
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <?php
                    $check_kategori = "SELECT ID,NamaKategori FROM Kategori ";
                    $result = $conn->query($check_kategori);
                    while ($row = $result->fetch_assoc()){

                        echo"<option value='$row[ID]'>$row[NamaKategori]</option>";


                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">💾 Tambah Barang</button>
                <a href="index.php" class="btn btn-secondary">⬅️ Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
