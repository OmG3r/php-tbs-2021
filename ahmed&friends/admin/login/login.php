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



    $sql = "SELECT username, password FROM admins WHERE username='". $_POST['username']."' AND password='". $_POST['password'] ."'";
    $result = $conn->query($sql);
    /* verify that the account exists */
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            
            /* set cookie to indicate browser is logged in */
            setcookie('admin', $_POST['username'], time() + (86400 * 30), "/");
            /* redirect to waitlist */
            header('Location: ../operator-page/index.php');
        }
    } else {
        echo "failed login";
    }

    

    echo "Connected successfully";
    mysqli_close($conn);
?>