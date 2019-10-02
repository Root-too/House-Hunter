<?php
    require('connect.php');
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

                <div style="background-color: white; margin-top: 100px; margin-right:20px !important;margin-left:20px !important;margin-bottom:-50px;padding: 10px;width: 1400px;">
                    <div style="display: flex">
                        <img src="uploads/'.$post->image.'" alt="house image" width="200px" height="200px">

                        <div style="display: flex; flex-direction: column; height: 200px;justify-content: space-evenly;">
                            <div>'.$post->bhk.' BHK apartment in '.$post->location.'</div>

                            <div>
                            Property Name: <a href="http://localhost/House-Hunter/client/post.php?id='.$post->id.'">'.$post->propname.'
                            </div>

                            <div style="display: flex; width: 500px;justify-content: space-evenly;font-size:20px;"> 
                                <div style="margin-left:-25px;">Price: ₹ '.$post->price.'</div>
                                <div>'.$post->bhk.' BHK</div>
                                <div>'.$post->area.' sq ft</div>
                                <div>Age:'.$post->age.'</div>
                            </div>
                        </div>
                    </div>
                </div>              
            ';

            echo $output;
           
        }
    } else {
        echo "No result";
    }

     

?>