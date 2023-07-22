<?php

require_once('../includes/database.php');

require_once('../../models/registerUserModel.php'); //

session_start();


if (isset($_POST['login'])) {
    $errors = array();

    if (!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1) {
        $errors[] = 'Email is Missing / Invalid';
    }
    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors[] = 'Password is Missing / Invalid';
    }

    if (empty($errors)) {
        $useremail = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        // Načtení uživatele z databáze podle emailu
        $result = registerUserModel::getUserByEmail($useremail, $connection);

        if ($result && mysqli_num_rows($result) == 1) {
            $record = mysqli_fetch_assoc($result);

            // Porovnání zadaného hesla s hashem v databázi
            if (password_verify($password, $record['password'])) {
                $_SESSION['email'] = $record['email'];
                $_SESSION['type'] = $record['type'];
                $_SESSION['first_name'] = $record['first_name'];
                $_SESSION['last_name'] = $record['last_name'];
                $_SESSION['phone_number'] = $record['phone_number'];
                $_SESSION['address'] = $record['address'];

                $ID = registerUserModel::getId($record['type'], $record['email'], $connection);
                $user_id = mysqli_fetch_assoc($ID);

                if ($record['type'] == "patient") {
                    $_SESSION['patient_id'] = $user_id['patient_id'];
                    header('Location:../views/patient-dashboard.php');
                    exit;
                } elseif ($record['type'] == "doctor") {
                    $_SESSION['doctor_id'] = $user_id['doctor_id'];
                    header('Location:../views/dashboard.php');
                    exit;
                } elseif ($record['type'] == "admin") {
                    $_SESSION['admin_id'] = $user_id['admin_id'];
                    header('Location:../views/admin-dashboard.php');
                    exit;
                }
            } else {
                $errors[] = 'Invalid password';
            }
        } else {
            $errors[] = 'User not found';
        }
    }

    // Pokud nastaly chyby, přesměruj zpět na stránku s přihlášením s chybovou zprávou
    header('Location:../views/login.php?errors=' . urlencode(implode('|', $errors)));
    exit;
}
?>