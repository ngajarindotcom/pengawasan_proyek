<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><?= $title ?></h1>
        <p>Periode: <?= $filter['start_date'] ? date('d/m/Y', strtotime($filter['start_date'])) : 'Semua' ?> - <?= $filter['end_date'] ? date('d/m/Y', strtotime($filter['end_date'])) : 'Semua' ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pengawas</th>
                <th>Material 1</th>
                <th>Material 2</th>
                <th>Material 3</th>
                <th>Material 4</th>
                <th>Material 5</th>
                <th>Material 6</th>
                <th>Material 7</th>
                <th>Material 8</th>
                <th>Material 9</th>
                <th>Material 10</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($forms as $index => $form): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= date('d/m/Y', strtotime($form['created_at'])) ?></td>
                <td><?= $form['nama_lengkap'] ?></td>
                <td><?= $form['material_1'] ?? '-' ?></td>
                <td><?= $form['material_2'] ?? '-' ?></td>
                <td><?= $form['material_3'] ?? '-' ?></td>
                <td><?= $form['material_4'] ?? '-' ?></td>
                <td><?= $form['material_5'] ?? '-' ?></td>
                <td><?= $form['material_6'] ?? '-' ?></td>
                <td><?= $form['material_7'] ?? '-' ?></td>
                <td><?= $form['material_8'] ?? '-' ?></td>
                <td><?= $form['material_9'] ?? '-' ?></td>
                <td><?= $form['material_10'] ?? '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>
    </div>
</body>
</html>