<?php
include '../../config/database.php';

$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $print_type = mysqli_real_escape_string($conn, $_POST['print_type']);
    $paper_type = mysqli_real_escape_string($conn, $_POST['paper_type']);
    $quantity = intval($_POST['quantity']);
    
    $price_per_unit = 0;
    switch ($print_type) {
        case 'Document':
            $price_per_unit = 500; // Rp 500 per lembar
            break;
        case 'Photo':
            $price_per_unit = 3000; // Rp 3.000 per lembar foto
            break;
        case 'Invitation':
            $price_per_unit = 2500; // Rp 2.500 per undangan
            break;
        case 'Photocopy':
            $price_per_unit = 300; // Rp 300 per lembar fotokopi
            break;
    }
    
    $total_price = $price_per_unit * $quantity;


    $query = "INSERT INTO printing_orders (customer_name, print_type, paper_type, quantity, total_price, status) 
              VALUES ('$customer_name', '$print_type', '$paper_type', '$quantity', '$total_price', 'Queued')";
    
    if (mysqli_query($conn, $query)) {
        $success_message = "Pesanan cetak berhasil dibuat! Total Biaya: Rp " . number_format($total_price, 0, ',', '.');
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Percetakan - ASZEEL COMPUTER</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1e293b; color: #fff; padding: 20px; text-align: center; }
        .container { max-width: 600px; margin: 40px auto; padding: 25px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #0f172a; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 16px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #0284c7; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background: #0369a1; }
        .alert-success { color: #166534; background: #dcfce7; padding: 12px; border-radius: 4px; text-align: center; margin-bottom: 20px; font-weight: bold; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #0284c7; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Kalkulator & Pemesanan Layanan Percetakan</p>
    </header>

    <div class="container">
        <h2>Form Pemesanan Cetak</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Pemesan:</label>
                <input type="text" name="customer_name" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="form-group">
                <label>Jenis Layanan Cetak:</label>
                <select name="print_type" required>
                    <option value="">-- Pilih Jenis Cetak --</option>
                    <option value="Document">Print Dokumen (Rp 500 / lbr)</option>
                    <option value="Photo">Cetak Foto (Rp 3.000 / lbr)</option>
                    <option value="Invitation">Cetak Undangan (Rp 2.500 / lbr)</option>
                    <option value="Photocopy">Fotokopi (Rp 500 / lbr)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Kertas:</label>
                <input type="text" name="paper_type" placeholder="Contoh: HVS 70gsm / A4 / Glossy Photo" required>
            </div>

            <div class="form-group">
                <label>Jumlah (Lembar/Pcs):</label>
                <input type="number" name="quantity" min="1" placeholder="Masukkan jumlah" required>
            </div>

            <button type="submit">Hitung & Pesan Sekarang</button>
        </form>

        <a href="../../index.php" class="back-link">&larr; Kembali ke Beranda</a>
    </div>

</body>
</html>