<?php

    require('connect.php');
    session_start();

    $username = $_SESSION['username'];
    $type = $_SESSION['type'];

    if(isset($_POST['delete'])){

        $delete_id = $_POST['delete_id'];
        $sql = 'DELETE FROM property WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$delete_id]);

        header('Location: feed.php');
    }

    $id = $_GET['id'];

    $sql = 'SELECT * FROM property WHERE id = ?';
	$stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $post = $stmt->fetch();

?>


<!DOCTYPE html>
<html>
    <head>
        <title>House Hunter</title>
        <link rel="stylesheet" type="text/css" href="post.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Hepta+Slab&display=swap" rel="stylesheet">
    </head>
    
    <body>

        <div class='navbar'>
        
        <!-- <div class="page"> -->
            <header tabindex="0" style="background-color: #3483eb;">
                <a href=""> <img class="home-logo" src="house.png" alt="logo" width="50px" height="50px"></a> 
                <a href="" style="text-decoration: none">  <div class="text" >HouseHunter</div> </a>
                <!-- <i class="fas fa-user-circle" style="font-size:40px;color:white;margin-left:1050px;margin-top:10px;"></i>   -->

                <?php echo $username; ?>

            </header>
            <div id="nav-container">
                <div class="bg"></div>
                <div class="button" tabindex="0">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div id="nav-content" tabindex="0">
                    <?php if($type == 'buyer'): ?>
                        <ul>
                            <li><a href="http://localhost/House-Hunter/client/feed.php">Home</a></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="http://localhost/House-Hunter/client/logout.php">Logout</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    <?php else: ?>
                        <ul>
                            <li><a href="http://localhost/House-Hunter/client/feed.php">Home</a></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="http://localhost/House-Hunter/client/addprop.php">Add Property</a></li>
                            <li><a href="http://localhost/House-Hunter/client/logout.php">Logout</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="content">
            <div style="display: flex">
                <img src='uploads/<?php echo $post->image; ?>' alt="house image"  width="600px" height="600px">

                <div style="display: flex; flex-direction: column; height: 400px;justify-content: space-evenly;">

                    <div style="font-size: 30px;">
                        <?php echo $post->propname; ?>
                    </div>

                    <!-- <div style="display: flex; width: 300px;justify-content: space-evenly">  -->
                        <div style="font-size: 20px;">Address: <?php echo $post->address ?></div>
                        <div style="font-size: 20px;">Location: <?php echo $post->location ?></div>
                        <div style="font-size: 20px;">BHK: <?php echo $post->bhk; ?> BHK</div>
                        <div style="font-size: 20px;">Carpet Area: <?php echo $post->area; ?> sq ft</div>
                        <div style="font-size: 20px;">Price : ₹ <?php echo $post->price; ?></div>
                        
                    <!-- </div> -->
                </div>
            </div>
        </div>

        <?php if($type == 'seller'): ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="delete_id" value="<?php echo $post->id; ?>">
                <button type="submit" name="delete">Delete</button>
            </form>
        <?php endif; ?>

    </body>

</html>
