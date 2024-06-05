<?php
include('../php/db_conn.php');

// Fetch thesis and related data
$sql7 = "SELECT tb.id, tb.title_proposal_id, t.title, t.filename, t.status, tb.research_adviser, f.id AS faculty_id, f.faculty_name
          FROM thesis_basic_info AS tb
          JOIN title_proposals AS t ON tb.title_proposal_id = t.id
          JOIN faculty_users AS f ON tb.research_adviser = f.id";

$result7 = $db_conn->query($sql7);

$rows = 0;
$uid = '';
$title = '';
$filename = '';
$status = '';
$researchadv = '';

if ($result7->num_rows > 0) {
    while ($row = $result7->fetch_assoc()) {
        $rows++;
        
        $title = $row['title'];
        $filename = $row['filename'];
        $status = $row['status'];
        $researchadv = $row['faculty_name'];
    }
}

// Fetch all faculty members
$sql8 = "SELECT * FROM faculty_users";
$result8 = $db_conn->query($sql8);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Upload Form</title>
</head>
<body>
    <form method="post">
        <?php
        if ($result8->num_rows > 0) {
            while ($row = $result8->fetch_assoc()) {
                $id = $row['id'];
                $faculty_name = $row['faculty_name'];

                // Disabling the research adviser as a committee member
                $isDisabled = ($faculty_name == $researchadv) ? 'disabled' : '';
                echo $title;

                echo '<div class="committee-option">
                      <input type="checkbox" name="committeesel[]" value="' . $id . '" class="committee-checkbox" id="committee' . $id . '" ' . $isDisabled . '>
                      <label for="committee' . $id . '">' . $faculty_name . '</label></div>';
            }
        } else {
            echo "No faculty available";
        }
        ?>

        <button class="details-action-submit" name="committee-submit">Submit</button>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["committee-submit"])) {
        $thesis_id_result = $db_conn->query("SELECT id FROM thesis_basic_info LIMIT 1");
        if ($thesis_id_result && $thesis_id_result->num_rows > 0) {
            $thesis_row = $thesis_id_result->fetch_assoc();
            $thesis_id = $thesis_row['id'];
        } else {
            die("Could not retrieve thesis id");
        }

        // Prepare the insert statement
        $sql = $db_conn->prepare("INSERT INTO committees (committee, thesis) VALUES (?, ?)");
        if (!$sql) {
            die("Prepare failed: " . $db_conn->error);
        }

        // Loop through selected checkboxes and insert them into the database
        foreach ($_POST['committeesel'] as $selectedCommittee) {
            $sql->bind_param("ii", $selectedCommittee, $thesis_id);
            if (!$sql->execute()) {
                echo "Error: " . $sql->error;
            }
        }

        $sql->close();
        $db_conn->close();

        // Redirect to a confirmation page or the form page
        // header("Location: index.php");
    }
}
?>
