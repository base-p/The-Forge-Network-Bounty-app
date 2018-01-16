
<!DOCTYPE html>
<html>
<head>
	<title>
		The Forgenetwork Bounty App
	</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 
	<link href="main.css" rel="stylesheet">
	<script>var SITEPATH = 'http://pistudy.org/tfnbounty/'</script>
</head>
<body>
	<script>
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '307005293152978',
			  cookie     : true,
			  xfbml      : true,
			  version    : 'v2.11'
			});
			  
			FB.AppEvents.logPageView();
			checkLoginState();		
			  
		  };

		  (function(d, s, id){
			 var js, fjs = d.getElementsByTagName(s)[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement(s); js.id = id;
			 js.src = "https://connect.facebook.net/en_US/sdk.js";
			 fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
	</script>
	<div class="container">
	<div class="header">Welcome to the Forge Network bounty App</div>
	<div class="content">
		<div class="sub-content">To continue you need to login with your social media account, and give this app permission to Access your public profile, friend list and also post to your Account on your behalf</div>
		<div class="fb-login-button" onlogin="checkLoginState();" scope="public_profile,email,user_friends,publish_actions" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="true" data-auto-logout-link="false" data-use-continue-as="true"></div>
	</div>

	</div>
	<script src="jquery.js"></script>
	<script src="fbsdk.js"></script>
</body>
</html>


