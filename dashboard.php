<?php
include('config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
} else {
    
}
include('header.php');
?>
        <div class="welcome">
            <h1>Welcome <?php echo ucfirst($_SESSION['username']); ?>!</h1>
            <p>Hope you are doing fine...</p>
            <p>Choose the test and start doing</p>
            <ul id='list'>
                <li><a href="test.php?id=html">HTML</a></li>
                <li><a href="test.php?id=css">CSS</a></li>
                <li><a href="test.php?id=javascript">JAVASCRIPT</a></li>
                <li><a href="test.php?id=php">PHP</a></li>
            </ul>
        </div>
    </div>
</body>
</html>