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


        <!-- <script type="text/javascript">
		
            function showSuggestion(str){

                if(str.length == 0){
                    document.getElementById('output').innerHTML = '';
                } else{
                    
                    //AJAX REQ
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("output").innerHTML = this.responseText;
                            console.log(this.responseText);
                        }
                    };

                    xmlhttp.open("GET", "suggest.php?q="+str, true);
                    xmlhttp.send();
                }
            }

	    </script> -->



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
                            <li><a href="http://localhost/House-Hunter/client/search.php">Search</a></li>
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
                    <div style="font-size: 10px; cursor: pointer;" onclick='window.location="http://localhost/House-Hunter/client/feed.php";'>Clear Filter</div>

                    <form class="filter" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div>
                            <label>BHK</label>
                            <br>
                            <input type="checkbox" name="bkh" value="1" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=1";' > 1<br>
                            <input type="checkbox" name="bkh" value="2" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=2";' > 2<br>
                            <input type="checkbox" name="bkh" value="3" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=3";' > 3<br>
                            <input type="checkbox" name="bkh" value="4" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=4";' > 4<br>
                            <input type="checkbox" name="bkh" value="5" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=5";' > 5+<br>
                        </div>
                        <div class="budget">
                            <br>
                            <label>Budget</label>
                            <br>
                            <label>Min</label>
                            -
                            <select>
                                <option value="89" onselect='window.location="http://localhost/House-Hunter/client/feed.php?var=89";'>Below 90 lacs</option>
                                <option value="90" onselect='window.location="http://localhost/House-Hunter/client/feed.php?var=90";'>90 lacs </option>
                                <option value="1">1 crore</option>
                                <option value="">2 crore</option>
                                <option value="">3 crore</option>
                                <option value="">5 crore</option>
                                <option value="">10 crore</option>
                            </select>
                            <br>
                            <label>Max</label>
                            -
                            <select>
                                <option value="">Below 90 lacs</option>
                                <option value="">90 lacs</option>
                                <option value="">1 crore</option>
                                <option value="">2 crore</option>
                                <option value="">3 crore</option>
                                <option value="">5 crore</option>
                                <option value="">10 crore</option>
                            </select>
                        </div>
                        <div>
                        Type:
                            <input type="radio" name="p_type" value="sale" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=sale";'> Sale
                            <input type="radio" name="p_type" value="rent" onclick='window.location="http://localhost/House-Hunter/client/feed.php?var=rent";'> Rent
                        </div>
                     </div>  
                    </form>
               

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

                    <?php
                        //for bhk filter
                        if($selected_var == 1){
                            $stmt = $pdo->query('SELECT * FROM property WHERE bhk=1');
                            
                        }else if($selected_var == 2){
                                $stmt = $pdo->query('SELECT * FROM property WHERE bhk=2');
                            }
                            else if($selected_var == 3){
                                $stmt = $pdo->query('SELECT * FROM property WHERE bhk=3');
                            }else if($selected_var == 4){
                                $stmt = $pdo->query('SELECT * FROM property WHERE bhk=4');
                            }
                            else if($selected_var == 5){
                                $stmt = $pdo->query('SELECT * FROM property WHERE bhk>=5');
                            }
    
                    ?>

                    <?php
                        //for budget filter

                        if($selected_var == 90){
                            $stmt = $pdo->query('SELECT * FROM property WHERE bhk=1');
                        }
                    ?>


                    <?php
                        //for type filter

                        if($selected_var == 'sale'){
                            $stmt = $pdo->query('SELECT * FROM property WHERE p_type="sale"');
                        }else if($selected_var == 'rent'){
                            $stmt = $pdo->query('SELECT * FROM property WHERE p_type="rent"');
                        }
                    ?>

                    <?php while($row = $stmt->fetch()): ?> 
                        <div class="info">  
                        <div style="display: flex">
                            
                            <img  class="image" src='uploads/<?php echo $row->image; ?>' alt="house image" width="200px" height="200px">

                            <div style="display: flex; flex-direction: column; height: 200px;justify-content: space-evenly;">
                                <div style="font-size:20px "><?php echo $row->bhk; ?> BHK apartment in <?php echo $row->location; ?></div>

                                <div style="font-size:20px" >
                                   Property Name: <a href="<?php echo "http://localhost/House-Hunter/client/" ?>post.php?id=<?php echo $row->id; ?>"><?php echo $row->propname; ?>
                                </div>

                                <div style="display: flex;font-size:20px; width: 550px;justify-content: space-evenly;"> 
                                    <div style="margin-left:-35px;">
                                    <?php if($row->p_type=='rent')
                                            { 
                                               echo 'Rental Price (ppm): ₹';
                                            }else{
                                                echo "Price: ₹";
                                            }
                                    ?><?php echo $row->price; ?></div>
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