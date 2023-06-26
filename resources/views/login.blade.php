<?php
$loginError = 2;
if(isset($_GET['login'])) {
  $loginError = $_GET['login'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100&display=swap" rel="stylesheet">
    
    <title>Login</title>
    
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body id="loginbody">
    
    <div class="outer">
        <div class="middle">
          <div class="inner">
            <div class="centered"><h1>Login</h1></div>
            <div class="centered">
                <form id="loginform" method="post" action="overview.blade.php">
                    <label for="lietotajvards"><b>Lietotājvārds</b></label><br />
                    <input type="text" name="username" /><br />
                    <label for="parole"><b>Parole</b></label><br />
                    <input type="password" name="password" /><br />
                    <br />
                      <?php if ($loginError == 0)  echo "<p style=\"color: red; font-family: 'Noto Sans', sans-serif;\">Ievadīti nepareizi dati!</p>";
                            if ($loginError == 1) {echo "<p style=\"color: red; font-family: 'Noto Sans', sans-serif;\">Beigusies lietotāja sesija,</p>";
                                                   echo "<p style=\"color: red; font-family: 'Noto Sans', sans-serif;\"> ienāciet vēlreiz.</p>";}
                      ?>
                    <div class="centered"><input type="submit" name="Submit" value="Ienākt!" class="button-81"/></div>
            </form>
            </div>
            
          </div>
        </div>
      </div>



</body>
</html>