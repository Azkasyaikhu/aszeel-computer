<?php
include '../../config/database.php';


$query = "SELECT products.*, categories.name as category_name 
          FROM products 
          LEFT JOIN categories ON products.category_id = categories.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk & Sparepart - ASZEEL COMPUTER</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f6f9; color: #333; }
        header { background: #1e293b; color: #fff; padding: 20px; text-align: center; }
        .container { max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #0f172a; text-align: center; margin-bottom: 25px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .product-card { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 6px; display: flex; flex-direction: column; justify-content: space-between; }
        .product-card h3 { color: #1e293b; margin-top: 0; margin-bottom: 10px; }
        .price { color: #0284c7; font-weight: bold; font-size: 18px; margin: 10px 0; }
        .badge { background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-size: 12px; display: inline-block; margin-bottom: 10px; }
        .empty-msg { text-align: center; color: #64748b; grid-column: 1 / -1; padding: 20px; }
        .back-link { display: block; text-align: center; margin-top: 30px; color: #0284c7; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <h1>ASZEEL COMPUTER</h1>
        <p>Katalog Produk, Laptop, Printer, PC, & Sparepart</p>
    </header>

    <div class="container">
        <h2>Daftar Produk Tersedia</h2>

        <div class="product-grid">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card">
                        <div>
                            <span class="badge"><?php echo htmlspecialchars($row['category_name'] ?? 'Umum'); ?></span>
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p style="font-size: 14px; color: #64748b;"><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                        <div>
                            <div class="price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></div>
                            <p style="font-size: 13px; margin: 0; color: #334155;">Stok: <strong><?php echo $row['stock']; ?></strong> unit</p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-msg">Belum ada produk yang ditambahkan ke database. Silakan masukkan data produk melalui database MySQL terlebih dahulu.</div>
            <?php endif; ?>
        </div>

        <a href="../../index.php" class="back-link">&larr; Kembali ke Beranda</a>
    </div>

</body>
</html>