<div id='fb-root'></div>
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
                    <h1 class='c-sectionTitle'>Admin Login</h1>
                    
                    <h2>Access Admin Area</h2>
                    
                     <?php echo $this->Form->create('User', array('class' => 'c-form')); ?>
                    <?php echo $this->Session->flash(); ?>
                                                
                        <p class='c-form__row'>
                            <label for='wallet' class='c-form__label'>Username</label>
                            <input id='wallet' type='text' class='c-form__field' name='data[User][username]'/>
                        </p>
                    <p class='c-form__row'>
                            <label for='walleto' class='c-form__label'>Password</label>
                            <input id='walleto' type='password' class='c-form__field' name='data[User][password]'/>
                        </p>
                        <p class='c-form__row'>
                            <button type='submit'>login</button>
                        </p>
                   <?php echo $this->Form->end(); ?>
                </div>
                <?php echo $this->Html->image('launch.png',['alt'=>'']); ?>
            </div>
        </section>
        <section class='l-row l-row--footer'>
            <div class='l-row__inner'>
                <div class='l-row--footer__first'>
                    <h2>Early bird sale starting soon</h2>
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
        <?php echo $this->Html->script('countDown.js');?>