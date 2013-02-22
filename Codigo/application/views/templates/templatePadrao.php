<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title><?php echo $titulo; ?></title>

        <link href="<?php echo base_url('application/css/bootstrap.css') ?>" rel="stylesheet" />
<!--        <link href="<?php echo base_url('application/css/bootstrap-responsive.css') ?>" rel="stylesheet" />-->
        <link href="<?php echo base_url('application/css/jquery-ui-1.10.0.custom.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('application/css/principal.css') ?>" rel="stylesheet/less" media="screen" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="<?php echo base_url('application/js/jquery-ui-1.10.0.custom.js') ?>"></script>
        <script src="<?php echo base_url('application/js/less-1.3.3.min.js') ?>"></script>
        <script src="<?php echo base_url('application/js/jquery.maskMoney.js') ?>"></script>
        <script src="<?php echo base_url('application/js/jquery.maskedinput.js') ?>"></script>
        <script src="<?php echo base_url('application/js/accounting.js') ?>"></script>
        <script src="<?php echo base_url('application/js/jquery.validate.js') ?>"></script>
        <script src="<?php echo base_url('application/js/script.js') ?>"></script>       
        <script src="<?php echo base_url('application/js/bootstrap.js') ?>"></script>       
    </head>
    <body>
        <div id="container" class="container-fluid">
            <div id="header" class="row-fluid" style="border: solid 1px red;">
                <div id="logo" class="span2">
                    <a href="#"> <img src="http://thumbs.dreamstime.com/thumbimg_606/1305656289XldIoX.jpg"/> </a>
                </div>
                <div id="navigation" class="span8">
                        <ul class="nav nav-pills">
                            <li><a href="<?php echo base_url() ?>">Início</a></li>
                            <li class="active"><a href="<?php echo base_url('planejamento') ?>">Planejamento</a></li>
                            <li><a href="convidados">Convidados</a></li>
                            <li><a href="financeiro">Financeiro</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contato</a></li>
                            <li><a href="logout">Sair</a></li>
                        </ul>
                </div>
            </div>
            <div id="content" class="row-fluid" style="border: solid 1px green;">
                <?php echo $contents ?>
            </div>
            <div id="footer" class="row-fluid" style="background-color: gray;">
                <p class="text-center"> Copyright © 2013 </p>
            </div>
        </div>
    </body>
</html>

