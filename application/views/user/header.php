<!doctype html>
<html lang="en">
    <head>
        <title>XConsile</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Oxygen:400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/admin-style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container-fluid OverHidden">
            <div class="row d-flex d-md-block flex-nowrap wrapper">
                <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">
                    <div class="Logo text-center p-2">
                        <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Logo" class="d-none d-md-inline-block" />
                    </div>
                    <div class="MainNav text-uppercase text-center p-2 d-none d-md-block">
                        Welcome! <?php echo $this->session->userdata('username'); ?>
                    </div>
                    <div class="list-group border-0 card text-center text-md-left">
                        <a href="<?php echo base_url('user'); ?>" class="list-group-item d-inline-block <?php if($this->uri->segment(2) !== 'receipts'){ echo 'active'; } ?> collapsed" data-parent="#sidebar"><i class="fa fa-dashboard fa-2x"></i> <span class="d-none d-lg-inline">Dashboard</span> </a>
                        <a href="<?php echo base_url('user/receipts'); ?>" class="list-group-item d-inline-block <?php if($this->uri->segment(2) === 'receipts'){ echo 'active'; } ?> collapsed" data-parent="#sidebar"><i class="fa fa-table fa-2x"></i> <span class="d-none d-lg-inline">Receipts</span></a>
                    </div>
                </div>
                <main class="col-md-10 float-left col px-5 pl-md-4 main">
                    <div class="page-header py-3 mb-lg-5 mb-4">
                        <div class="row">
                            <div class="col-md-4 col-sm-5 mb-2 mb-sm-0 ml-auto">
                            </div>
                            <div class="col-auto align-self-center pl-sm-0 ml-sm-0 ml-auto">
                                <a href="<?php echo base_url('user/logout'); ?>" class="logout">Logout</a>
                            </div>
                        </div>
                    </div>