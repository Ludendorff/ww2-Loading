<?php
	/* *************************
			the this to true IF:
			 - You have a MySQL DB
			 - You want to use the top joins
			 - You want user be able to choose if they want music on their loadingscreen
			otherwise set this to false

			ALWAYS SET TO TRUE - FUNCTION NOT IMPLEMENTED JET
	**** */
	$usedb = true;

	/* *************************
			if you set the above value to true, fill in these details:
	**** */
	$dbhost = "localhost"; // Database IP / Connection
	$dbuser = "root"; // MySQL User
	$dbpass = "password"; // Database Password
	$dbdatabase = "darkrp"; // Database Name


	/* *************************
			Fill here in some rules
	**** */
	$rule1 = "NLR always applies";
	$rule2 = "Spawning random giant props is kick for 20 minutes";
	$rule3 = "Racism will lead to a warning, 2 warnings is ban";
	$rule4 = "No disrespecting admins";
	$rule5 = "Hobos are not allowed to own doors";
	$rule6 = "Every raid/mug/robbery/etc MUST be advertised";
	$rule7 = "Inappropriate sprays = warning, 2 warnings = ban";
	$rule8 = "No RDM/RDA";
	$rule9 = "No Propsurfing/Propclimbing/Propblocking";
	$rule10 = "No self supply";

	/* *************************
			Fill here in some extra info you would like to "slide"
	**** */
	$slide1 = "Hobo: not allowed to have home, sings for money";
	$slide2 = "Hitman: kills people for money";
	$slide3 = "Security: protect stores,mobbosses or drugdealers for money";
	$slide4 = "News reporter: Creates & sells newspapers";
	$slide5 = "Mob boss: commands gangsters, frees people from jail";


	/* *************************
			DO NOT EDIT UNDER THIS LINE
	**** */
	if ($usedb == true) {
		$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase) or die("Unable to Connect");
	}
?>
