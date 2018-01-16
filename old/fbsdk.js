var user_id;

$(document).ready(function(){

	
	
	$('#getfrend1').click(function(){
		FB.api('/me', function(response) {
		  console.log(response);
		});
	});
	
	$('#getstat').click(function(){
		FB.getLoginStatus(function(response) {
			console.log(response);
			reponse=null;
			user_id=response.authResponse.userID;
		});
	});
	
	$('#post1').click(function(){
		FB.ui({
		  method: 'share',
		  mobile_iframe: true,
		  href: 'http://www.theforgenetwork.com',
		}, function(response){console.log(response)});
	});
		$('#post3').click(function(){
		FB.api(
			'/me/friends',
			'GET',
			{},
			function(response) {
				if(response.error && response.error.code==2500){
					console.log(response);
					relogin();
				}else{
					var earning = 0.02 * response.summary.total_count;
					$('#earning').text('uo could do'+earning);
				}
				
				
			}
		);
	});
	
	$('#post2').click(function(){
		FB.ui({
		  method: 'share',
		  mobile_iframe: true,
		  href: 'http://www.theforgenetwork.com',
		}, function(response){console.log(response)});

	});
	

	
});
function checkLoginState() {
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				window.location=SITEPATH+'dashboard.php';
			}
		});
}

function checkLoginState2() {
		FB.getLoginStatus(function(response) {
			if (response.status !== 'connected') {
				window.location=SITEPATH;
			}
		});
}

function checkEarning(){
		FB.api(
			'/me/friends',
			'GET',
			{},
			function(response) {
				if(response.error && response.error.code==2500){
					console.log(response);
					relogin();
				}else{
					var earning = 0.02 * response.summary.total_count;
					$('#earning').text(earning);
				}
				
				
			}
		);
}

function relogin(){
	FB.login(function(response) {
		if (response.status === 'connected') {
				checkEarning();
			}
	}, {scope: 'public_profile,email,user_friends,publish_actions'});
}