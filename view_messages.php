<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

$messages = $conn->query("SELECT * FROM messages ORDER BY timestamp DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <script type="text/javascript" src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script type="text/javascript" id="MathJax-script" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <style>
        /* Ajoutez votre CSS ici */
    </style>
</head>
<body>
    <h2>Messages</h2>
    <?php while($row = $messages->fetch_assoc()): ?>
        <div class="message">
            <h3><?php echo htmlspecialchars($row['username']); ?></h3>
            <div class="preview">
                <?php echo htmlspecialchars($row['message']); ?>
            </div>
            <form action="reply_message.php" method="POST">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">
                <textarea name="replyMessage" placeholder="Répondez ici..."></textarea>
                <button type="submit">Répondre</button>
            </form>
        </div>
    <?php endwhile; ?>
</body>
</html>
