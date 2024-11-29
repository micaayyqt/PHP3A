<?php
require('./Read.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOCUMENT</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <form action="Create.php" method="post"> 
        <h3>Crate User Info</h3>
        <input type= "text"  name="Fname" placeholder="Enter your FirstName" required/>
        <input type= "text"  name="Mname" placeholder="Enter your MiddleName" required/>
        <input type= "text"  name="Lname" placeholder="Enter your LastName" required/>
        <input type= "submit" name="create" value="CREATE" class="btn btn-primary"/>
        <button id="printButton" onclick="window.print()" class="btn btn-primary">PRINT</button>
    </form>

<br>





    <table class="table">
        <tr class="info">
            <th>ID</th>
            <th>FirstName</th>
            <th>MiddleName</th>
            <th>LastName</th>
            <th>Actions</th>
        </tr>
        <?php while($results = mysqli_fetch_array($sqlAccount)) { ?>
            <tr class="warning"> 
                <td><?php echo $results['ID']?></td>
                <td><?php echo $results['FirstName']?></td>
                <td><?php echo $results['MiddleName']?></td>
                <td><?php echo $results['LastName']?></td>

                <td>
                    <form action="Edit.php" method="post">
                        <input type="submit" name="edit" value="EDIT" class="btn btn-info" style="width: 80px;">
                        <input type="hidden" name="editID" value="<?php echo $results['ID'] ?>">
                        <input type="hidden" name="editF" value="<?php echo $results['FirstName'] ?>">
                        <input type="hidden" name="editM" value="<?php echo $results['MiddleName'] ?>">
                        <input type="hidden" name="editL" value="<?php echo $results['LastName'] ?>">
                    
                      
                    </form>
                    <form action="Delete.php" method="post">
                        <input type="submit" name="delete" value="DELETE" class="btn btn-primary"> 
                        <input type="hidden" name="deleteID" value="<?php echo $results['ID'] ?>">
                    </form>
                </td>
            </tr>

            <?php } ?>
    </table>
    </div>
</body>
</html>