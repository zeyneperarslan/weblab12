<!DOCTYPE html>
<html>
<head>
    <title>Kısaltılmış URL</title>
</head>
<body>
    <h1>Kısaltılmış URL</h1>
    <p>Orijinal URL: <?= htmlentities($_POST['long_url']) ?></p>
    <p>Kısaltılmış URL: <a href="<?= $shortUrl ?>"><?= $shortUrl ?></a></p>
    <a href="/">Başka bir URL kısalt</a>
</body>
</html>
