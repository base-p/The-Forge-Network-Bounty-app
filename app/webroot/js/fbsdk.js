var user_id;
var user_name;
var email;

$(document).ready(function(){

	

	$('.c-facebookPosts__post').click(function(){
        checkLoginState3();
    
		
	});
		$('#estimate').click(function(){
            checkEarning();
		
	});
	

	

	
});
function checkLoginState() {
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {              
                FB.api('/me', {fields: 'id,name,email'}, function(response) {
                      user_id=response.id;
                      user_name=response.name;
                      email=response.email;
                    
		              console.log(response);
                        $.ajax({
                            url: SITEPATH + "users/login/",
                            data:{
                                user_name: user_name,
                                user_id: user_id,
                                email: email,
                            },
                            type: "POST",
                            beforeSend: function() {
                                //$('#modalLoader').css('display', 'block');
                            },
                            complete: function() {
                                //$('#modalLoader').css('display', 'none');
                            },
                            success: function(result) {
                                console.log(result);
                                var addresp = JSON.parse(result);
                                if(addresp){
                                    window.location= SITEPATH+'users/dashboard';
                                }
                            }
                        });
		          });
				
			}
		});
}

function checkLoginState2() {
		FB.getLoginStatus(function(response) {
			if (response.status !== 'connected') {
                 $.ajax({
                    url: SITEPATH + "users/logout/",
                    type: "POST"
                });

				window.location = SITEPATH;
				return;
			}

			checkEarning();
		});
}

function checkEarning(){
		FB.api(
			'/me/friends',
			'GET',
			{},
			function(response) {
			    console.log(response);
                var earning = 0.02 * response.summary.total_count;
                if (earning > 100 ){earning=100.00;};
                earning=earning.toFixed(2);
                $('#estimate').text(earning+' FRG');
                localStorage.setItem('tfn694e70190a79', earning);
			}
		);
    FB.api(
    "/me/feed",
        'GET',
			{fields: 'created_time,link',limit: '5'},
    function (response) {
        console.log(response);
      if (response && !response.error) {
        /* handle the result */
      }
    }
);
}

function checkLoginState3() {
		FB.getLoginStatus(function(response) {
			if (response.status !== 'connected') {
                 $.ajax({
                    url: SITEPATH + "users/logout/",
                    type: "POST"
                });

				window.location = SITEPATH;
				return;
			}

			checkEarning2();
		});
}

function checkEarning2(){
		
		FB.api(
			'/me/friends',
			'GET',
			{},
			function(response) {
					var earning = 0.02 * response.summary.total_count;
                    if (earning > 100 ){earning=100.00;};
                    earning=earning.toFixed(2);
                    $('#estimate').text(earning+' FRG');
                    localStorage.setItem('tfn694e70190a79', earning); 
                    FB.ui({
		  method: 'share',
		  mobile_iframe: true,
		  href: 'https://theforgenetwork.com/'
		}, function(response){
            console.log(response);
            var post_id = response.post_id;
            console.log(post_id);
            if(localStorage.tfn694e70190a79 && post_id){
               var earned  = localStorage.tfn694e70190a79;
                $.ajax({
                            url: SITEPATH + "users/earning/",
                            data:{
                                postid: post_id,
                                earned: earned,
                            },
                            type: "POST",
                            beforeSend: function() {
                                //$('#modalLoader').css('display', 'block');
                            },
                            complete: function() {
                                //$('#modalLoader').css('display', 'none');
                            },
                            success: function(result) {
                                console.log(result);
                                var addresp = JSON.parse(result);
                                if(addresp==true){
                                  location.reload(true);  
                                }
                            }
                        });
               } 
        });
                
			}
		);
	
}

function relogin(){
	FB.login(function(response) {
		
	}, {scope: 'public_profile,email,user_friends,publish_actions'});
}

