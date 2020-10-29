<?php
include('../config.php');
session_start();
if(!isset($_SESSION['id'])){
    header('location: ../index.php');
}
else{
    $username = ucfirst($_SESSION['username']);
}
include('header.php');
?>

    <div class="welcome" style="width: 700px;">
        <h2>All Users</h2>
        <div>
        <table border="1" style="margin: 0 auto; width:100%;">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <!-- <th colspan="2">Action</th> -->
            </tr>
            <?php
                $qry = "SELECT * FROM users";
                $run = mysqli_query($conn, $qry);
                if(mysqli_num_rows($run)>0){
                    while($data = mysqli_fetch_assoc($run)){
                        ?>
                            <tr>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['role']; ?></td>
                                <!-- <td><a href="deleteuser.php">Delete</a></td>
                                <td><a href="edituser.php">Edit</a></td> -->
                            </tr>
                        <?php
                    }
                }
            ?>
        </table>
        </div>
        
    </div>
</body>
</html>