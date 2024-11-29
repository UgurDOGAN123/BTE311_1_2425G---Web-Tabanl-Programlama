<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinamik Tablo Oluşturma</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label for="rows">Satır Sayısı:</label>
        <input type="number" id="rows" name="rows" min="1" required>
        <label for="cols">Sütun Sayısı:</label>
        <input type="number" id="cols" name="cols" min="1" required>
        <button type="submit">Tablo Oluştur</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Kullanıcıdan gelen veri
        $rows = intval($_POST["rows"]);
        $cols = intval($_POST["cols"]);

        if ($rows > 0 && $cols > 0) {
            echo "<table>";
            for ($i = 0; $i < $rows; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $cols; $j++) {
                    $randomNumber = rand(1, 100);
                    echo "<td>$randomNumber</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center; color: red;'>Geçerli bir sayı girin!</p>";
        }
    }
    ?>
</body>
</html>
