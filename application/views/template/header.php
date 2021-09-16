<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href=" <?= base_url(); ?>assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="<?= base_url(); ?>assets/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="<?= base_url(); ?>assets/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- QUERY MENU -->
                    <?php
                    $id_role = $this->session->userdata('id_role');
                    $queryMenu = "SELECT `menu`.`id_menu`, `menu`
                                        FROM `menu` JOIN `access_menu` ON `menu`.`id_menu` = `access_menu`.`id_menu`
                                    WHERE `access_menu`.`id_role` = $id_role
                                    ORDER BY `access_menu`.`id_menu` ASC";
                    $menu = $this->db->query($queryMenu)->result_array();

                    ?>
                    <!-- LOOPING MENU -->
                    <?php foreach ($menu as $m) : ?>
                        <h3 class="menu-title"><?= $m['menu']; ?></h3><!-- /.menu-title -->
                        <!-- SUB-MENU -->
                        <?php
                        $menuId = $m['id_menu'];
                        $querySubMenu = "SELECT *
                                            FROM `sub_menu` 
                                            JOIN `menu` ON `sub_menu`.`id_menu` = `menu`.`id_menu`
                                            WHERE `sub_menu`.`id_menu` = $menuId
                                            AND `sub_menu`.`is_active` = 1";
                        $subMenu = $this->db->query($querySubMenu)->result_array();

                        ?>

                        <?php foreach ($subMenu as $sm) : ?>
                            <?php if ($title == $sm['title']) : ?>
                                <li class="active">
                                <?php else : ?>
                                <li>
                                <?php endif; ?>
                                <a href="<?= base_url($sm['url']); ?>"> <i class="<?= $sm['icon']; ?>"></i><?= $sm['title']; ?></a>
                                </li>
                            <?php endforeach; ?>


                        <?php endforeach; ?>




                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->