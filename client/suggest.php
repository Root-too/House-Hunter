<?php
    require('connect.php');
    session_start();

    $output = '';

    $q = $_REQUEST['q'];
    
    if($q !== ""){

        $q = strtolower($q);

        $sql = "SELECT * FROM property WHERE location LIKE '".$q."%' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll();

        foreach($posts as $post){

            $output .= ' 

                <div style="background-color: white; margin-top: 20px; padding: 10px;">
                    <div style="display: flex">
                        <img src="uploads/'.$post->image.'" alt="house image" width="200px" height="200px">

                        <div style="display: flex; flex-direction: column; height: 200px;justify-content: space-evenly;">
                            <div>'.$post->bhk.' BHK apartment in '.$post->location.'</div>

                            <div>
                                <a href="http://localhost/House-Hunter/client/post.php?id='.$post->id.'">'.$post->propname.'
                            </div>

                            <div style="display: flex; width: 300px;justify-content: space-evenly"> 
                                <div>₹ '.$post->price.'</div>
                                <div>'.$post->bhk.' BHK</div>
                                <div>'.$post->area.' sq ft</div>
                            </div>
                        </div>
                    </div>
                </div>              
            ';

            $_SESSION['search'] = 1;
            echo $output;
           
        }
    } else {
        echo "No result";
    }

     

?>