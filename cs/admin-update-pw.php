<?php
// Připojení k databázi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "damsmsdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zpracování formuláře
if (isset($_POST['updatePassword'])) {
    $newPassword = $_POST['newPassword'];
    $adminId = $_POST['adminId'];

    // Vytvoření hashu nového hesla
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Aktualizace hesla v databázi
    $sql = "UPDATE admin SET password = '$hashedPassword' WHERE admin_id = $adminId";

    if ($conn->query($sql) === TRUE) {
        echo "Heslo bylo úspěšně aktualizováno.";
    } else {
        echo "Chyba při aktualizaci hesla: " . $conn->error;
    }
}

// Získání údajů o adminovi
$adminId = 1; // ID admina, kterého chcete aktualizovat

$sql = "SELECT * FROM admin WHERE admin_id = $adminId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    echo "Admin nebyl nalezen.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aktualizace hesla admina</title>
</head>
<body>
    <h2>Aktualizace hesla admina</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="adminId" value="<?php echo $admin['admin_id']; ?>">
        <label for="newPassword">Nové heslo:</label>
        <input type="password" name="newPassword" required><br>
        <input type="submit" name="updatePassword" value="Aktualizovat heslo">
    </form>
</body>
</html>
