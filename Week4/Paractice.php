<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-box {
            background: white;
            padding: 25px;
            border: 2px solid black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }

        .radio-group {
            margin-bottom: 15px;
        }

        .radio-group label {
            display: inline-block;
            font-weight: normal;
            margin-right: 15px;
        }

        .checkbox-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        input[type="reset"],
        input[type="submit"] {
            padding: 10px 15px;
            margin-right: 10px;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"] {
            color: black;
        }

        input[type="reset"] {
            color: black;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = htmlspecialchars($_POST["fullname"] ?? "");
            $password = htmlspecialchars($_POST["password"] ?? "");
            $textarea = htmlspecialchars($_POST["textarea"] ?? "");
            $role = isset($_POST["role"]) ? htmlspecialchars($_POST["role"]) : "You are not selected";
            $agree = isset($_POST["agree"]) ? "Checked" : "Not Checked";

            echo "Full Name: " . $fullname . "<br>";
            echo "Password: " . $password . "<br>";
            echo "textarea: " . $textarea . "<br>";
            echo "Role: " . $role . "<br>";
            echo "Terms: " . $agree . "<br>";
        }
        ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fullname">Enter Full Name:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter full name"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password"><br>

            <label for="textarea">textarea:</label>
            <textarea id="textarea" name="textarea" placeholder="Enter your textarea"></textarea>

            <label>Role:</label>
            <div class="radio-group">
                <label><input type="radio" name="role" value="Student"> Student</label>
                <label><input type="radio" name="role" value="Teacher"> Teacher</label>
            </div>

            <div class="checkbox-group">
                <label><input type="checkbox" name="agree" value="yes"> I agree to the terms</label>
            </div>

            <input type="reset" value="Reset">
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>