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
$lfields = ["username", "eventid"];

$namex = "";
$sql = "SELECT name from users where username='" . $_POST['username'] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    
    while ($row = mysqli_fetch_assoc($result)) {
        $namex = $row['name'];
    }
}
/* function to help create the long SQL querry */
function createSQL($array, $values) 
{
    $cont = [];
    foreach ($values as $key) {
        if (array_key_exists($key, $array)) {
            array_push($cont, "'" . $array[$key] . "'");
        } else {
            
            array_push($cont, "''");
        }
    }
    return implode(",", $cont);
};


$fields = implode(",", $lfields) . ",name";

/* build SQL query */

$sql = "INSERT INTO reservations ( " . $fields . ")
                    VALUES (" . "'" . $_POST['username'] . "'," . $_POST['eventid'] . ",'" . $namex . "'" . ")";

if ($conn->query($sql) === true) {
    /* set cookie to indicate browser is logged in */
    
    /* redirect to waitlist */
    header('Location: ./index.php');
} 
mysqli_close($conn);      
?>