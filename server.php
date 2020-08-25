<?php
  include 'config.php';
  $steamid = $_GET["id"];
  echo $_GET["id"];
  $setting = $_GET["do"];

  $result = mysqli_query($con, "SELECT * FROM gmod_music WHERE steamid = '" . $_GET["id"] . "'");
  $rowcount = mysqli_num_rows($result);

  if (isset($_GET["do"])) {

    if ($rowcount == 0) {
      mysqli_query($con, "INSERT INTO gmod_music (steamid, setting) VALUES ('" . $steamid . "', '" . $setting . "')");
    } else {
      // nothing
    }
  }

  $result = mysqli_query($con, "SELECT * FROM gmod_music WHERE steamid = '" . $_GET["id"] . "'");
  $rowcount = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server check</title>
  <?php if ($rowcount != 0) {
    echo '<script type="text/javascript"> window.location.href = "http://darkscar.net" </script>';
    die();
  }
  ?>
  <style>
    body {
      font-family: sans-serif;
    }

    .msg-card {
      padding: 40px;
      width: 274px;
      background-color: #F7F7F7;
      margin: 12% auto;
      border-radius: 2px;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .no-button {
      position: relative;
      vertical-align: top;
      width: 49%;
      height: 60px;
      padding: 0;
      font-size: 22px;
      color: white;
      text-align: center;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
      background: #c0392b;
      border: 0;
      border-bottom: 2px solid #b53224;
      cursor: pointer;
      -webkit-box-shadow: inset 0 -2px #b53224;
      box-shadow: inset 0 -2px #b53224;
      box-sizing: border-box;
    }

    .no-button:active {
      top: 1px;
      outline: none;
      -webkit-box-shadow: none;
      box-shadow: none;
    }

    .yes-button {
      position: relative;
      vertical-align: top;
      width: 49%;
      height: 60px;
      padding: 0;
      font-size: 22px;
      color: white;
      text-align: center;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
      background: #2ecc71;
      border: 0;
      border-bottom: 2px solid #28be68;
      cursor: pointer;
      -webkit-box-shadow: inset 0 -2px #28be68;
      box-shadow: inset 0 -2px #28be68;
      box-sizing: border-box;
    }

    .yes-button:active {
      top: 1px;
      outline: none;
      -webkit-box-shadow: none;
      box-shadow: none;
    }
  </style>

</head>
<body>
  <div class="msg-card">
    <p>Would you like to have music on the loading screen? (<?php echo $_GET["id"]; ?>)</p>
    <button class="yes-button" onclick="location.href='server.php?do=1&id=<?php echo $_GET["id"]; ?>'">Yes</button>
    <button class="no-button" onclick="location.href='server.php?do=0&id=<?php echo $_GET["id"]; ?>'">No</button>
  </div>
</body>
</html>
