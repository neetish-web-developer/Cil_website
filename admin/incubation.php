<?php 
include 'header.php';
include('connection.php');

/* =========================
   HANDLE OPEN / CLOSE ACTION
========================= */
if (isset($_GET['action'])) {

    // ✅ get admin name from session (same as newsletters)
    $updated_by = $_SESSION['admin_username'];

    if ($_GET['action'] === 'open') {
        $stmt = $conn->prepare(
            "UPDATE incubation_settings 
             SET application_status='OPEN', updated_by=? 
             WHERE id=1"
        );
        $stmt->bind_param("s", $updated_by);
        $stmt->execute();
    }

    if ($_GET['action'] === 'close') {
        $stmt = $conn->prepare(
            "UPDATE incubation_settings 
             SET application_status='CLOSED', updated_by=? 
             WHERE id=1"
        );
        $stmt->bind_param("s", $updated_by);
        $stmt->execute();
    }

    header("Location: incubation.php");
    exit;
}


/* =========================
   FETCH APPLICATION STATUS
========================= */
$statusResult = $conn->query("SELECT application_status FROM incubation_settings WHERE id=1");
$statusRow = $statusResult->fetch_assoc();
$applicationStatus = $statusRow['application_status'];

/* =========================
   FETCH APPLICATION DATA
========================= */
$sql = "SELECT * FROM incubation ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="main-content">

    <h1>Incubation Applications</h1>

    <!-- APPLICATION STATUS CONTROL -->
    <div style="margin-bottom:20px; padding:15px; border:1px solid #ccc; background:#f9f9f9;">
        <strong>Application Status:</strong>

        <?php if ($applicationStatus === 'OPEN') { ?>
            <span style="color:green; font-weight:bold;">OPEN</span>
            <a href="?action=close" 
               style="margin-left:15px; color:white; background:red; padding:6px 12px; text-decoration:none; border-radius:4px;">
               Close Applications
            </a>
        <?php } else { ?>
            <span style="color:red; font-weight:bold;">CLOSED</span>
            <a href="?action=open" 
               style="margin-left:15px; color:white; background:green; padding:6px 12px; text-decoration:none; border-radius:4px;">
               Open Applications
            </a>
        <?php } ?>
    </div>

    <!-- APPLICATION TABLE -->
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Registered Company</th>
            <th>Investment Received</th>
            <th>No. of Co-founders</th>
            <th>Proposal</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['mobile']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['reg_company']}</td>";
                echo "<td>{$row['inv_received']}</td>";
                echo "<td>{$row['co_founder']}</td>";
                echo "<td>{$row['proposal']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>
                        <a href='delete2.php?id={$row['id']}&table=incubation&redirect=incubation.php'
                           onclick=\"return confirm('Are you sure you want to delete this application?');\">
                           Delete
                        </a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9' style='text-align:center;'>No applications found</td></tr>";
        }
        ?>
    </table>
    <?php include 'footer.php'; ?>
</div>


