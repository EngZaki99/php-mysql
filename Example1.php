<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Fundamentals and Control Structures</title>
</head>
<body>
    <h1>PHP Fundamentals and Control Structures</h1>

    <?php
    // Constants and variables
    define("COURSE_NAME", "PHP Fundamentals");
    const PASSING_SCORE = 50;

    $studentName = "Omar";
    $score = 72;

    echo "<h2>Constants and Variables</h2>";
    echo "Course: " . COURSE_NAME . "<br>";
    echo "Passing score: " . PASSING_SCORE . "<br>";
    echo "Student: " . $studentName . "<br>";
    echo "Score: " . $score . "<br>";

    // If, elseif, and else
    echo "<h2>If, Elseif, and Else</h2>";
    if ($score >= 80) {
        echo "Grade: Excellent<br>";
    } elseif ($score >= PASSING_SCORE) {
        echo "Grade: Passed<br>";
    } else {
        echo "Grade: Failed<br>";
    }

    // Switch statement days
    $day = "Monday";

    echo "<h2>Switch Statement</h2>";
    switch ($day) {
        case "Monday":
            echo "Today is Monday.<br>";
            break;
        case "Tuesday":
            echo "Today is Tuesday.<br>";
            break;
        case "Wednesday":
            echo "Today is Wednesday.<br>";
            break;
        case "Thursday":
            echo "Today is Thursday.<br>";
            break;
        case "Friday":
            echo "Today is Friday.<br>";
            break;
        default:
            echo "It's the weekend!<br>";
    }
    // Ternary operator
    $loginStatus = true;
    $message = $loginStatus ? "The user is logged in." : "The user is logged out.";

    echo "<h2>Ternary Operator</h2>";
    echo $message . "<br>";

    // While loop
    echo "<h2>While Loop</h2>";
    $number = 1;

    while ($number <= 5) {
        echo "Number: " . $number . "<br>";
        $number++;
    }

    // Do-while loop
    echo "<h2>Do-While Loop</h2>";
    $count = 1;

    do {
        echo "Count: " . $count . "<br>";
        $count++;
    } while ($count <= 5);
    ?>
</body>
</html>