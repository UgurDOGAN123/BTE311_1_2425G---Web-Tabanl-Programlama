<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Örneği</title>
</head>
<body>
    <!-- Tablo: kişi, sütunlar: ad, soyad, email, dersi_sevdin_mi-->
    <h1>PHP Form İşlemleri</h1>

    
    <h2>Kişi Ekle</h2>
    <form method="POST">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required><br><br>
        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>
        
        <label>Dersi sevdin mi?</label><br>
        <input type="radio" id="evet" name="dersi_sevdin_mi" value="evet" required>
        <label for="evet">Evet</label><br>
        <input type="radio" id="hayir" name="dersi_sevdin_mi" value="hayir" required>
        <label for="hayir">Hayır</label><br><br>

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
    $dersi_sevdin_mi = $conn->real_escape_string($_POST['dersi_sevdin_mi']);
    $sql = "INSERT INTO kişi (ad, soyad, email, dersi_sevdin_mi) VALUES ('$ad', '$soyad', '$email', '$dersi_sevdin_mi')";
    $conn->query($sql);
}

// Form 2: Veri arama
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_user'])) {
    $ad = $conn->real_escape_string($_POST['search_ad']);
    $sql = "SELECT soyad, email, dersi_sevdin_mi FROM kişi WHERE ad='$ad'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Sonuçlar:</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "Soyad: " . $row['soyad'] . " - Email: " . $row['email'] . " - Dersi Sevdi mi?: " . $row['dersi_sevdin_mi']."<br>";
        }
    } else {
        echo "Kişi bulunamadı.";
    }
}

$conn->close();
?>
</body>
</html>