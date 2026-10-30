<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Numeric Array
    $names = array();

    $names [0] = "CA233";
    $names [1] = 123;

    var_dump($names);


    $info = array(
       "203",
       "Zakariye",
       20,
       "Hodan District",
       "Single"
    );
    for($i = 0; $i < count($info); $i++) {
        echo $info[$i] . "<br>";
    }

    //Associative Array
    $student = array(
        "ID" => "203",
        "Name" => "Zakariye",
        "Age" => 20,
        "Address" => "Hodan District",
        "Status" => "Single"
    );

    echo "<pre>";
    Echo "Information about the person<br>";
    print_r($student);
    var_dump($student);
    echo "</pre>";

    ?>


</body>
</html>