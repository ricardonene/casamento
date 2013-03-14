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

        <script src="<?php echo base_url('application/js/jquery-1.9.1.min.js') ?>"></script>
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
        <div id="container">
            <div id="header">
                <div id="logo">
                    <a href="#"> <!--img src="http://www.halfdiscount.com/resizedMerImage/1251883038.gif"/--> </a>
                </div>                
            </div>

            <div id="maincontent">
                <div id="navigation">
                    <ul class="menu">
                        <li>
                            <a href="<?php echo base_url() ?>">
                                <i class="icone-inicial"></i> <br />
                                Início
                            </a>

                        </li>
                        <li class="active">
                            <a href="<?php echo base_url('planejamento') ?>">

                                <i class="icone-planejamento"></i> <br />
                                Planejamento
                            </a>
                        </li>
                        <li>
                            <a href="#">

                                <i class="icone-convidados"></i> <br />
                                Convidados
                            </a>
                        </li>
                        <li>
                            <a href="#">

                                <i class="icone-financeiro"></i> <br />
                                Financeiro
                            </a>

                        </li>
                        <li>
                            <a href="#">

                                <i class="icone-blog"></i> <br />
                                Blog
                            </a>

                        </li>
                        <li>
                            <a href="#">
                                <i class="icone-contato"></i> <br />
                                Contato

                            </a>
                        </li>
                    </ul>
                </div>
                <div id="contents">
                    <?php echo $contents ?>
                </div>
            </div>
        </div>
    </body>
</html>

