<?php

declare(strict_types=1);
require 'C:\xampp\htdocs\currency-converter-bot\DB.php';

class Dashboard
{

    public function getAllExchanges(): false|array
    {
        $db = new DB();
        return $db->pdo->query("SELECT * FROM users_view")->fetchAll(PDO::FETCH_ASSOC);
    }
}

$dashboard = new Dashboard();
$data = $dashboard->getAllExchanges();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Currency converter Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Chat ID</th>
        <th scope="col">Conversion Type</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($data as $row) : ?>
        <tr>
            <td><?php
                echo $row['id'] . "\n"; ?></td>
            <td><?php
                echo $row['chat_id'] . "\n"; ?></td>
            <td><?php
                echo $row['conversion_type'] . "\n"; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
