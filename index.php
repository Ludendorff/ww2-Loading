<?php
	include 'config.php';
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$communityid = $_GET["user"];
	$mapname = $_GET["mapname"];
	if (isset($_GET['user'])) {
		$data = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=79FAC76B238A2D0748D5490223180659&steamids='.$_GET['user'];
		$f = file_get_contents($data);
		$arr = json_decode($f, true);
		if (isset($arr['response']['players'][0]['personaname']))
			$plname = $arr['response']['players'][0]['personaname'];
		if (isset($arr['response']['players'][0]['avatarfull']))
			$avatar = $arr['response']['players'][0]['avatarfull'];
		$authserver = bcsub( $communityid, ’76561197960265728′ ) & 1;
		$authid = (bcsub( $communityid, ’76561197960265728′ ) - $authservers ) / 2;
		$steamid = "STEAM_0:$authserver:$authid";
	}
	if ($usedb == true) {
		$result = mysqli_query($con, "SELECT * FROM `gmod_top` WHERE `CID` LIKE '$communityid'");
		$row = mysqli_fetch_array($result);
		if ($row["CID"] == $communityid) {
			mysqli_query($con, "UPDATE gmod_top SET count = count +1 WHERE CID = '$communityid'");
		} else {
			mysqli_query($con, "INSERT INTO `gmod_top` (`ID`, `CID`, `count`) VALUES (NULL, '$communityid', '1');");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Loading Screen</title>
	<link rel="stylesheet" href="assets/css/normalize.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script src="assets/js/loadbar.js"></script>
	<meta charset="utf-8">
</head>
<body>
	<?php
		$id = $_GET["user"];
		$nid = $id - 76561197960265728;
		$hnid = $nid / 2;
		if (strlen($hnid) == 10) {
			$hnid = substr($hnid, 0, -2);
			$steamid64 = "STEAM_0:1:" . $hnid;
		} else {
			$steamid64 = "STEAM_0:0:" . $hnid;
		}
	?>
	<div class="container">
		<img src="assets/img/logo.png" alt="Logo" id="logo">
		<div id="client-info">
			<div class="avatar">
				<img src="<?php echo $avatar; ?>" alt="">
			</div>
			<div id="client-name">
				<p><?php echo $plname; ?> @ <?php echo $mapname; ?></p>
			</div>
		</div>
		<div id="server-rules">
			<ul>
				<li>- <?php echo $rule1; ?></li>
				<li>- <?php echo $rule2; ?></li>
				<li>- <?php echo $rule3; ?></li>
				<li>- <?php echo $rule4; ?></li>
				<li>- <?php echo $rule5; ?></li>
			</ul>
			<ul>
				<li>- <?php echo $rule6; ?></li>
				<li>- <?php echo $rule7; ?></li>
				<li>- <?php echo $rule8; ?></li>
				<li>- <?php echo $rule9; ?></li>
				<li>- <?php echo $rule10; ?></li>
			</ul>
		</div>
		<div class="fill-space1"></div>
		<div id="slider">
			<div>
				<p><?php echo $slide1; ?></p>
			</div>
			<div>
				<p><?php echo $slide2; ?></p>
			</div>
			<div>
				<p><?php echo $slide3; ?></p>
			</div>
			<div>
				<p><?php echo $slide4; ?></p>
			</div>
			<div>
				<p><?php echo $slide5; ?></p>
			</div>
		</div>
		<div class="fill-space2"></div>
		<div id="loading-bar">
			<table>
				<tr>
					<td>Satus:</td>
					<td><label id="dfile">Loading...</label></td>
				</tr>
			</table>
		</div>
		<div id="workshopslider">
			<div id="workshopbar">
				<div id="pbaranim"></div>
			</div>
		</div>
		<div id="fastdlslider">
			<div id="fastdlbar">
				<div id="pbaranim"></div>
			</div>
		</div>
		<div id="player">
		<?php
			$result = mysqli_query($con, "SELECT * FROM gmod_top ORDER BY count DESC LIMIT 5");

			while ($row = mysqli_fetch_array($result)) {
				$data = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=79FAC76B238A2D0748D5490223180659&steamids='. $row["CID"];
				$f = file_get_contents($data);
				$arr = json_decode($f, true);
				if (isset($arr['response']['players'][0]['personaname']))
					$plname = $arr['response']['players'][0]['personaname'];
				if (isset($arr['response']['players'][0]['avatarfull']))
					$avatar = $arr['response']['players'][0]['avatarfull'];

				echo "
				<div class='playerid'>
					<div class='avatartop'>
						<img src='" . $avatar . "'>
					</div>
					<p class='name'>" . $plname . "</p>
					<p>Joins: " . $row["count"] . "</p>
					<p>Last joined:</p>
					<p>" . $row["last"] . "</p>
				</div>
				";
			}
		?>
		</div>
		<script>
			$("#slider > div:gt(0)").hide();

			setInterval(function() {
			  $('#slider > div:first')
				.fadeOut(1000)
				.next()
				.fadeIn(1000)
				.end()
				.appendTo('#slider');
			},  8000);
		</script>
	</div>
</body>
</html>
