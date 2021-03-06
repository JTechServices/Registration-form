<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'phpreg';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    // Could not get the data that should have been sent.
    exit('Please complete the registration form!');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.

    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        // Username already exists
        echo 'Username exists, please choose another!';
    } else {



       echo  $username = $_POST['username'];
       echo  $email = $_POST['email'];
        // $password = $_POST['password'];
        echo $password = $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // Username doesnt exists, insert new account


       echo  $sql = "INSERT INTO `accounts` ( `username`, `email`, `password`) VALUES ( '$username', '$email', '$password')";

        // insert in database
        $rs = mysqli_query($con, $sql);

            if ($rs) {
        echo "Contact Records Inserted";
    }


    }
    $stmt->close();
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    echo 'Could not prepare statement!';
}

$con->close();
?>
    
