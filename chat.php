<?php
session_start();
if (!isset($_GET['username'])) {
    header("Location: register.php");
    exit();
}
$username = $_GET['username'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script type="text/javascript" src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script type="text/javascript" id="MathJax-script" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <style>
        /* Ajoutez votre CSS ici */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 20px;
            font-family: "Courier New", Courier, monospace;
            font-size: 16px;
            padding: 10px;
            white-space: pre-wrap;
        }
        .preview {
            border: 1px solid #ddd;
            padding: 20px;
            min-height: 100px;
            background-color: #f9f9f9;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <h2>Soumettre un message</h2>
    <form id="latexForm" action="submit_message.php" method="POST">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <textarea id="latexInput" name="latexCode" placeholder="Écrivez votre code LaTeX ici avec un seul $ pour les maths inline..." wrap="soft"></textarea>
        <h3>Prévisualisation :</h3>
        <div id="preview" class="preview"></div>
        <button type="submit">Envoyer</button>
    </form>

    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$']],
                displayMath: [['$$', '$$']]
            }
        };

        function updatePreview() {
            var input = document.getElementById("latexInput").value;
            var previewDiv = document.getElementById("preview");
            previewDiv.innerHTML = input;
            MathJax.typesetPromise([previewDiv]);
        }

        document.getElementById("latexInput").addEventListener("input", updatePreview);
        updatePreview();
    </script>
</body>
</html>
