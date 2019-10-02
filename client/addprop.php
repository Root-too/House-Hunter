<?php
    require('connect.php');
    //  echo "hello";
    session_start();

    $username = $_SESSION['username'];
    $id = $_SESSION['id'];

    if(isset($_POST['add'])){

		//get form data
		$propname = htmlentities($_POST['propname']);
        $location = htmlentities($_POST['location']);
        $address = htmlentities($_POST['address']);
        $bhk = htmlentities($_POST['bhk']);
        $area = htmlentities($_POST['area']);
        $price = htmlentities($_POST['price']);
        $age = htmlentities($_POST['age']);
        $image = $_FILES['image']['name'];
        $p_type = htmlentities($_POST['p_type']);

        $target = 'uploads/'.basename($_FILES['image']['name']);


        if(!empty($propname) && !empty($location) && !empty($address) && !empty($bhk) && !empty($area) && !empty($price) && !empty($age) && !empty($image)){

                $sql = 'INSERT INTO property(propname, location, address, bhk, area, price, age, image, p_type, s_id) VALUES(?,?,?,?,?,?,?,?,?,?)';
                $stmt = $pdo->prepare($sql);
                

                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                    $stmt->execute([$propname, $location, $address, $bhk, $area, $price, $age, $image, $p_type, $id]);
                    header('Location: feed.php');   
                } else {
                    //enter all fields
                    echo '<script>alert("Unsuccessful")</script>';
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
        <link rel="stylesheet" type="text/css" href="addprop.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
        <title>Add Property</title>
    </head>
    <body>
        
            <div class='navbar'>
                    <div class="header">
                        <img class="home-logo" src="house.png" alt="logo" width="60px" height="60px">
                        <div class="text">House Hunter</div>
                        <!-- <?php echo $username; ?> -->
                    </div>
            </div>
            <div class="login-flex">
                    <form class="user-login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <label style="margin-top: 50px; font-size: 20px">Property Name</label>
                            <br><br>
                            <input type="text" class="form-input" name="propname" placeholder="Property Name">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Location</label>
                            <br><br>
                            <input type="text" class="form-input" name="location" placeholder="Location">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Address</label>
                            <br><br>
                            <textarea class="form-input" name="address"></textarea>
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">BHK</label>
                            <br><br>
                            <input type="text" class="form-input" name="bhk" placeholder="BHK">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Carpet Area</label>
                            <br><br>
                            <input type="text" class="form-input" name="area" placeholder="Carpet Area">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Price</label>
                            <br><br>
                            <input type="text" class="form-input" name="price" placeholder="Price">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Age of Property</label>
                            <br><br>
                            <input type="text" class="form-input" name="age" placeholder="Age of Property">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Add Image</label>
                            <br><br>
                            <input type="file" name="image">
                            <br><br>
                            <label style="margin-top: 50px; font-size: 20px">Property Type</label>
                            <br><br>
                            <input type="radio" name="p_type" value="sale"> Sale
                            <input type="radio" name="p_type" value="rent">  Rent<br>
                            <br><br>
                            <button class="register-button" type="submit" name="add">ADD</button>

                    </form>

                </div>
    </body>
</html>