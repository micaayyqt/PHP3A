<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}

// Welcome message
$username = $_SESSION['username'];

// Link to picture.html with an image
$profilePicture = '<a href="kuromi.html" target="_blank"><img src="https://i.pinimg.com/originals/14/88/47/148847e9c3186f66875ab6afc59406dd.jpg" alt="Profile Picture" width="300" height="300"></a>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        @media print {
            #printButton {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: black; 
            border-radius: 8px;
            overflow: hidden;
        }

        li {
            display: inline;
        }

        li a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        li a:hover {
            background-color: #333; 
            color: white; 
        }


    </style>
</head>
<body>

<ul>
    <li><a href="#home">Home</a></li>
    <li><a href="Email.php">Email Notification</a></li>
    <li><a href="user.php">User</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="SMS_API.php">SMS API</a></li>
    <li><a href="Change_Password.php">Change Password</a></li><!-- Link to Change Password -->
    <li><a href="Logout.php">Log out</a></li>
</ul>

<h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
<p>You have successfully logged in.</p>

<h2>Your Profile Picture:</h2>

<!-- Display the profile picture -->
<?php echo $profilePicture; ?>

</body>
</html>


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