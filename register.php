<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $latexCode = $_POST['latexCode'];

    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $latexCode);

    if ($stmt->execute()) {
        header("Location: view_messages.php");
    } else {
        echo "Erreur: " . $stmt->error;
    }
    $conn->close();
}
?>
