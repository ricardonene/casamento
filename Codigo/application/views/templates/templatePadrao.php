<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title><?php echo $titulo; ?></title>

        <link rel="stylesheet" href="<?php echo base_url('application/css/jquery-ui-1.10.0.custom.css') ?>" />
        <link href="<?php echo base_url('application/css/principal.css') ?>" rel="stylesheet/less" media="screen" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="<?php echo base_url('application/js/jquery-ui-1.10.0.custom.js') ?>"></script>
        <script src="<?php echo base_url('application/js/less-1.3.3.min.js') ?>"></script>
        <script src="<?php echo base_url('application/js/jquery.maskMoney.js') ?>"></script>
        <script src="<?php echo base_url('application/js/jquery.maskedinput.js') ?>"></script>
        <script src="<?php echo base_url('application/js/accounting.js') ?>"></script>
        <script src="<?php echo base_url('application/js/jquery.validate.js') ?>"></script>
        <script src="<?php echo base_url('application/js/script.js') ?>"></script>       
    </head>
    <body>
        <div id="container">
            <div id="header">
                <a href="#">
                    <div id="logo"></div>
                </a>
                <div id="navigation">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Início</a></li>
                        <li><a href="<?php echo base_url('planejamento') ?>">Planejamento</a></li>
                        <li><a href="convidados">Convidados</a></li>
                        <li><a href="financeiro">Financeiro</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="logout">Sair</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div id="content">
                <?php echo $contents ?>
            </div>
            <div id="footer">
                Copyright © 2013
            </div>
        </div>
    </body>
</html>

