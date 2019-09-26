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

        <!-- <script type="text/javascript">
            var image_tracker = '1';

            function change(){
                var img = document.getElementById('home');
                if(image_tracker == '1'){
                    img.src = "home_2.png";
                    image_tracker = '2';
                }
                else if(image_tracker == '2'){
                    img.src = "home_3.png";
                    image_tracker = '3';
                }
                else if(image_tracker == '3'){
                    img.src = "home_4.png";
                    image_tracker = '4'
                }
                else{
                    img.src = "home_1.png";
                    image_tracker = '1';
                }
            }

            var timer = setInterval('change()',1000);
        </script> -->

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
                            <input type="text" class="form-input" name="Username" placeholder="Username">
                            <br><br>
                            <label style="margin-top: 70px;font-size: 22px;font-family: 'Lobster', cursive;" >Password</label>
                            <br><br>
                            <input type="password" class="form-input" name="password"  placeholder="Password">
                            <br><br>
                            <!-- <button class="sign-button"  type="submit" formaction="/feed.html">SIGN IN</button> -->
                            <button class="sign-button" type="submit" name="login">SIGN IN</button>
                            <!-- <button class="sign-button"  type="submit" formaction="/feed.html"><a href="feed.html">SIGN IN</a></button> -->
                    </form>
                    
                    <a class="account" href="register.html">Create Account</a>
                </div>
            <div>
        
            
            
    </body>
</html>

