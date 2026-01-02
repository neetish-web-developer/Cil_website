<?php include 'header.php'; ?>

    <div class="main-content">
      
        <?php
        include('connection.php');
        $sql = "SELECT * FROM incubation";
        $result = $conn->query($sql);
        ?>

        <h1>Incubation Applications</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Registered Company</th>
                <th>Investment Received</th>
                <th>Number of Co-founders</th>
                <th>Proposal</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['mobile']."</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "<td>".$row['reg_company']."</td>";
                    echo "<td>".$row['inv_received']."</td>";
                    echo "<td>".$row['co_founder']."</td>";
                    echo "<td>".$row['proposal']."</td>";
                    echo "<td><a href='delete2.php?id=".$row['id']."&table=incubation&redirect=incubation.php'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No applications found</td></tr>";
            }
            ?>
        </table>
        <?php include 'footer.php'; ?>
    </div>
    
</body>

</html>
