$(document).ready(function(){
	$('.c-facebookPosts__post').click(function(){
        var linkd=$(this).attr('linkdata');
        checkEarning2(linkd);		
	});
});


function checkEarning2(linkdata){
    FB.ui({
		  method: 'feed',
		  mobile_iframe: true,
		  link: linkdata
        }, 
        function(response){
        
    });
}



