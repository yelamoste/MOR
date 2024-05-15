<?php
include('../php/db_conn.php');

// Execute the query before rendering the HTML
$sql1 = "SELECT id, title, time_stamp, status FROM title_proposals";
$result1 = $db_conn->query($sql1);

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset($_POST["approved"])) {
        $id = $_POST['approved'];
        unset($_POST['approved']);

        $sql2 = "UPDATE title_proposals SET status = 'Approved' WHERE id = ?";
        $stmt2 = $db_conn->prepare($sql2);
        $stmt2->bind_param("s", $id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        
    } elseif (isset($_POST["rejected"])){
        $id = $_POST['rejected'];
        unset($_POST['rejected']);

        $sql3 = "UPDATE title_proposals SET status = 'Rejected' WHERE id = ?";
        $stmt3 = $db_conn->prepare($sql3);
        $stmt3->bind_param("s", $id);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
    } elseif (isset($_POST["conditional"])){
        $id = $_POST['conditional'];
        unset($_POST['conditional']);
        
        $sql5 = "UPDATE title_proposals SET status = 'Conditional' WHERE id = ?";
        $stmt5 = $db_conn->prepare($sql5);
        $stmt5->bind_param("s", $id);
        $stmt5->execute();
        $result5 = $stmt5->get_result();
    } 
    header("Location: faculty.php");
    die;
}
?>


<!DOCTYPE html>
<html>

<body>
    <form method="POST">
        <div>
            <?php
            if ($result1->num_rows > 0) {
                // Output data of each row
                while ($row = $result1->fetch_assoc()) {
                    $title = $row['title'];
                    $time = $row['time_stamp'];
                    $status = $row['status'];
                    $t_id = $row['id'];
                    echo "<p> ".$row['id']." </p>";


                    echo "<div class='proposal-container'>";
                    echo "<p>Title: " . htmlspecialchars($title) . "</p>";
                    echo "<p>Time: " . htmlspecialchars($time) . "</p>";
                    echo "<p>Status: " . htmlspecialchars($status) . "</p>";
                    echo "<button type='submit' name='approved' value='$t_id'>Approved</button>";
                    echo "<button type='submit' name='rejected' value='$t_id'>Reject</button>";
                    echo "<button type='submit' name='conditional' value='$t_id'>Conditional</button>";
                    echo "</div><br>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </form>
</body>

</html>

<?php
$db_conn->close();
?>