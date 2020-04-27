<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->e($title)?> | <?=$this->e($company)?></title>
    <link rel="shortcut icon" sizes="16x16" href="https://ssl.gstatic.com/docs/spreadsheets/forms/favicon_qp2.png">
    <link href='/survey/admin/css/style.css' rel='stylesheet' />
</head>
<body>
    <header class="main-header themeStripe">
        <nav class="main-header__nav">
            <ul class="main-header__item-list">
                <!-- <li class="main-header__item"><button id="btnLogOut" type="button" onclick="loginout()"></button></li> -->
            </ul>
        </nav>
    </header>

    <?=$this->section('content')?>
    <?=$this->section('scripts')?>
</body>
</html>