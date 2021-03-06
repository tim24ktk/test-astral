<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/style.css?v=2">
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/ui-lightness/jquery-ui.css?v=5" />
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/ui.jqgrid.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        
		<title><?= $data['title'] ?></title>

        <script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="../assets/css/ui-lightness/jquery-ui.js" type="text/javascript"></script>
        <script src="../assets/js/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src="../assets/js/js/jquery.jqGrid.min.js" type="text/javascript"></script>
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
                    <a class="menu-list__link <?= ($_SERVER['REQUEST_URI'] == '/index.php/ThirdPage') || isset($data['users_diagnoses_id']) ? 'active' : '' ?>" href="<?= site_url('/ThirdPage')?>">Форма <?= !isset($data['users_diagnoses_id']) ? 'добаления' : 'редактирования' ?> случая</a>
                </li>
            </ul>
            </nav>
        </header>
        <main>
            <section class="container">
