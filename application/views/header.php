<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <base href="<?php echo base_url() ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Awwwards</title>
    <link rel="apple-touch-icon" href="<?php echo base_url('app-assets');?>/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('app-assets');?>/images/ico/favicon.ico">
    <link href="<?php echo base_url('app-assets');?>/fonts/google-fonts/google-api-fonts.css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/file-uploaders/dropzone.min.css">
    <?php if($page_code == 'dashboard') { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/extensions/dragula.min.css">
    <?php } ?>
    <?php if(strpos($page_code, 'add') !== false || strpos($page_code, 'settings') !== false) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/ui/prism.min.css">
    <?php } ?>
    <?php if(strpos($page_code, 'list') !== false) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/tables/datatable/datatables.min.css">
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/extensions/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/core/menu/menu-types/vertical-menu.css">

    <?php if($page_code == 'dashboard') { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/pages/dashboard-analytics.css">
    <?php } ?>

    <?php if(strpos($page_code, 'add') !== false || strpos($page_code, 'settings') !== false) { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/plugins/file-uploaders/dropzone.css">
    <?php } ?>

    <?php if(strpos($page_code, 'list') !== false) { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/pages/app-invoice.css">
    <?php } ?>

    <?php if($page_code == 'settings') { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/forms/select/select2.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/vendors/css/pickers/pickadate/pickadate.css">
    <?php } ?>
    <?php if($page_code == 'wayback') { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/plugins/file-uploaders/dropzone.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets');?>/css/pages/app-email.css">
    <?php } ?>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets');?>/css/style.css">    
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns email-application  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-dark">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore Frest..." tabindex="-1" data-search="template-list">
                                <div class="search-input-close"><i class="bx bx-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url() ?>">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">awwwards</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class="<?php if($page_code=='dashboard') echo 'active'?> nav-item"><a href="<?php echo base_url('dashboard') ?>"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>       
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="box-add"></i><span class="menu-title" data-i18n="Awwwards Export Data">Awwwards Export</span></a>
                    <ul class="menu-content">
                        <li class="<?php if($page_code=='export_list') echo 'active'?>"><a href="<?php echo site_url('export/list')?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Projects</span></a>
                        </li>                        
                        <li class="<?php if($page_code=='export_add') echo 'active'?>"><a href="<?php echo site_url('export/add')?>"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">Add Project</span></a>
                        </li>
                    </ul>
                </li>                 
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->