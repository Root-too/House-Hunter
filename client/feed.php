<?php
    require('connect.php');
    session_start();

    // $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $id = $_SESSION['id'];
    $selected_var = '';

    $sql = 'SELECT * FROM register WHERE id= ?';
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    if(isset($_GET['var'])){
        $selected_var = $_GET['var'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>House Hunter</title>

        <link rel="stylesheet" type="text/css" href="feed.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/15cc7f8e80.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Hepta+Slab&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <div class='navbar'>
    
         <!-- <div class="page"> -->
            <header tabindex="0" style="background-color: #3483eb;">
                <a href=""> <img class="home-logo" src="house.png" alt="logo" width="50px" height="50px"></a> 
                <a href="" style="text-decoration: none">  <div class="text" >HouseHunter</div> </a>
                <!-- <i class="fas fa-user-circle" style="font-size:40px;color:white;margin-left:1050px;margin-top:10px;"></i>   -->

                <div style="font-size:20px;color:white;margin-left:900px;margin-top:10px;"> Username: <?php echo $post->username; ?> </div>

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
                            <li><a href="http://localhost/House-Hunter/client/profile.php">Profile</a></li>
                            <li><a href="http://localhost/House-Hunter/client/logout.php">Logout</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    <?php else: ?>
                        <ul>
                            <li><a href="http://localhost/House-Hunter/client/feed.php">Home</a></li>
                            <li><a href="http://localhost/House-Hunter/client/profile.php">Profile</a></li>
                            <li><a href="http://localhost/House-Hunter/client/addprop.php">Add Property</a></li>
                            <li><a href="http://localhost/House-Hunter/client/logout.php">Logout</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <!-- User type is buyer -->
        <?php if($type == 'buyer'): ?>

            <div class="container">
                <div class="sidebar">
                    <div style="font-size: 25px;">Sort By</div>
                    <div style="font-size: 10px; cursor: pointer;" onclick='window.location="http://localhost/House-Hunter/client/feed.php";'>Clear Sort</div>
                    <form class="sort" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div>
                            <input type="radio" name="sort" value="l_to_h" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=l_to_h";'>
                            <label>Price: Low to High</label>
                        </div>
                        <div>
                            <input type="radio" name="sort" value="h_to_l" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=h_to_l";'>
                            <label>Price: High to Low</label>
                        </div>
                        <div>
                            <input type="radio" name="sort" value="age" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=age";'>
                            <label>Dated Newest</label> 
                        </div>
                    </form> 

                    <br><br>
                    <div style="font-size: 25px;">Filter</div>
                    <div style="font-size: 10px;">Clear Filter</div>
                    <form class="filter">
                        <div>
                            <label>BHK</label>
                            <br>
                            <input type="text">
                        </div>
                        <div class="budget">
                            <label>Budget</label>
                            <br>
                            <input type="text" placeholder="Min">
                            - 
                            <input type="text" placeholder="Max">
                        </div>
                        <button>Sale</button>
                        <button>Rent</button>
                            
                        <button type="submit" name="apply" > Apply Filter</button>
                    </form>
                </div>

                <div class="content">

                    <?php

                        if($selected_var == 'l_to_h'){
                            
                            $stmt = $pdo->query('SELECT * FROM property ORDER BY price ASC');
                        } else if($selected_var == 'h_to_l') {

                            $stmt = $pdo->query('SELECT * FROM property ORDER BY price DESC');                                
                        } else if($selected_var == 'age') {

                            $stmt = $pdo->query('SELECT * FROM property ORDER BY age ASC');     
                        } else {

                        $stmt = $pdo->query('SELECT * FROM property');
                        }
                    ?>


                    <?php while($row = $stmt->fetch()): ?> 
                        <div class="info">  
                        <div style="display: flex">
                            
                            <img  class="property-image" src='uploads/<?php echo $row->image; ?>' alt="house image" width="200px" height="200px">

                            <div style="display: flex; flex-direction: column; height: 200px;justify-content: space-evenly;">
                                <div style="font-size:20px "><?php echo $row->bhk; ?> BHK apartment in <?php echo $row->location; ?></div>

                                <div style="font-size:20px" >
                                   Property Name: <a href="<?php echo "http://localhost/House-Hunter/client/" ?>post.php?id=<?php echo $row->id; ?>"><?php echo $row->propname; ?>
                                </div>

                                <div style="display: flex;font-size:20px; width: 500px;justify-content: space-evenly;"> 
                                    <div style="margin-left:-25px;">Price: ₹ <?php echo $row->price; ?></div>
                                    <div><?php echo $row->bhk; ?> BHK</div>
                                    <div> Area: <?php echo $row->area; ?> sq ft</div>
                                    <div> Age: <?php echo $row->age; ?> </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endwhile; ?>
                

                </div>
            </div>

        <!-- User type is seller -->
        <?php else: ?>
            <?php 
                    $sql = 'SELECT * FROM property WHERE s_id = ?';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                    $posts = $stmt->fetchAll();
                    $count = $stmt->rowCount();

                    if($count==0){
                       
                       
                        echo ' <div  style="margin-left:50px; margin-top: 120px;font-size:30px;">
                               <a href="http://localhost/House-Hunter/client/addprop.php">Add your first property</a>';
                          
                        }
            
                ?>

           
            

            <?php foreach ($posts as $post): ?> 
                <div class="info-seller">  
                    <div style="display: flex">
                        <img  class="property-image"src='uploads/<?php echo $post->image; ?>' alt="house image" width="200px" height="200px">

                        <div style="display: flex; flex-direction: column; height: 200px;justify-content: space-evenly;">
                            <div style="font-size:20px "><?php echo $post->bhk; ?> BHK apartment in <?php echo $post->location; ?></div>

                            <div style="font-size:20px ">
                            Property Name:  <a href="<?php echo "http://localhost/House-Hunter/client/" ?>post.php?id=<?php echo $post->id; ?>"><?php echo $post->propname; ?>
                            </div>

                            <div style="display: flex; width: 500px;justify-content: space-evenly;font-size:20px;"> 
                                <div style="margin-left:-25px;">Price: ₹ <?php echo $post->price; ?></div>
                                <div><?php echo $post->bhk; ?> BHK</div>
                                <div>Area: <?php echo $post->area; ?> sq ft</div>
                                <div>Age: <?php echo $post->age; ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            

        <?php endif; ?>

        
    </body>
</html>