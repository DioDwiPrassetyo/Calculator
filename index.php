<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Arithmetic Calculator</h1>
        <form method="post">
            <input type="number" name="angka1" placeholder="Angka Pertama" step="any" required>
            <select name="operasi" required>
                <option value="tambah">+</option>
                <option value="kurang">-</option>
                <option value="kali">×</option>
                <option value="bagi">÷</option>
                <option value="modulus">%</option>
                <option value="pangkat">^</option>
            </select>
            <input type="number" name="angka2" placeholder="Angka Kedua" step="any" required>
            <button type="submit">Hitung Hasil</button>
        </form>

        <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $angka1 = floatval($_POST["angka1"]);
            $angka2 = floatval($_POST["angka2"]);
            $operasi = $_POST["operasi"];
            $hasil = "";
            $operator = "";

            switch ($operasi) {
                case "tambah":
                    $hasil = $angka1 + $angka2;
                    $operator = "+";
                    break;
                case "kurang":
                    $hasil = $angka1 - $angka2;
                    $operator = "-";
                    break;
                case "kali":
                    $hasil = $angka1 * $angka2;
                    $operator = "×";
                    break;
                case "bagi":
                    if ($angka2 != 0) {
                        $hasil = $angka1 / $angka2;
                    } else {
                        $hasil = "Error! Tidak bisa membagi dengan 0";
                    }
                    $operator = "÷";
                    break;
                case "modulus":
                    $hasil = fmod($angka1, $angka2);
                    $operator = "%";
                    break;
                case "pangkat":
                    $hasil = pow($angka1, $angka2);
                    $operator = "^";
                    break;
            }

            echo "<div class='hasil'><strong>Hasil:</strong> $angka1 $operator $angka2 = $hasil</div>";

            $_SESSION["history"][] = "$angka1 $operator $angka2 = $hasil";
        }

        if (!empty($_SESSION["history"])) {
            echo "<div class='history'><h3>Riwayat Perhitungan:</h3><ul>";
            foreach (array_reverse($_SESSION["history"]) as $entry) {
                echo "<li>$entry</li>";
            }
            echo "</ul></div>";
        }
        ?>
    </div>
    <footer>
        <p>Made by <strong>Dio Dwi Prassetyo</strong></p>
    </footer>
</body>
</html>
