<!DOCTYPE html>
<html>
 
    <head>
        <link rel="stylesheet" type="text/css" href="register.css">
        <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
        <title>Profile page</title>
    </head>
    <body>
        
            <div class='navbar'>
                    <div class="header">
                        <img class="home-logo" src="house.png" alt="logo" width="60px" height="60px">
                        <div class="text">House Hunter</div>
                    </div>
            </div>
            <div class="login-flex">
                    <form class="user-login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <label style="margin-top: 50px; font-size: 20px">First Name</label>
                            <br><br>
                            <input type="text" class="form-input" name="firstName" placeholder="First Name">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Last Name</label>
                            <br><br>
                            <input type="text" class="form-input" name="lastName" placeholder="Last Name">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Email-Id</label>
                            <br><br>
                            <input type="email" class="form-input" name="email-id" placeholder="email-id">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Date of Birth</label>
                            <br><br>
                            <input type="date" class="form-input" min="1947-01-01" name="dob" placeholder="Date of Birth">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Username</label>
                            <br><br>
                            <input type="text" class="form-input" name="Username" placeholder="Username">
                            <br><br>
                            <label style="margin-top: 70px;font-size: 20px" >Password</label>
                            <br><br>
                            <input type="password" class="form-input" name="password"  placeholder="Password">
                            <br><br>
                            <label style="margin-top: 70px;font-size: 20px" >Confirm Password</label>
                            <br><br>
                            <input type="password" class="form-input" name="confirmPassword"  placeholder="Confirm Password">
                            <br><br>
                            
                            
                            <button class="register-button"  type="submit" name="submit">SAVE CHANGES</button>
                    </form>
                    
                </div>
    </body>
</html>