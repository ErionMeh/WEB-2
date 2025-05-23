<!DOCTYPE html>
<html>
<head>
    <title>Kontakt</title>
</head>
<body>
    <h2>Na Kontakto</h2>
    <form action="send-email.php" method="post">
        <label>Emri:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mesazhi:</label><br>
        <textarea name="message" required></textarea><br><br>

        <button type="submit">Dergo</button>
    </form>
</body>
</html>
