<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>
<div id='fb-root'></div>
      <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=307005293152978';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>  
        <section class='l-row l-row--menu'>
            <div class='l-row__inner'>
                <a href='/' class='c-minimalLogo'>
                    <?php echo $this->Html->image('favicon.png',['class'=>'c-minimalLogo__avatar','width'=>'18','height'=>'18','alt'=>'']); ?>
                    <span class='c-minimalLogo__company'>ForgeNet</span>
                    <span class='c-minimalLogo__tagLine'>Bounty Program</span>
                </a>
            </div>
        </section>
        <section class='l-row l-row--noPadding l-row--fullwidth l-row--dashboard'>
            <div class='l-row__inner'>
                <div class='c-dashboardContent'>
                    <h1 class='c-sectionTitle'>Bounty Dashboard</h1>
                    <ul class='c-dashboardMenu'>
                        <li class='c-dashboardMenu--active'><a href='dashboard'>Post</a></li>
                        <li><a href='dashboardsettings'>Settings</a></li>
                        <li><a href='dashboardearnings'>Earnings</a></li>
                        <li><a href='logout'>Logout</a></li>
                    </ul>
                    <?php echo $this->Session->flash(); ?>
                    <h2>Instructions</h2>
                    <ol>
                        <li>You must follows us on Twitter and Join our Telegram Channel.</li>
                        <li>You must like our Facebook page.</li>
                        <li>Click one of the banners below to share post.</li>
                        <li>You earn FRG by clicking <code>Retrieve</code> button below after sharing. You have 5 minutes after share to click retrieve. Posts older than 5 mins will not be retrieved by our system</li>
                        <li>You can share the post once in 24 hours. Every share earns you more FRG.</li>
                        <li>All shares will be registered by us (see <a href='dashboardearnings'>earnings</a>) and paid out to your FRG wallet (see <a href='dashboardsettings'>settings</a>).</li>
                        <li>Make sure to personalize the text you share the post with. Make it interesting. Atleast 200 characters!</li>
                        <li>Sit back, and watch your earned FRG flow to your wallet.</li>
                    </ol>
                    <h2>Like our Facebook page</h2>
                    <div class='fb-like' data-href='https://www.facebook.com/ForgeNetCoin/' data-layout='standard' data-action='like' data-show-faces='true'></div>
                    <h2>Share post</h2>
                    <?php if($days > 0) {?>
                    <p>Earn <code id="estimate"><?= $fcount ?></code> by sharing one of the following posts to your Facebook timeline:</p>
                    <div class='c-facebookPosts'>
                        <div class='c-facebookPosts__post' linkdata="https://bounty.theforgenetwork.com/">
                            <p>Click here to share Post 1 to Facebook</p>
                            <?php echo $this->Html->image('share-image.jpg',['alt'=>'']); ?>
                            
                        </div>
                        <div class='c-facebookPosts__post' linkdata="https://shop.theforgenetwork.com/">
                            <p>Click here to share Post 2 to Facebook</p>
                            <?php echo $this->Html->image('share-image.jpg',['alt'=>'']); ?>
                            
                        </div>
                        <div class='c-facebookPosts__post' linkdata="https://theforgenetwork.com/">
                            <p>Click here to share Post 3 to Facebook</p>
                            <?php echo $this->Html->image('share-image.jpg',['alt'=>'']); ?>
                            
                        </div>
                    </div>
                    <h2>Retrieve post</h2>
                    <ul class='c-dashboardMenu'>
                       
                        <li><a href='retrieve'>Retrieve</a></li>
                        
                    </ul>
                    <?php }else{ ?>
                        <p>You have to wait <code>24 hours</code> before you can share again.</p>
                    <?php } ?>
                </div>
                <?php echo $this->Html->image('launch.png',['alt'=>'']); ?>
               
            </div>
        </section>
        <section class='l-row l-row--footer'>
            <div class='l-row__inner'>
                <div class='l-row--footer__first'>
                    <h2>ICO starting soon</h2>
                    <div class='c-countDown'>
                        <ul class='c-countDown__list'>
                            <li>
                                <span class='c-countDown__value c-countDown__days'></span>
                                <span class='c-countDown__label'>Days</span>
                            </li>
                            <li>
                                <span class='c-countDown__value c-countDown__hours'></span>
                                <span class='c-countDown__label'>Hours</span>
                            </li>
                            <li>
                                <span class='c-countDown__value c-countDown__minutes'></span>
                                <span class='c-countDown__label'>Minutes</span>
                            </li>
                            <li>
                                <span class='c-countDown__value c-countDown__seconds'></span>
                                <span class='c-countDown__label'>Seconds</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='l-row--footer__second'>
                    <div class='c-joinConversation'>
                        <p class='c-joinConversation__label'>Join the conversation:</p>
                        <ul class='c-joinConversation__list'>
                            <li>
                                <a class='c-socialMediaLink c-socialMediaLink--telegram c-socialMediaLink--white' href='https://t.me/ForgeNet' target='_blank' rel='noopener'>
                                    Telegram
                                </a>
                            </li>
                            <li>
                                <a class='c-socialMediaLink c-socialMediaLink--discord c-socialMediaLink--white' href='https://discord.gg/QGrvgKC' target='_blank' rel='noopener'>
                                    Discord
                                </a>
                            </li>
                            <li>
                                <a class='c-socialMediaLink c-socialMediaLink--facebook c-socialMediaLink--white' href='https://www.facebook.com/ForgeNetCoin/' target='_blank' rel='noopener'>
                                    Facebook
                                </a>
                            </li>
                            <li>
                                <a class='c-socialMediaLink c-socialMediaLink--twitter c-socialMediaLink--white' href='https://twitter.com/forgenetcoin' target='_blank' rel='noopener'>
                                    Twitter
                                </a>
                            </li>
                            <li>
                                <a class='c-socialMediaLink c-socialMediaLink--instagram c-socialMediaLink--white' href='https://www.instagram.com/theforgenetwork' target='_blank' rel='noopener'>
                                    Instagram
                                </a>
                            </li>
                            <li>
                                <a class='c-socialMediaLink c-socialMediaLink--reddit c-socialMediaLink--white' href='https://www.reddit.com/r/TheForgeNetwork/' target='_blank' rel='noopener'>
                                    Reddit
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='l-row--footer__third'>
                    <p>Copyright 2018 The Forge Network. All rights reserved.</p>
                </div>
            </div>
        </section>
     <?php echo $this->CachedHtml->script('jquery');?>
    <?php echo $this->CachedHtml->script('fbsdk');?>
    <?php echo $this->CachedHtml->script('countDown');?>

