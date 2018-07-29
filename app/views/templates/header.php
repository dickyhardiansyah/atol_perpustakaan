<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../app/public/css/materialize.min.css">
    <link rel="stylesheet" href="app/public/css/materialize.min.css">
</head>

<body style="height:100%;">
    <header>
        <nav class="blue darken-1">
            <div class="nav-wrapper container">
                <a href="<?php echo ROOT ?>" class="brand-logo">Perpustakaan</a>
                <ul class="right">
                    <?php foreach ($navMenu as $menu) { ?>
                    <li>
                        <a href="<?php echo $menu['link'] ?>" class="dropdown-trigger" data-target="<?php echo $menu['target'] ?>">
                    <?php echo $menu['title'] ?><?php if ($menu['title'] !== 'Logout') { ?>  <i class="material-icons right">arrow_drop_down</i> <?php } ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <?php foreach ($navSubMenu as $target) { ?>
            <ul id="<?php echo $target['id'] ?>" class="dropdown-content">
                <?php foreach ($target['menus'] as $menu) { ?>
                    <li>
                        <a href="<?php echo $menu['link'] ?>">
                            <?php echo $menu['title'] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </header>