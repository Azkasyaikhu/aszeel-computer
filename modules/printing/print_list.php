<?php
include '../../config/database.php';

$query = "SELECT * FROM printing_orders ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan Percetakan - ASZEEL COMPUTER</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1e293b; color: #fff; padding: 20px; text-align: center; }
        .container { max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #0f172a; text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e1; padding: 12px; text-align: left; }
        th { background-color: #1e293b; color: white; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .status { font-weight: bold; color: #0284c7; }
        .nav-links { display: flex; justify-content: space-between; margin-top: 25px; }
        .nav-links a { color: #0284c7; text-decoration: none; }
        .nav-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Manajemen Antrean Layanan Percetakan & Fotokopi</p>
    </header>

    <div class="container">
        <h2>Daftar Pesanan Cetak Masuk</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Jenis Cetak</th>
                    <th>Kertas</th>
                    <th>Jumlah</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if ($result && mysqli_num_rows($result) > 0): 
                    while ($row = mysqli_fetch_assoc($result)): 
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo htmlspecialchars($row['customer_name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['print_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['paper_type']); ?></td>
                        <td><?php echo $row['quantity']; ?> lbr/pcs</td>
                        <td>Rp <?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>
                        <td class="status"><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #64748b;">Belum ada pesanan cetak masuk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="nav-links">
            <a href="print_calculator.php">&larr; Buat Pesanan Cetak Baru</a>
            <a href="../../index.php">Kembali ke Beranda &rarr;</a>
        </div>
    </div>

</body>
</html>