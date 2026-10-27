<?php
include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASZEEL COMPUTER - Jual Beli, Servis, & Percetakan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1e293b; color: #fff; padding: 20px; text-align: center; }
        nav { display: flex; justify-content: center; background: #334155; padding: 10px; }
        nav a { color: white; text-decoration: none; margin: 0 15px; font-weight: bold; }
        nav a:hover { color: #38bdf8; }
        .container { max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .hero { text-align: center; padding: 40px 20px; }
        .hero h2 { color: #0f172a; }
        .features { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 30px; }
        .card { background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 6px; text-align: center; }
        .card h3 { color: #1e293b; }
        footer { text-align: center; padding: 15px; background: #1e293b; color: white; margin-top: 40px; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Pusat Jual Beli Laptop, Printer, PC, Sparepart, Servis, & Percetakan</p>
    </header>

    <nav>
        <a href="index.php">Beranda</a>
        <a href="#products">Katalog Produk</a>
        <a href="#services">Cek Servis</a>
        <a href="#printing">Percetakan</a>
    </nav>

    <div class="container">
        <div class="hero">
            <h2>Selamat Datang di Sistem Manajemen ASZEEL COMPUTER</h2>
            <p>Solusi cepat dan terpercaya untuk kebutuhan perangkat keras dan dokumen Anda.</p>
        </div>

        <div class="features">
            <div class="card">
                <h3>💻 Jual Beli</h3>
                <p>Laptop, PC, Printer, dan ketersediaan sparepart lengkap.</p>
            </div>
            <div class="card">
                <h3>🛠️ Jasa Servis</h3>
                <p>Perbaikan perangkat dengan fitur pelacakan status servis.</p>
            </div>
            <div class="card">
                <h3>🖨️ Percetakan</h3>
                <p>Layanan cetak dokumen, foto, undangan, dan fotokopi.</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 ASZEEL COMPUTER. All rights reserved.</p>
    </footer>

</body>
</html>