<?php
    require('connect.php');
    session_start();

    if(isset($_POST['login'])){

        $username = htmlentities($_POST['Username']);
        $pass = htmlentities($_POST['password']);

        if(!empty($username) && !empty($pass)){

            $md5pass = md5($pass);

            $sql = 'SELECT * FROM register WHERE username = ? AND password = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $md5pass]);
            $count = $stmt->rowCount();
            $user = $stmt->fetch();


            if($count == 1){

                $_SESSION['username'] = $username;
                $_SESSION['type'] = $user->type;
                $_SESSION['id'] = $user->id;
                header('Location: feed.php');
            }

        } else {
            //enter all fields
            echo '<script>alert("Please enter all the details")</script>';
        }
    }
?>

<!DOCTYPE html>
<html>
 
    <head>
        <title>House Hunter</title>

        <link rel="stylesheet" type="text/css" href="login.css">
        <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    </head>
            
    <body>
        
            <div class='navbar'>
                    <div class="header">
                        <img class="home-logo" src="house.png" alt="logo" width="60px" height="60px">
                        <div class="text">House Hunter</div>
                    </div>
            </div>
            
            <div class="image-flex">
                <div class="text-flex">
                        <div class="tag">Buy</div>
                        <div class="tag" style="margin-left: auto; margin-right: auto">Rent</div>
                        <div class="tag" style="margin-left: auto">Sell</div>
                </div> 
                
                <div class="login-flex">
                    <form class="user-login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <label style="margin-top: 50px; font-size: 22px;font-family: 'Lobster', cursive;">Username</label>
                            <br><br>
                            <input type="text" class="form-input" name="Username" placeholder="Username" required>
                            <br><br>
                            <label style="margin-top: 70px;font-size: 22px;font-family: 'Lobster', cursive;" >Password</label>
                            <br><br>
                            <input type="password" class="form-input" name="password"  placeholder="Password" required>
                            <br><br>
                            <button class="sign-button" type="submit" name="login">SIGN IN</button>
                    </form>
                    
                    <a class="account" href="register.php">Create Account</a>
                </div>
            </div>
        
            
            <!-- <div style="text-align:center;color: white;font-size: 25px;margin-top: 30px;">Foram Bhanushali<br>Ruthu Shetty<br>Margashi Thakur</div> -->
    </body>
</html>

