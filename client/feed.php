<?php
    require('connect.php');
    session_start();

    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
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
                    <ul>
                        <li><a href="#0">Profile</a></li>
                        <li><a href="#0">Edit Property</a></li>
                        <li><a href="http://localhost/House-Hunter/client/logout.php">Logout</a></li>
                        <li><a href="#0">About</a></li>
                        <li><a href="#0">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if($type == 'buyer'): ?>

            <div class="container">
                <div class="sidebar">
                    <div style="font-size: 25px;">Sort By</div>
                    <div style="font-size: 10px;">Clear Sort</div>
                    <form class="sort">
                        <div>
                            <input type="radio" name="price">
                            <label>Price: Low to High</label>
                        </div>
                        <div>
                            <input type="radio" name="price">
                            <label>Price: High to Low</label>
                        </div>
                        <div>
                            <input type="radio" name="price">
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
                    </form>
                </div>

                <div class="content">

                    <?php

                        // require('connect.php');

                        $stmt = $pdo->query('SELECT * FROM property');
                    ?>


                    <?php while($row = $stmt->fetch()): ?> 
                        <div class="info">  
                        <div style="display: flex">
                            <img src='uploads/<?php echo $row->image; ?>' alt="house image" width="200px" height="200px">

                            <div style="display: flex; flex-direction: column; height: 200px;justify-content: space-evenly;">
                                <div><?php echo $row->bhk; ?> BHK apartment in <?php echo $row->location; ?></div>

                                <div>
                                    <a href="<?php echo "http://localhost/House-Hunter/client/" ?>post.php?id=<?php echo $row->id; ?>"><?php echo $row->propname; ?>
                                </div>

                                <div style="display: flex; width: 300px;justify-content: space-evenly"> 
                                    <div>₹ <?php echo $row->price; ?></div>
                                    <div><?php echo $row->bhk; ?> BHK</div>
                                    <div><?php echo $row->area; ?> sq ft</div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endwhile; ?>
                

                </div>
            </div>
        <?php else: ?>
            <h1 style="margin-top: 100px;">hi</h1>

        <?php endif; ?>

        
    </body>
</html>