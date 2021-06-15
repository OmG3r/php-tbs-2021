<?php
/**  **/
/*make sure that this page "success" is access only through submitting the form */
/* if no form subbmited => name does not exist in $_POST */


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



/* function to help create the long SQL querry */


/* build SQL query */
echo print_r($_POST);
$sql = "DELETE FROM reservations
WHERE username ='" . $_POST['username'] . "'" . " and eventid=" . $_POST['eventid'] ;
echo $sql;
if ($conn->query($sql) === true) {
    /* set cookie to indicate browser is logged in */
    
    /* redirect to waitlist */
    header('Location: ./index.php');
} 
mysqli_close($conn);      
?>