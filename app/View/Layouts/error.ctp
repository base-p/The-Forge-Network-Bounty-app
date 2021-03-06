<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='x-ua-compatible' content='ie=edge'>
        <title>ForgeNet Bounty Program</title>
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='icon' type='image/png' href='/img/favicon.png' />
        <?php echo $this->Html->css('normalize.css'); ?>
        <?php echo $this->Html->css('main.css'); ?>
        <?php echo $this->Html->css('layout.css'); ?>
        <?php echo $this->Html->css('components.css'); ?>
        <?php
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
	   ?>
    </head>
<body>
  
    <?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
</body>
</html>
