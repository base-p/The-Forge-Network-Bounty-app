
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
			  version    : 'v2.10'
			});
			  
			FB.AppEvents.logPageView();
			checkLoginState2();		
			checkEarning();
			  
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
		<div class="sub-content">You could earn <span id="earning">...</span> FRG by sharing one of the Posts below to your Time line</div>
		<div class="header">INSTRUCTIONS</div>
		<div class="sub-content1">
			<ol>
				<li>Like our page on facebook, by clicking:
					<div class="fb-like" data-href="https://www.facebook.com/ForgeNetCoin/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
				</li>
				<li>Share one of our posts below to your timeline.  
					<p class="note">*note: you can share each post separately to earn more , but  must allow atleast 48hours between each post and you can only share each post once.</p>
				</li>
				<li>You will notice your earned forge appear below.</li>
				<li>By the 22nd of January, 2018 go to <a href="http://theforgenetwork.com">The Forge Network Website</a> and download our wallet application</li>
				<li>Create a wallet address using the downloaded application</li>
				<li>Return here, sign-in with the same Facebook account and supply your wallet address</li>
				<li>Sitback and watch your earned forge credited to your wallet address</li>
			</ol>
		</div>
		<div class="sub-content inline posts" id="post1">
			<div class="header2">Post 1</div>
			<div class="inline">
				<img id="image1" class="shareimg" src="image1.jpg">
			</div>
		</div>
		<div class="sub-content inline  posts" id="post2">
			<div class="header2">Post 2</div>
			<div class="inline">
				<img id="image1" class="shareimg" src="image1.jpg">
			</div>
		</div>
	</div>
	<button id="post3">try</button>

	</div>
	<script src="jquery.js"></script>
	<script src="fbsdk.js"></script>
</body>
</html>


