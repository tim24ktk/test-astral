<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/ui-lightness/jquery-ui.css?v=2" />
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/ui.jqgrid.css" />
		<title><?= $data['title'] ?></title>

        <script src="../assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="../assets/css/ui-lightness/jquery-ui.js" type="text/javascript"></script>
        <script src="../assets/src/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src="../assets/js/jquery.jqGrid.src.js" type="text/javascript"></script>
        <script src="../assets/src/grid.loader.js" type="text/javascript"></script>
    </head>
	<body>
        <header>
            <h1 class="main-heading">Тестовое от Группы Компаний Астрал</h1>
            <nav class="main-menu">
            <ul class="menu-list">
                <li class="menu-list__item">
                    <a class="menu-list__link <?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>" href="/">Список пациентов</a>
                </li>
                <li class="menu-list__item">
                    <a class="menu-list__link <?= $_SERVER['REQUEST_URI'] == '/index.php/SecondPage' ? 'active' : '' ?>" href="<?= site_url('/SecondPage')?>">Список случаев</a>
                </li>
                <li class="menu-list__item">
                    <a class="menu-list__link" href="<?= site_url('/ThirdPage')?>">Просмотр</a>
                </li>
            </ul>
            </nav>
        </header>
        <main>
