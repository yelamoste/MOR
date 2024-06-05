<?php
include('../php/db_conn.php');

// Execute the query before rendering the HTML
$sql1 = "SELECT id, committee, thesis, response FROM committees";
$result1 = $db_conn->query($sql1);

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset($_POST["approved"])) {
        $id = $_POST['approved'];
        unset($_POST['approved']);

        $sql2 = "UPDATE committees SET response = 'Approved' WHERE id = ?";
        $stmt2 = $db_conn->prepare($sql2);
        $stmt2->bind_param("s", $id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        
    } elseif (isset($_POST["rejected"])){
        $id = $_POST['rejected'];
        unset($_POST['rejected']);

        $sql3 = "UPDATE committees SET response = 'Rejected' WHERE id = ?";
        $stmt3 = $db_conn->prepare($sql3);
        $stmt3->bind_param("s", $id);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
    }
    header("Location: admin4faculty2.php");
    die;
}
?>


<!DOCTYPE html>
<html>

<body>
    <form method="POST">
        <div>
            <p> Response to Title Proposal</p>
            <?php
            if ($result1->num_rows > 0) {
                // Output data of each row
                while ($row = $result1->fetch_assoc()) {
                    
                    $res = $row['response'];
                    $t_id = $row['id'];
                    $title = $row['thesis'];
                    echo "<p> ".$row['id']." </p>";


                    echo "<div class='proposal-container'>";
                    echo "<p>Response: " . htmlspecialchars($title) . "</p>";
                    echo "<p>Response: " . htmlspecialchars($res) . "</p>";
                    echo "<button type='submit' name='approved' value='$t_id'>Approved</button>";
                    echo "<button type='submit' name='rejected' value='$t_id'>Reject</button>";

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