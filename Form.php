<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evet Hayır Formu</title>
</head>
<body>

<h1>Evet mi Hayır mı?</h1>

<form action="submit.php" method="post">
    <label>
        <input type="radio" name="answer" value="Evet" required> Evet
    </label><br>
    <label>
        <input type="radio" name="answer" value="Hayır" required> Hayır
    </label><br><br>
    
    <button type="submit">Gönder</button>
</form>

<?php
$conn = new mysqli("localhost", "root", "", "test");

$answer = $_POST['answer'];

$sql = "INSERT INTO responses (answer) VALUES ('$answer')";

if ($conn->query($sql) === TRUE) {
    echo "Cevabınız kaydedildi: " . $answer;
} else {
    echo "Hata: " . $conn->error;
}

$conn->close();
?>


</body>
</html>