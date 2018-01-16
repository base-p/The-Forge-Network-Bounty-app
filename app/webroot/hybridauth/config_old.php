<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------
return 
	array(
		"base_url" => "http://mobileappdaily.com/pinmeme/libs/3rdparty/hybridauth/", 

		"providers" => array ( 
			"OpenID" => array (
				"enabled" => true
			),

			"Yahoo" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array ( 
				"enabled" => true 
			),
			
			"Facebook" => array ( 
			"enabled" => true,
			"keys"    => array ( "id" => "110587262402285", "secret" => "5d806db2f1c30fc08ddc62e2b57360f9" ), 
		     ),

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "735844539534-1jq49fglivahg9k1e2t6hb2mnnaj2682.apps.googleusercontent.com", "secret" => "S_jXZtO4Dm7xt47hsIEkMHlP" ), 
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "YYjLJlp7Ex2rpea0ftsg", "secret" => "9iGOQIjTnu556gzI5iwb2HJZ86tDyDsWszhMCUxHPVk" ) 
			),
			
			"Instagram" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "9a015e65b9be4d5e88155c6d92d2781d", "secret" => "fe2894cae249415080094b3f49da0cb9" ) 
			),

			// windows live
			"Live" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),

			"MySpace" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"LinkedIn" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => "",
	);
