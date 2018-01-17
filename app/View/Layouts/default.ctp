<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='x-ua-compatible' content='ie=edge'>
        <title>ForgeNet Bounty Program</title>
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='icon' type='image/png' href='/img/favicon.png' />
        <?php echo $this->CachedHtml->css('normalize'); ?>
        <?php echo $this->CachedHtml->css('main'); ?>
        <?php echo $this->CachedHtml->css('layout'); ?>
        <?php echo $this->CachedHtml->css('components'); ?>
        <?php
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
	   ?>
    </head>
<body>
  
    
	<?php echo $this->fetch('content'); ?>
</body>
</html>
