<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dosya İşlemleri</title>
</head>
<body>
    <h1>Dosyaya Yaz ve Oku</h1>

    <!-- Form -->
    <form method="post">
        <label for="yazi">Metin Girin:</label><br>
        <input type="text" id="yazi" name="yazi" required>
        <button type="submit">Gönder</button>
    </form>

    <?php
    $yeniYazi = trim($_POST['yazi']) . PHP_EOL;
    $dosyaAdi = "BeniOku.txt";
    $dosya = fopen($dosyaAdi, "a");
    if ($dosya) {
        fwrite($dosya, $yeniYazi);
        fclose($dosya);
    }
    echo "<h2>Dosyanın İçeriği:</h2>";
        $dosya = fopen($dosyaAdi, "r");
        if ($dosya) {
            while (!feof($dosya)) {
                $satir = fgets($dosya);
                echo htmlspecialchars($satir) . "<br>";
            }
            fclose($dosya);}
    ?>
</body>
</html>