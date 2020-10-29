<?php
include('config.php');

session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}

$user_answer = array();
$right_answer = array();
$true = array();
$false = array();
$incomplete = array();

if (isset($_POST['finish'])) {
    $id = $_GET['id'];
    $qry = 'SELECT * FROM questions WHERE test_type = "'.$id.'"';
    $run = mysqli_query($conn, $qry);
    $rows = mysqli_num_rows($run);
    if ($rows>0) {
        while ($data = mysqli_fetch_assoc($run)) {
            for ($i=1; $i<=$rows; $i++) {
                if ($_POST['ques'.$i] == $data['id']) {
                    array_push($user_answer, $_POST[$i]);
                }
            }
            array_push($right_answer, $data['answer']);
        }
    }
    for ($i=0;$i<sizeof($user_answer);$i++) {
        if ($user_answer[$i] == $right_answer[$i]) {
            array_push($true, $user_answer[$i]);
        } elseif ($user_answer[$i] == 5) {
            array_push($incomplete, $user_answer[$i]);
        } else {
            array_push($false, $user_answer[$i]);
        }
    }
} else {
    header("location: dashboard.php");
}

include('header.php');
?>
    <div class="test_main">
        <h1>RESULT</h1>
        <h2 style="<?php if (sizeof($true)>5) { echo 'color:green;'; } else { echo 'color:red;'; } ?>">
            <?php 
            if (sizeof($true)>5) {
                echo "Passed!";
            } else {
                echo "Failed!";
            }
            ?>
        </h2>
        <h2>Right Answer/s</h2>
        <p><strong><?php echo sizeof($true); ?></strong></p>
        <h2>Wrong Answer/s</h2>
        <p><strong><?php echo sizeof($false); ?></strong></p>
        <h2>Not Attempted </h2>
        <p><strong><?php echo sizeof($incomplete); ?></strong></p>
    </div>
</body>
</html>
