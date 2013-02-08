<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title><?php echo $titulo; ?></title>
    </head>
    <body>

        <h1>
            <?php
            foreach ($texto as $t) {
                echo $t['Descricao'];
            }
            ?>
        </h1>
        
        <br />
        <?php echo form_open('login/validar'); ?>
        <?php echo form_label('E-Mail','email'); ?>
        <?php echo form_input('email',$email=''); ?>
        <br />
        <?php echo form_label('Senha','senha'); ?>
        <?php echo form_input('senha',$senha=''); ?>
        <br />
        <?php echo form_submit('login','Entrar'); ?>
        
        <?php echo form_close(); ?>
    </body>
</html>