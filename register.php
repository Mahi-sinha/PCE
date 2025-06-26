<?php
session_start();  // Always start session before output
include 'connect.php';

if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        // Using session message instead of echo
        $_SESSION['error'] = "Email already exists!";
        header("Location: index.html");  // This will now work
        exit();
    } else {
        $insertQuery = "INSERT INTO users(firstName,lastName,email,password)
                        VALUES ('$firstName','$lastName','$email','$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: assignment.html");
            exit();
        } else {
            // Log error internally or pass via session
            $_SESSION['error'] = "Database error: " . $conn->error;
            header("Location: error.html");
            exit();
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: assignment.html");
        exit();
    } else {
        $_SESSION['error'] = "Incorrect email or password.";
        header("Location: error.html");
        exit();
    }
}
?>
