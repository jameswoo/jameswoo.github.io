<!DOCTYPE HTML>
<html>

<head>
    <title>Customer Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Read Customer</h1>
        </div>

        <?php
        
        echo $username;
        include 'config/database.php';

        try {
            $username = isset($_GET['username']) ? $_GET['username'] : die('ERROR: Customer record not found.');
            $query = "SELECT * FROM customers WHERE username = :username";
            $stmt = $con->prepare($query);
            
            $stmt->bindParam(':username', $username);
            
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($stmt);
            $username = $row['username'];
            $password = $row['password'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $gender = $row['gender'];
            $dateOfBirth = $row['dateOfBirth'];
            $regdDateNTime = $row['regdDateNTime'];
            $accountStatus = $row['accountStatus'];
            
        } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Username</td>
                <td><?php echo htmlspecialchars($username, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>password</td>
                <td><?php echo htmlspecialchars($password, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><?php echo htmlspecialchars($firstName, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><?php echo htmlspecialchars($lastName, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?php echo htmlspecialchars($gender, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Date Of Birth</td>
                <td><?php echo htmlspecialchars($dateOfBirth, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Registration Date and Time</td>
                <td><?php echo htmlspecialchars($regdDateNTime, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php echo htmlspecialchars($accountStatus, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='customer_list.php' class='btn btn-danger'>Back to customer list</a>
                </td>
            </tr>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>