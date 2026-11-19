
<?php

// Mengambil data dari form.php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: form.php");
    exit;
}

$nama = trim($_POST["nama"] ?? "");
$tanggal_lahir = $_POST["tanggal_lahir"] ?? "";
$hobi = $_POST["hobi"] ?? [];

if ($nama == "" || $tanggal_lahir == "") {
    die("Nama dan tanggal lahir wajib diisi.");
}

$tanggal = DateTime::createFromFormat("!Y-m-d", $tanggal_lahir);

if (!$tanggal || $tanggal->format("Y-m-d") !== $tanggal_lahir) {
    die("Tanggal lahir tidak valid.");
}
$bulan = [
    1 => "Januari",
    2 => "Februari",
    3 => "Maret",
    4 => "April",
    5 => "Mei",
    6 => "Juni",
    7 => "Juli",
    8 => "Agustus",
    9 => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember"
];

$tanggal_tampil =
    $tanggal->format("j") . " " .
    $bulan[(int)$tanggal->format("n")] . " " .
    $tanggal->format("Y");
$pilihan_hobi = ["Membaca", "Olahraga", "Musik", "Lainnya"];

if (!is_array($hobi)) {
    $hobi = [];
}

$hobi = array_values(array_intersect($pilihan_hobi, $hobi));

if (count($hobi) > 0) {
    $hobi_tampil = implode(", ", $hobi);
} else {
    $hobi_tampil = "Tidak ada hobi yang dipilih.";
}

$nama = htmlspecialchars($nama, ENT_QUOTES, "UTF-8");
$tanggal_tampil = htmlspecialchars($tanggal_tampil, ENT_QUOTES, "UTF-8");
$hobi_tampil = htmlspecialchars($hobi_tampil, ENT_QUOTES, "UTF-8");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Data Diri</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        h1 {
            font-size: 26px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .data {
            display: grid;
            grid-template-columns: 140px 1fr;
            margin: 22px 0;
            line-height: 1.5;
        }

        .data strong {
            font-size: 17px;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            color: #087bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .data {
                grid-template-columns: 1fr;
                gap: 5px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Tampilan Data Anda</h1>

        <div class="data">
            <strong>Nama Lengkap:</strong>
            <span><?php echo $nama; ?></span>
        </div>

        <div class="data">
            <strong>Tanggal Lahir:</strong>
            <span><?php echo $tanggal_tampil; ?></span>
        </div>

        <div class="data">
            <strong>Hobi:</strong>
            <span><?php echo $hobi_tampil; ?></span>
        </div>

        <a href="form.html">&laquo; Kembali ke Form</a>

    </div>

</body>
</html>
