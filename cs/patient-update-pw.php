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
    $patientId = $_POST['patientId'];

    // Vytvoření hashu nového hesla
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Aktualizace hesla v databázi
    $sql = "UPDATE patient SET password = '$hashedPassword' WHERE patient_id = $patientId";

    if ($conn->query($sql) === TRUE) {
        echo "Heslo bylo úspěšně aktualizováno.";
    } else {
        echo "Chyba při aktualizaci hesla: " . $conn->error;
    }
}

// Získání údajů o pacientovi
$patientId = 35; // ID pacienta, kterého chcete aktualizovat

$sql = "SELECT * FROM patient WHERE patient_id = $patientId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
} else {
    echo "Pacient nebyl nalezen.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aktualizace hesla pacienta</title>
</head>
<body>
    <h2>Aktualizace hesla pacienta</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="patientId" value="<?php echo $patient['patient_id']; ?>">
        <label for="newPassword">Nové heslo:</label>
        <input type="password" name="newPassword" required><br>
        <input type="submit" name="updatePassword" value="Aktualizovat heslo">
    </form>
</body>
</html>
