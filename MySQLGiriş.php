<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Örneği</title>
</head>
<body>
    <h1>PHP Form İşlemleri</h1>

    
    <h2>Kişi Ekle</h2>
    <form method="POST">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required><br><br>
        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>
        <button type="submit" name="add_user">Ekle</button>
    </form>

    
    <h2>Kişi Ara</h2>
    <form method="POST">
        <label for="search_ad">Ad:</label>
        <input type="text" id="search_ad" name="search_ad" required>
        <button type="submit" name="search_user">Bul</button>
    </form>


    <?php
// Veritabanı bağlantısı
$servername = "localhost"; // Sunucu adı
$username = "root"; // Kullanıcı adı
$password = ""; // Şifre
$dbname = "test"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);


// Form 1: Veritabanına veri ekleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $ad = $conn->real_escape_string($_POST['ad']);
    $soyad = $conn->real_escape_string($_POST['soyad']);
    $email = $conn->real_escape_string($_POST['email']);
    $sql = "INSERT INTO kişi (ad, soyad, email) VALUES ('$ad', '$soyad', '$email')";
    $conn->query($sql);
}

// Form 2: Veri arama
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_user'])) {
    $ad = $conn->real_escape_string($_POST['search_ad']);
    $sql = "SELECT soyad, email FROM kişi WHERE ad='$ad'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Sonuçlar:</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "Soyad: " . $row['soyad'] . " - Email: " . $row['email'] . "<br>";
        }
    } else {
        echo "Kişi bulunamadı.";
    }
}

$conn->close();
?>
</body>
</html>