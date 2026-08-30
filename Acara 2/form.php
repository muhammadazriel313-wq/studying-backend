<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form GET dan POST</title>
</head>
<body>

    <h2>Form GET - Cari Mahasiswa</h2>

    <form action="proses.php" method="GET">
        <label>Cari Mahasiswa:</label>
        <input type="text" name="keyword">
        <button type="submit">Cari</button>
    </form>

    <hr>

    <h2>Form POST - Login</h2>

    <form action="login.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username">

        <br><br>

        <label>Password:</label>
        <input type="password" name="password">

        <br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>