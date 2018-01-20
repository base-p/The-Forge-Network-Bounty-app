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
            FB.api(
            "/me/feed",
                'GET',
                    {fields: 'created_time,link,message',limit: '5'},
            function (response) {
                //console.log(response);
                if (response && !response.error) {
                    var user_posts = response.data;
                    for (i = 0; i < user_posts.length; i++){
                        if(user_posts[i].link=="https://theforgenetwork.com/"){
                            console.log(user_posts[i]);
                            var dcheck = Date.parse(new Date())-Date.parse(user_posts[i].created_time);
                            var minutes = Math.floor(dcheck / 1000 / 60)
                            if(minutes<5){
                                var ctime = user_posts[i].created_time;
                                if(user_posts[i].message){
                                var pmessage = user_posts[i].message;}else{var pmessage = 'N/A';}
                                var upid = user_posts[i].id;
                                if(localStorage.tfn694e70190a79 && post_id){
                                    var earned  = localStorage.tfn694e70190a79;
                                    $.ajax({
                                        url: SITEPATH + "users/earning/",
                                        data:{
                                            earned: earned,
                                            ctime: ctime,
                                            pmessage: pmessage,
                                            upid: upid
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
                                
                                break;
                            }
                            console.log(minutes);
                        };
                    }
                }
            }
        );            
             
        });
                
			}
		);
	
}

function relogin(){
	FB.login(function(response) {
		
	}, {scope: 'public_profile,email,user_friends,user_posts'});
}

