<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Search for Contact</title>
</head>

<body bgcolor="#CCFFFF" text="#660099">
    <h1>Search for Contacts</h1>
    <p>Go to <a href="menu.html">Menu</a></p>

    <!-- Form for search input -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
        Enter Name: <input type="text" name="name" required />
        <input type="submit" value="Search" />
    </form>

    <?php
    if (isset($_GET['name'])) {
        // Database connection
        $dbh = new mysqli("localhost", "root", "", "contactDB");

        // Check connection
        if ($dbh->connect_error) {
            die("Connection failed: " . $dbh->connect_error);
        }

        // Sanitize input and prepare the query
        $nme = $dbh->real_escape_string($_GET['name']);
        echo "<p>Searching for <b>" . htmlspecialchars($nme) . "</b>...</p>";

        $query = "SELECT * FROM contact WHERE name LIKE '%$nme%'";
        $result = $dbh->query($query);

        if ($result && $result->num_rows > 0) {
            // Display the results in a table
            echo '<table border="1" style="border-collapse:collapse; color:#404040">';
            echo '<tr>
                    <th>Name</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>E-mail</th>
                  </tr>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['add1']) . "</td>
                        <td>" . htmlspecialchars($row['add2']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                      </tr>";
            }
            echo '</table>';
        } else {
            echo "<p><b>No matches found...</b></p>";
        }

        // Free result and close connection
        if ($result) {
            $result->free();
        }
        $dbh->close();
    }
    ?>
</body>

</html>
