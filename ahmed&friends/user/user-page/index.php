<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land - User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script async src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script async src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./style.css">
    <script defer src="script.js"></script>
</head>
<body>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="./index.html">Events</a>
        </li>
        <li class="search-container">
            <input oninput="filterItems(event)" placeholder="Search" type="text" class="form-control" id="search">
        </li>
        <li class="nav-item auth">
            <a class="nav-link active" href="./index.html">User</a>
        </li>
        
        
        <li class="nav-item">
            <a class="nav-link " href="../../index.html">Logout</a>
        </li>
    </ul>

    

    <section class="events">

    <?php 
                         $servername = "localhost";
                         $username = "root";
                         $password = ""; /* none for root */
                         $database = "eventproject"; /* change to project */
     
                         // Create connection
                         $conn = mysqli_connect($servername, $username, $password, $database);
     
                         // Check connection
                         if (!$conn) {
                             die("Connection failed: " . mysqli_connect_error());
                         }

                         $sql2 = "SELECT eventid from reservations WHERE username='" . $_COOKIE['user'] . "'";
                         $result2 = mysqli_query($conn, $sql2);
                         $events = [];
                         if (mysqli_num_rows($result2) > 0) {
                             // output data of each row
                             
                             while ($row = mysqli_fetch_assoc($result2)) {
                                 
                                 array_push($events, $row['eventid']);
                             }
                         }


                        $sql = "SELECT *  FROM events";
                        $result = mysqli_query($conn, $sql);


                       
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $time = $row['time'];
                                $price = $row['price'];
                                $attendees = $row['attendees'];
                                $img = $row['img'];
                                
                                $btext = "";

                                /* the action buttons */
                                /* each action creates a type of button*/
                                if (in_array($id, $events)) {
                                    /*user reserved this event */
                                    $btext  = '<form></form> <form action="unreserve.php" method="POST">
                                        <input name="eventid" value="'. $id .'" style="display:none;"/>
                                        <input name="username" value="'. $_COOKIE['user'] .'" style="display:none;"/>
                                        <button type="submit" class="btn btn-danger">Un-reserve</button>
                                    </form>';
                                } else {
                                    $btext  = '<form></form> <form action="reserve.php" method="POST">
                                        <input name="eventid" value="'. $id .'" style="display:none;"/>
                                        <input name="username" value="'. $_COOKIE['user'] .'" style="display:none;"/>
                                        <button type="submit" class="btn btn-success">Reserve</button>
                                    </form>';
                                }

                                
                                

                                $html = <<<"EOT"
                                <div class="card item">
                                    <img src="../../img/$img" class="card-img-top" alt="tbs">
                                    <div class="card-body">
                                        <h5 class="card-title">T$title</h5>
                                        <div class="badges">

                                            <span class="badge badge-primary date">$time</span>
                                            <span class="badge badge-info price">$price TND</span>
                                            <span class="badge badge-success">$attendees persons</span>
                                        </div>
                                    
                                        <p class="card-text">$description</p>
                                        
                                

                                        $btext
                                    </div>
                                </div>
                                EOT;
            
                                echo $html;
                            }


                        }
                        mysqli_close($conn);
                    
                    ?>

        <div class="card item">
            <img src="../../img/1.jpg" class="card-img-top" alt="tbs">
            <div class="card-body">
                <h5 class="card-title">Tag</h5>
                <div class="badges">

                    <span class="badge badge-primary date">15/5/2020 - 13:30</span>
                    <span class="badge badge-info price">3 TND</span>
                    <span class="badge badge-success">5 (+20) / 16</span>
                </div>
               
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, quas velit porro architecto quasi voluptates corporis ea quam! Quisquam, pariatur.</p>
                
           

                <button type="button" class="btn btn-success register">Register</button>
            </div>
        </div>

        <div class="card item">
            <img src="../../img/1.jpg" class="card-img-top" alt="tbs">
            <div class="card-body">
                <h5 class="card-title">La Sorié</h5>
                <div class="badges">
        
                    <span class="badge badge-primary date">19/5/2020 - 13:30</span>
                    <span class="badge badge-info price">3 TND</span>
                    <span class="badge badge-danger">15 (+20) / 16</span>
                </div>
        
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, quas velit porro
                    architecto quasi voluptates corporis ea quam! Quisquam, pariatur.</p>
        
              
        
                <button type="button" class="btn btn-danger register">un-Register</button>
            </div>
        </div>

    </section>

</body>
</html>