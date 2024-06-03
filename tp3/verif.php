<?php

session_start();


if(isset($_POST['login']) && isset($_POST['psw'])) {
    
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['psw']);
    
    
    $valid_login = "utilisateur";
    $valid_password = "motdepasse";

    if($login === $valid_login && $password === $valid_password) {
        
        $_SESSION['login'] = $login;
        
        
        header("Location: home.php");
        exit();
    } else {

        $_SESSION['error'] = "Login incorrect";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
