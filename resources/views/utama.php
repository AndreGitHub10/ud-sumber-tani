<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form Konversi Stok</title>
	<link rel="stylesheet" href="styles.css"> <!-- Link ke file CSS jika diperlukan -->
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			max-width: 600px;
		}
		h2 {
			text-align: center;
		}
		label {
			display: block;
			margin-bottom: 8px;
		}
		select, input[type="text"], input[type="number"] {
			width: calc(100% - 20px);
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		button {
			padding: 10px 15px;
			background-color: #28a745;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		button:hover {
			background-color: #218838;
		}
	</style>
</head>
<body>
	
	<h2>Form Konversi Stok</h2>
	
	<form id="conversionForm">
		<label for="product">Pilih Produk:</label>
		<select id="product" name="product" required>
			<option value="">-- Pilih Produk --</option>
			<option value="produk1">Produk 1</option>
			<option value="produk2">Produk 2</option>
			<option value="produk3">Produk 3</option>
		</select>
		
		<label for="fromUnit">Dari Satuan:</label>
		<select id="fromUnit" name="fromUnit" required>
			<option value="">-- Pilih Satuan Asal --</option>
			<option value="dus">Dus</option>
			<option value="bal">Bal</option>
		</select>
		
		<label for="toUnit">Ke Satuan:</label>
		<select id="toUnit" name="toUnit" required>
			<option value="">-- Pilih Satuan Tujuan --</option>
			<option value="pcs">Pcs</option>
			<option value="lusin">Lusin</option>
			<option value="kg">Kg</option>
			<option value="gram">Gram</option>
		</select>
		
		<label for="conversionValue">Nilai Konversi:</label>
		<input type="number" id="conversionValue" name="conversionValue" placeholder="Masukkan nilai konversi" required>
		
		<label for="sellingPrice">Harga Jual:</label>
		<input type="text" id="sellingPrice" name="sellingPrice" placeholder="Masukkan harga jual" required>
		
		<button type="submit">Simpan Konversi</button>
	</form>
	
	<script>
		// JavaScript untuk menangani pengiriman form jika diperlukan
		document.getElementById('conversionForm').addEventListener('submit', function(event) {
			event.preventDefault();
			
			// Ambil data dari form
			const product = document.getElementById('product').value;
			const fromUnit = document.getElementById('fromUnit').value;
			const toUnit = document.getElementById('toUnit').value;
			const conversionValue = document.getElementById('conversionValue').value;
			const sellingPrice = document.getElementById('sellingPrice').value;
			
			// Tampilkan data (untuk pengujian)
			console.log(`Produk: ${product}, Dari Satuan: ${fromUnit}, Ke Satuan: ${toUnit}, Nilai Konversi: ${conversionValue}, Harga Jual: ${sellingPrice}`);
			
			// Di sini Anda dapat menambahkan logika untuk menyimpan data ke server atau database
		});
	</script>
	
</body>
</html>