<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Display games here...
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "softball";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "select * from games";
        $result = $conn->query($sql);
        ?>
        <table border="1">
            <tr>
                <th>Opponent</th>
                <th>Site</th>
                <th>Result</th>
            </tr>
        <?php    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['opponent'] . "</td>";
                echo "<td>" . $row['site'] . "</td>";
                echo "<td>" . $row['result'] . "</td>"; 
                echo "</tr>";
            }
        }
        else {
            echo "0 results";
        }
        

        $conn->close();
        ?>
        </table>
        <a href="index.php">Main Menu</a>
    </body>
</html>
