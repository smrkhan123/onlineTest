<?php
include('../config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

$errors = array();

if (isset($_POST['submit'])) {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];
    $type = $_POST['type'];

    $fetch = "SELECT * FROM questions";
    $run = mysqli_query($conn, $fetch);
    if (mysqli_num_rows($run)>0) {
        $flag = 0; 
        while ($data = mysqli_fetch_assoc($run)) {
            if ($data['question']==$question) {
                $errors[] = array('input'=>'question', 'msg'=>'Question already exists'); 
                $flag = 1;
            }
        }
        if ($flag == 0) {
            $insert = 'INSERT INTO questions(`question`,`answer`,`option 1`,`option 2`,`option 3`,`option 4`,`test_type`) VALUES("'.$question.'","'.$answer.'","'.$option1.'","'.$option2.'","'.$option3.'","'.$option4.'","'.$type.'")';
            $qry = mysqli_query($conn, $insert);
            if (!$qry) {
                die("Some error occured! ".mysqli_error($conn));
            } else {
                header("location: questions.php");
            }
        }
    } else {
        $insert = 'INSERT INTO questions(`question`,`answer`,`option 1`,`option 2`,`option 3`,`option 4`,`test_type`) VALUES("'.$question.'","'.$answer.'","'.$option1.'","'.$option2.'","'.$option3.'","'.$option4.'","'.$type.'")';
        $qry = mysqli_query($conn, $insert);
        if (!$qry) {
            die("Some error occured! ".mysqli_error($conn));
        } else {
            header("location: questions.php");
        }
    }
}

include('header.php');
?>
        <div id="signup-form" style="margin:50px auto; width:700px;">
        
            <h2>Add Question Here</h2>
            <div id="errors">
                <?php if (sizeof($errors)>0) : ?>
                    <ul>
                        <?php foreach ($errors as $error):?>
                            <li><?php echo $error['msg']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <form action="" method="POST">
                <p>
                    <label for="username"><span>Question: </span><input type="text" name="question" required></label>
                </p>
                <p>
                    <label for="option 1"><span>Option 1: </span><input type="text" name="option1" required></label>
                </p>
                <p>
                    <label for="option 2"><span>Option 2: </span><input type="text" name="option2" required></label>
                </p>
                <p>
                    <label for="option 3"><span>Option 3: </span><input type="text" name="option3" required></label>
                </p>
                <p>
                    <label for="option 4"><span>Option 4: </span><input type="text" name="option4" required></label>
                </p>
                <p>
                    <label for="answer"><span>Right Answer: </span>
                        <select name="answer" class="role" required style="width: 175px; padding: 1px;">
                            <option value="">Select</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            <option value="4">Option 4</option>
                        </select>
                    </label>
                </p>
                <p>
                    <label for="type"><span>Question Type: </span>
                        <select name="type" class="role" required style="width: 175px; padding: 1px;">
                            <option value="">Select</option>
                            <option value="html">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">Javascript</option>
                            <option value="php">PHP</option>
                        </select>
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Add">
                </p>
            </form>
        </div>
    </div>
</body>
</html>