<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head>

<body style="text-align: center;">
    <h1>Registration form</h1>

    <?php
    //define("filepath", "user-info.json");

    require 'DbInsert.php';

    $useName = $password = $position = "";
    $userNameErr = $passwordErr = $positionErr  =  "";
    $successMessage = $errorMessage = "";
    $flag = false;
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $position = $_POST['position'];

        if (empty($userName)) {
            $userNameErr = "User name cannot be empty!";
            $flag = true;
        }
        if (empty($password)) {
            $passwordErr = "password cannot be empty!";
            $flag = true;
        }
        if (empty($position)) {
            $positionErr = "position cannot be empty!";
            $flag = true;
        }

        if (!$flag) {
            if (strlen($userName) > 10) {
                $userNameErr = "Username cannot be more than 10 characters!";
                $flag = true;
            }
            if (strlen($password) > 8) {
                $passwordErr = "password cannot be more than 8 characters!";
                $flag = true;
            }
            if (!$flag) {
                $userName = test_input($userName);
                $password = test_input($password);
                $position = test_input($position);

                // $data = array("username" => $userName, "password" => $password, "position" => $position);
                // $data_encode = json_encode($data);
                $result1 = register($userName,  $position, $password); //write($data_encode);
                if ($result1) {
                    $successMessage = "Signup Successfully.";
                } else {
                    $errorMessage = "Error while signing up!";
                }
            }
        }
    }

    // function write($content)
    // {
    //     $resource = fopen(filepath, "a");
    //     $fw = fwrite($resource, $content . "\n");
    //     fclose($resource);
    //     return $fw;
    // }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="userName">Username<span style="color : red;">* </span>:</label>
        <input type="text" id="userName" name="userName">
        <span style="color : red;"><?php echo $userNameErr; ?></span> <br> <br>

        <label for="position">Position<span style="color : red;">* </span>:</label>
        <select name="position" id="position">
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="receptionist">Receptionist</option>
            <option value="customer">Customer</option>
        </select>
        <span style="color : red;"><?php echo $positionErr; ?></span> <br><br>

        <label for="password">Password<span style="color : red;">* </span>:</label>
        <input type="password" id="password" name="password">

        <span style="color : red;"><?php echo $passwordErr; ?></span> <br> <br>

        <input class="register_button" type="submit" value="SIGN UP">
    </form>
    <span style="color : green"><?php echo $successMessage; ?> </span>
    <span style="color : red"><?php echo $errorMessage; ?> </span>
    <p>Already have an account? <a href="./loginform.php">login here!</a>
    </p>

</body>

</html>