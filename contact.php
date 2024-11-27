<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Contact Details</title>
</head>

<body bgcolor="#CCFFFF" text="#660099">
    <?php
    $self = $_SERVER['PHP_SELF'];
    $dbh = new mysqli("localhost", "root", "", "contactDB");

    // Check connection
    if ($dbh->connect_error) {
        die("Connection failed: " . $dbh->connect_error);
    }

    if (isset($_POST['submit'])) {
        $nme = $dbh->real_escape_string($_POST['name']);
        $ad1 = $dbh->real_escape_string($_POST['add1']);
        $ad2 = $dbh->real_escape_string($_POST['add2']);
        $eml = $dbh->real_escape_string($_POST['email']);

        if ($nme != "" && $ad1 != "") {
            // Corrected variable names in the query
            $query = "INSERT INTO contact (name, add1, add2, email) VALUES ('$nme', '$ad1', '$ad2', '$eml')";
            if ($dbh->query($query) === TRUE) {
                header("Location: menu.html");
                die();
            } else {
                echo "<p>Error: " . $query . "<br>" . $dbh->error . "</p>";
            }
        } else {
            echo "<p>One of the required fields is empty!</p>";
        }
    }

    $dbh->close();
    ?>

    <form action="<?= $self ?>" method="POST">
        <h1>Enter the Contact Details</h1>
        <p>Go to <a href="menu.html">Menu</a></p>
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" required />*</td>
            </tr>
            <tr>
                <td>Address Line 1</td>
                <td><input type="text" name="add1" required />*</td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td><input type="text" name="add2" /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="SUBMIT" />
                    <input type="hidden" name="submit" value="yes" />
                </td>
            </tr>
        </table>
        <p style="font-style:italic;color:blue">*Required Fields</p>
    </form>
</body>

</html>
