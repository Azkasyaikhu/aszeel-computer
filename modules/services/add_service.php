<?php
include '../../config/database.php';

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Generate kode servis otomatis (Contoh: SRV + angka acak/waktu)
    $service_code = "SRV" . strtoupper(substr(uniqid(), -5));
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
    $device_type = mysqli_real_escape_string($conn, $_POST['device_type']);
    $device_name = mysqli_real_escape_string($conn, $_POST['device_name']);
    $issue_description = mysqli_real_escape_string($conn, $_POST['issue_description']);
    $estimated_cost = floatval($_POST['estimated_cost']);

    $query = "INSERT INTO service_orders (service_code, customer_name, customer_phone, device_type, device_name, issue_description, status, estimated_cost) 
              VALUES ('$service_code', '$customer_name', '$customer_phone', '$device_type', '$device_name', '$issue_description', 'Pending', '$estimated_cost')";

    if (mysqli_query($conn, $query)) {
        $success_message = "Data servis berhasil ditambahkan! Kode Servis Pelanggan: <strong>" . $service_code . "</strong>";
    } else {
        $error_message = "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Servis Masuk - ASZEEL COMPUTER</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1e293b; color: #fff; padding: 20px; text-align: center; }
        .container { max-width: 600px; margin: 30px auto; padding: 25px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #0f172a; text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 16px; box-sizing: border-box; }
        textarea { resize: vertical; height: 80px; }
        button { width: 100%; padding: 12px; background: #0284c7; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background: #0369a1; }
        .alert-success { color: #166534; background: #dcfce7; padding: 12px; border-radius: 4px; text-align: center; margin-bottom: 20px; }
        .alert-error { color: #dc2626; background: #fee2e2; padding: 12px; border-radius: 4px; text-align: center; margin-bottom: 20px; }
        .nav-links { display: flex; justify-content: space-between; margin-top: 25px; }
        .nav-links a { color: #0284c7; text-decoration: none; }
        .nav-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Form Pendaftaran Servis Perangkat Masuk</p>
    </header>

    <div class="container">
        <h2>Input Servis Baru</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert-error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Pemilik / Pelanggan:</label>
                <input type="text" name="customer_name" placeholder="Nama lengkap pelanggan" required>
            </div>

            <div class="form-group">
                <label>Nomor Telepon / WhatsApp:</label>
                <input type="text" name="customer_phone" placeholder="Contoh: 081234567890" required>
            </div>

            <div class="form-group">
                <label>Jenis Perangkat:</label>
                <select name="device_type" required>
                    <option value="">-- Pilih Perangkat --</option>
                    <option value="Laptop">Laptop</option>
                    <option value="PC">PC / Komputer</option>
                    <option value="Printer">Printer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Merk & Tipe Perangkat:</label>
                <input type="text" name="device_name" placeholder="Contoh: Asus Vivobook / Epson L3210" required>
            </div>

            <div class="form-group">
                <label>Keluhan / Kerusakan:</label>
                <textarea name="issue_description" placeholder="Jelaskan kendala perangkat secara singkat" required></textarea>
            </div>

            <div class="form-group">
                <label>Estimasi Biaya Awal (Rp):</label>
                <input type="number" name="estimated_cost" placeholder="Contoh: 150000" value="0" required>
            </div>

            <button type="submit">Simpan & Buat Kode Servis</button>
        </form>

        <div class="nav-links">
            <a href="service_list.php">&larr; Lihat Daftar Servis</a>
            <a href="../../index.php">Kembali ke Beranda &rarr;</a>
        </div>
    </div>

</body>
</html>