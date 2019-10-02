<?php
     require('connect.php');
    session_start();

    $username = $_SESSION['username'];
    $id = $_SESSION['id'];

    
    $sql = 'SELECT * FROM register WHERE id= ?';
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    

    if(isset($_POST['save']))
    {   
        $fname = htmlentities($_POST['fname']);
        $lname = htmlentities($_POST['lname']);
        $dob = htmlentities($_POST['dob']);
        $email =  htmlentities($_POST['email']);
        $username=  htmlentities($_POST['username']);
        
        $sql='UPDATE register SET fname = ? ,lname =? ,email=?,dob=?,username=? WHERE id= ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fname,$lname,$email,$dob,$username,$id]);
        // echo 'post updated';
      
        header('Location: feed.php');   
    }
    else{
        echo 'post not updated';
    }
   
?>


<!DOCTYPE html>
<html>
 
    <head>
        <link rel="stylesheet" type="text/css" href="profile.css">
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
                    <form class="user-login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <label style="margin-top: 50px; font-size: 20px">First Name</label>
                            <br><br>
                            <input type="text" class="form-input" name="fname" placeholder="First Name" value="<?php echo $post->fname; ?>" >
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Last Name </label>
                            <br><br>
                            <input type="text" class="form-input" name="lname" placeholder="Last Name" value="<?php echo $post->lname; ?>">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Email-Id</label>
                            <br><br>
                            <input type="email" class="form-input" name="email" placeholder="email-id" value="<?php echo $post->email;?>">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Date of Birth</label>
                            <br><br>
                            <input type="date" class="form-input" min="1947-01-01" name="dob" placeholder="Date of Birth" value="<?php echo $post->dob;?>">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Username</label>
                            <br><br> 
                            <input type="text" class="form-input" name="username" placeholder="Username" value="<?php echo $post->username;?>">
                            <br> <br>
                            <button class="register-button"  type="submit" name="save">SAVE CHANGES</button>
                            
                    </form>
                
                </div>
    </body>
</html>