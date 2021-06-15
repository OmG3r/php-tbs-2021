<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land - Operator</title>
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
        <li class="nav-item">
            <a class="nav-link" href="../operator-create/index.html">Create</a>
        </li>
        <li class="search-container">
            <input oninput="filterItems(event)" placeholder="Search" type="text" class="form-control" id="search">
        </li>
        
        
        
        <li class="nav-item auth">
            <a class="nav-link  active" href="./index.html">Admin</a>
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

                         


                        $sql = "SELECT *  FROM events";
                        $result = mysqli_query($conn, $sql);


                       
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i = $i + 1;
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $time = $row['time'];
                                $price = $row['price'];
                                $attendees = $row['attendees'];
                                $img = $row['img'];
                                
                                $btext = "";

                                $sql3 = "SELECT id, name from reservations WHERE eventid=" . $id;
                                $result3 = mysqli_query($conn, $sql3);
                                $attendeesHTML = "";
                                if (mysqli_num_rows($result3) > 0) {
                                    
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                       
                                        
                                        $xname = $row3['name'];
                                        $xid = $row3['id'];
                                       
                                        $str = '<div class="action-attendee">
                                        <div class="attendee">' . $xname . '</div>
                                        <div class="attendee-action">
                                            <form action="unreserve.php" method="POST">
                                                <input name="id" value="' . $xid . '"  style="display:none;"/>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>';
                                        $attendeesHTML .= $str;
                                    }
                                }

                                /* the action buttons */
                                /* each action creates a type of button*/
                               

                                
                                

                                $html = <<<"EOT"
                                <div class="card item">
                                    <img src="../../img/$img" class="card-img-top" alt="tbs">
                                    <div class="card-body">
                                        <h5 class="card-title">$title</h5>
                                        <div class="badges">

                                            <span class="badge badge-primary date">$time</span>
                                            <span class="badge badge-info price">$price TND</span>
                                            <span class="badge badge-success">$attendees attendees</span>
                                        </div>
                                    
                                        <p class="card-text">$description</p>
                                        
                                        <div class="accordion" >
                                            <div class="card">
                                                <div data-toggle="collapse" data-target="#collapse$i"
                                                            aria-expanded="true" aria-controls="collapseOne" class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Attendees
                                                        </button>
                                                    </h2>
                                                </div>
                                        
                                                <div id="collapse$i" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="attendees">
                                                    

                                                        $attendeesHTML

                                                    
                                                            
                                                            
                                                            
                                                            
                                                            
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            
                                        </div>

                                        <button type="button" class="btn btn-danger register">Delete</button>
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
                <h5 class="card-title">TAG</h5>
                <div class="badges">

                    <span class="badge badge-primary date">15/5/2020 - 13:30</span>
                    <span class="badge badge-info price">3 TND</span>
                    <span class="badge badge-success">5 (+20) / 16</span>
                </div>
               
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, quas velit porro architecto quasi voluptates corporis ea quam! Quisquam, pariatur.</p>
                
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne" class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Attendees
                                </button>
                            </h2>
                        </div>
                
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="attendees">
                               

                                    <div class="action-attendee">
                                        <div class="attendee">Rached Fares</div>
                                        <div class="attendee-action">
                                    
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>

                                  

                                    <div class="action-attendee">
                                        <div class="attendee">Adam Boulila</div>
                                        <div class="attendee-action">
                                    
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>

                             
                                    
                                    
                                    
                                    
                                    
                                </div>

                            </div>
                            
                        </div>
                    </div>

                    
                </div>

                <button type="button" class="btn btn-danger register">Delete</button>
            </div>
        </div>

        <div class="card item">
            <img src="../../img/1.jpg" class="card-img-top" alt="tbs">
            <div class="card-body">
                <h5 class="card-title">La soirée</h5>
                <div class="badges">
        
                    <span class="badge badge-primary date">19/5/2020 - 13:30</span>
                    <span class="badge badge-info price">3 TND</span>
                    <span class="badge badge-danger">15 (+20) / 16</span>
                </div>
        
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, quas velit porro
                    architecto quasi voluptates corporis ea quam! Quisquam, pariatur.</p>
        
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                            class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Attendees
                                </button>
                            </h2>
                        </div>
                    
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="attendees">


                                    <div class="action-attendee">
                                        <div class="attendee">Rached Fares</div>
                                        <div class="attendee-action">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                    
                             
                                    <div class="action-attendee">
                                        <div class="attendee">Adam Boulila</div>
                                        <div class="attendee-action">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                    
                                    <div class="action-attendee">
                                        <div class="attendee">Ahmed Jerbi</div>
                                        <div class="attendee-action">

                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                    
                            </div>
                    
                        </div>
                    </div>
                    
                  
                </div>
        
                <button type="button" class="btn btn-danger register">Delete</button>
            </div>
        </div>

    </section>

</body>
</html>