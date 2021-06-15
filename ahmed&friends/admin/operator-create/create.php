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
$lfields = ["title", "description", "time", "price", "attendees", "img"];


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
$sql = "INSERT INTO events ( " . $fields . ")
                    VALUES (" . $write . ")";

if ($conn->query($sql) === true) {

    header('Location: ./index.html');
} 
mysqli_close($conn);      
?>