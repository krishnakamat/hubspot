<?php
session_start();
$_SESSION['user'] = $email;


if (isset($_SESSION['user'])) {
    echo "user logged in";
} else {
    echo "user not logged in";
}
echo $_SESSION['user'];

?>