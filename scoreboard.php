<html>
<head>
  <link href='https://fonts.googleapis.com/css?family=Pontano Sans' rel='stylesheet'>
</head>

  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-close"></i></a>
    <a style="color: darkorange; font-weight: bolder; font-size: 30px; padding: 0px;">SCORES</a>
    <hr style="width: 50%;">
    <table style="background: none; color: white; border: none;">

    <?php
        $sql = mysqli_query($conn, "SELECT * FROM players ORDER BY pts DESC, player_name ASC");
        $i = 1;
        while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)){
            $name = $r['player_name'];
            $pts = $r['pts'];
            echo '<tr><td>' . $name . '</td><td style="color: gold">' . $pts . '</td></tr>';
            $i++;
        }
    ?>
    </table>
  </div>

  <br>
  <!-- Use any element to open the sidenav -->
  <span id="open" onclick="openNav()"><i class="fa fa-bars"></i> Scoreboard</span>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <script>
    /* Set the width of the side navigation to 250px */
  function openNav() {
      document.getElementById("mySidenav").style.width = "350px";
  }

  /* Set the width of the side navigation to 0 */
  function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
  }
  </script>
  <style>
  /* The side navigation menu */
  .sidenav {
      height: 100%; /* 100% Full-height */
      width: 0; /* 0 width - change this with JavaScript */
      position: fixed; /* Stay in place */
      z-index: 1; /* Stay on top */
      top: 0; /* Stay at the top */
      left: 0;
      opacity: .9;
      background-color: black; /* Black*/
      overflow-x: hidden; /* Disable horizontal scroll */
      padding-top: 60px; /* Place content 60px from the top */
      transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
      border-right: 4px solid white;
  }

  /* The navigation menu links */
  .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #D3BC8D;
      display: block;
      transition: 0.3s;
  }

  /* When you mouse over the navigation links, change their color */
  .sidenav a:hover {
      color: white;
  }

  /* Position and style the close button (top right corner) */
  .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 25px;
      margin-left: 50px;
      margin-top: 25px;
      color:grey;
  }

  div#mySidenav {
    align-content: center;
    justify-content: normal;
  }


  /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
  #main {
      transition: margin-left .5s;
      padding: 20px;
  }

  i:hover {
    color: white;
    cursor: pointer;
    transition-duration: 0.5s;
  }

  #divider {
    margin: 0%;
    border-color: white;
    width: 80%;
    margin-left: 10%;
  }

  #open {
    margin-left: 20px;
    font-size: 20px;
    font-style: italic;
    font-weight: bold;
    padding: 4px;
    background-color: rgba(255,255,255,.5);
    border: 2px solid rgba(0,0,0,.8);
  }

  #open:hover {
    color: white;
    transition-duration: 0.5s;
    background-color: rgba(0,0,0,.8);
    cursor:pointer;
    border: 2px solid rgba(255,255,255,.8);
  }
  </style>
</html>