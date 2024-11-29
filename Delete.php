<?php 
require('./Database.php');

if (isset($_POST['delete'])){
    $deleteID = $_POST['deleteID'];

    $querrydelete = "DELETE FROM tbl3a WHERE ID = $deleteID";
    $sqldelete = mysqli_query($connection, $querrydelete);


    echo '<script>alert("SUCCESSFULLY DELETED")</script>';
    echo '<script>window.location.href = "/PHPMICAY/Index.php"</script>';

}

?>

