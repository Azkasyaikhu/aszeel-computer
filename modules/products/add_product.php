<?php
include '../../config/database.php';

$success_message = "";
$error_message = "";

$category_query = "SELECT * FROM categories WHERE type = 'product'";
$category_result = mysqli_query($conn, $category_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = intval($_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "INSERT INTO products (category_id, name, brand, price, stock, description) 
              VALUES ($category_id, '$name', '$brand', $price, $stock, '$description')";

    if (mysqli_query($conn, $query)) {
        $success_message = "Produk atau sparepart berhasil ditambahkan ke katalog!";
    } else {
        $error_message = "Gagal menyimpan produk: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk & Sparepart - ASZEEL COMPUTER</title>
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
        <p>Form Input Produk, Unit, & Sparepart Baru</p>
    </header>

    <div class="container">
        <h2>Tambah Item Katalog</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert-error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Kategori:</label>
                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php if ($category_result && mysqli_num_rows($category_result) > 0): ?>
                        <?php while ($cat = mysqli_fetch_assoc($category_result)): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="1">Laptop / PC (Default)</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nama Produk / Sparepart:</label>
                <input type="text" name="name" placeholder="Contoh: RAM DDR4 8GB / SSD 512GB / Printer Epson L3210" required>
            </div>

            <div class="form-group">
                <label>Merk / Brand:</label>
                <input type="text" name="brand" placeholder="Contoh: Kingston / Crucial / Epson / Asus" required>
            </div>

            <div class="form-group">
                <label>Harga Satuan (Rp):</label>
                <input type="number" name="price" placeholder="Contoh: 350000" min="0" required>
            </div>

            <div class="form-group">
                <label>Jumlah Stok:</label>
                <input type="number" name="stock" placeholder="Contoh: 10" min="0" value="1" required>
            </div>

            <div class="form-group">
                <label>Deskripsi & Spesifikasi Singkat:</label>
                <textarea name="description" placeholder="Jelaskan spesifikasi atau detail produk" required></textarea>
            </div>

            <button type="submit">Simpan ke Katalog</button>
        </form>

        <div class="nav-links">
            <a href="catalog.php">&larr; Lihat Katalog Produk</a>
            <a href="../../index.php">Kembali ke Beranda &rarr;</a>
        </div>
    </div>

</body>
</html>