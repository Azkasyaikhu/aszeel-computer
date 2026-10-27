<?php
// Memasukkan file koneksi (karena posisinya di dalam folder modules/services, naik dua tingkat ke root lalu ke config)
include '../../config/database.php';

$search_result = null;
$error_message = "";

if (isset($_GET['code'])) {
    $code = mysqli_real_escape_string($conn, $_GET['code']);
    
    // Cari data servis berdasarkan kode unik
    $query = "SELECT * FROM service_orders WHERE service_code = '$code'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $search_result = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Kode servis tidak ditemukan. Silakan periksa kembali.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Servis - ASZEEL COMPUTER</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1e293b; color: #fff; padding: 20px; text-align: center; }
        .container { max-width: 600px; margin: 40px auto; padding: 25px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #0f172a; text-align: center; }
        form { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"] { flex: 1; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 16px; }
        button { padding: 10px 20px; background: #0284c7; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0369a1; }
        .result-card { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 6px; margin-top: 20px; }
        .alert-error { color: #dc2626; background: #fee2e2; padding: 10px; border-radius: 4px; text-align: center; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #0284c7; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Sistem Pelacakan Status Servis Perangkat</p>
    </header>

    <div class="container">
        <h2>Cek Status Perbaikan</h2>
        <form method="GET" action="">
            <input type="text" name="code" placeholder="Masukkan Kode Servis (Contoh: SRV001)" value="<?php echo isset($_GET['code']) ? htmlspecialchars($_GET['code']) : ''; ?>" required>
            <button type="submit">Cek Status</button>
        </form>

        <?php if (!empty($error_message)): ?>
            <div class="alert-error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if ($search_result): ?>
            <div class="result-card">
                <h3>Detail Perangkat Servis</h3>
                <p><strong>Kode Servis:</strong> <?php echo htmlspecialchars($search_result['service_code']); ?></p>
                <p><strong>Nama Pelanggan:</strong> <?php echo htmlspecialchars($search_result['customer_name']); ?></p>
                <p><strong>Jenis Perangkat:</strong> <?php echo htmlspecialchars($search_result['device_type'] . ' - ' . $search_result['device_name']); ?></p>
                <p><strong>Keluhan:</strong> <?php echo htmlspecialchars($search_result['issue_description']); ?></p>
                <p><strong>Status Saat Ini:</strong> <span style="color: #0284c7; font-weight: bold;"><?php echo htmlspecialchars($search_result['status']); ?></span></p>
                <p><strong>Estimasi Biaya:</strong> Rp <?php echo number_format($search_result['estimated_cost'], 0, ',', '.'); ?></p>
            </div>
        <?php endif; ?>

        <a href="../../index.php" class="back-link">&larr; Kembali ke Beranda</a>
    </div>

</body>
</html>