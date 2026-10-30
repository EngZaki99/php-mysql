<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    for ($row = 1; $row <= 3; $row++) {
        for ($column = 1; $column <= 4; $column++) {
            $result = $row * $column;
            echo "Row is $row, column is $column, result is $result<br>";
        }
    }
    ?>
</body>
</html>