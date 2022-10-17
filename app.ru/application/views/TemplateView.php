<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous">
</head>
<body>
<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
        <a class="nav-link <?= ' active" style="color: #146c43' ?>" href="/NewsList">Список новостей</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ' active" style="color: #146c43' ?>" href="/AdminPage">Панель админа</a>
    </li>
</ul>

<div class="align-baseline" style="text-align: center">
    <?php include __DIR__ . '/../views/' . $content_view; ?>
</div>
</body>
</html>
