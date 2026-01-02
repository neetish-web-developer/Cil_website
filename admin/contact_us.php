<?php include 'header.php'; ?>

    <div class="main-content">
      
        <?php
        include('connection.php');
        $sql = "SELECT * FROM contact";
        $result = $conn->query($sql);
        ?>

        <h1>Contact Us Data</h1>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['f_name']."</td>";
                    echo "<td>".$row['l_name']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['mobile']."</td>";
                    echo "<td>".$row['message']."</td>";
                    echo "<td><a href='delete2.php?id=".$row['id']."&table=contact&redirect=contact_us.php'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            ?>
        </table>
        <?php include 'footer.php'; ?>
    </div>
    
</body>
</html>
