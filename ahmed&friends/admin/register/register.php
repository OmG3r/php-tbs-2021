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
$lfields = ["username", "password"];


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


$fields = implode(",", $lfields);
$write = createSQL($_POST, $lfields);
/* build SQL query */
$sql = "INSERT INTO admins ( " . $fields . ")
                    VALUES (" . $write . ")";

if ($conn->query($sql) === true) {
    /* set cookie to indicate browser is logged in */
    setcookie('admin', $_POST['username'], time() + (86400 * 30), "/");
    /* redirect to waitlist */
    header('Location: ../operator-page/index.php');
} 
mysqli_close($conn);      
?>