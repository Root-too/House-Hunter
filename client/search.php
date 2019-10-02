<?php
    require('connect.php');
    session_start();

    $type = $_SESSION['type'];
    $id = $_SESSION['id'];
    $selected_var = '';

    $sql = 'SELECT * FROM register WHERE id= ?';
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]);
    $post = $stmt->fetch();
?>


<!DOCTYPE html>
<html>
<head>
	<title>House Hunter</title>

    <script type="text/javascript">
    
        function showSuggestion(str){
            if(str.length == 0){
                document.getElementById('output').innerHTML = '';
                
            } else{

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

    </script>

    <link rel="stylesheet" type="text/css" href="feed.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

</head>
<body>


    <div class='navbar'>
    
       <header tabindex="0" style="background-color: #3483eb;">
           <a href=""> <img class="home-logo" src="house.png" alt="logo" width="50px" height="50px"></a> 
           <a href="" style="text-decoration: none">  <div class="text" >HouseHunter</div> </a>

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
                <ul>
                    <li><a href="http://localhost/House-Hunter/client/feed.php">Home</a></li>
                    <li><a href="http://localhost/House-Hunter/client/profile.php">Profile</a></li>
                    <li><a href="http://localhost/House-Hunter/client/search.php">Search</a></li>
                    <li><a href="http://localhost/House-Hunter/client/logout.php">Logout</a></li>
                    <li><a href="#">About</a></li>
                </ul>
           </div>
       </div>
   </div>
    
    <div>
        <form>
            <input style="margin-left: 100px; margin-top: 100px; height: 40px; width: 600px;" type="text" onkeyup="showSuggestion(this.value)" placeholder="Search by Location ">
        </form>
    </div>
    
    <div id="output"></div>
</body>
</html>