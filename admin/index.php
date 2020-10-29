<?php
include('../config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}
include('header.php');
?>
        <div class="welcome">
            <h1>Welcome <?php echo ucfirst($_SESSION['username']); ?>!</h1>
            <p>Hope you are doing fine...</p>
            <p>Here you can perform following operations</p>
            <ul>
                <li><a href="addquestions.php">Add Questions</a></li>
                <li><a href="questions.php">Manage Questions</a></li>
                <li><a href="users.php">Manage Users</a></li>
            </ul>
        </div>
    </div>
</body>
</html>