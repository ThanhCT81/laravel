<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $arrayAnimals = ['Cho', 'Meo', 'Ca', 'Gau', 'Cuu'];
    foreach ($arrayAnimals as $key => $animal) {
        $color = 'green';
        if (($key + 1) % 2 === 0) {
            $color = 'red';
        }
        echo ($key + 1) . ".<span style='color:  $color ' " . ">$animal</span><br>";
    }
    ?>
    <h1>TEST</h1>
</body>

</html>