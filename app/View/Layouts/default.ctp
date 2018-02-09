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
        <meta property="og:title" content="Earn free Cryptocurrency in ForgeNet's Bounty Campaign" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://bounty.theforgenetwork.com/" />
        <meta property="og:image" content="https://bounty.theforgenetwork.com/img/ogimage.jpg" />
        <meta property="og:description" content="Click here to participate in The Forge Network's Bounty campaign and receive free FRG coins." /> 
    </head>
<body>
  
    
	<?php echo $this->fetch('content'); ?>
</body>
</html>
