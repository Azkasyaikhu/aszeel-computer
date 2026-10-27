<?php
include '../../config/database.php';

$query = "SELECT * FROM service_orders ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Servis Masuk - ASZEEL COMPUTER</title>
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
        .back-link { display: block; text-align: center; margin-top: 25px; color: #0284c7; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Manajemen Daftar Servis Perangkat Masuk</p>
    </header>

    <div class="container">
        <h2>Daftar Antrean & Status Servis</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Servis</th>
                    <th>Nama Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Estimasi Biaya</th>
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
                        <td><strong><?php echo htmlspecialchars($row['service_code']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['device_type'] . ' - ' . $row['device_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['issue_description']); ?></td>
                        <td class="status"><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>Rp <?php echo number_format($row['estimated_cost'], 0, ',', '.'); ?></td>
                    </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #64748b;">Belum ada data servis masuk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="../../index.php" class="back-link">&larr; Kembali ke Beranda</a>
    </div>

</body>
</html>