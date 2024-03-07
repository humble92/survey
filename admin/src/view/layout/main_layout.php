<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->e($title)?></title>
    <link href='/survey/admin/css/style.css' rel='stylesheet' />
    <script src="/survey/admin/js/script.js" defer></script>
</head>
<body>
    <header class="main-header">
        <nav class="main-header__nav">
            <ul class="main-header__item-list">
                <li class="main-header__item"><button id="btnLogOut" type="button" onclick="loginout()">{{logInOut}}</button></li>
            </ul>
        </nav>
    </header>

    <?=$this->section('content')?>
</body>
</html>