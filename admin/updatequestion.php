<?php
include('../config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}
$errors = array();
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];
    $type = $_POST['type'];
    $update = 'UPDATE questions SET `question` = "'.$question.'", `answer` = "'.$answer.'", `option 1` = "'.$option1.'", `option 2` = "'.$option2.'", `option 3` = "'.$option3.'", `option 4` = "'.$option4.'", `test_type` = "'.$type.'" WHERE id = "'.$id.'"';
    $qry = mysqli_query($conn, $update);
    if (!$qry) {
        die("Some error occured! ".mysqli_error($conn));
    } else {
        header("location: questions.php");
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
            <?php
            $id = $_GET['id'];
            $fetch = 'SELECT * FROM questions WHERE id = "'.$id.'"';
            $run = mysqli_query($conn, $fetch);
            if (mysqli_num_rows($run)>0) {
                $data = mysqli_fetch_assoc($run);
                ?>
                <form action="" method="POST">
                    <p>
                        <label for="username"><span>Question: </span><input type="text" name="question" value="<?php echo $data['question']; ?>" required></label>
                    </p>
                    <p>
                        <label for="option 1"><span>Option 1: </span><input type="text" name="option1" value="<?php echo $data['option 1']; ?>" required></label>
                    </p>
                    <p>
                        <label for="option 2"><span>Option 2: </span><input type="text" name="option2" value="<?php echo $data['option 2']; ?>" required></label>
                    </p>
                    <p>
                        <label for="option 3"><span>Option 3: </span><input type="text" name="option3" value="<?php echo $data['option 3']; ?>" required></label>
                    </p>
                    <p>
                        <label for="option 4"><span>Option 4: </span><input type="text" name="option4" value="<?php echo $data['option 4']; ?>" required></label>
                    </p>
                    <p>
                        <label for="answer"><span>Right Answer: </span>
                            <select name="answer" class="role" required style="width: 175px; padding: 1px;">
                                <option value="">Select</option>
                                <option value="1" <?php if ($data['answer'] == 1) { echo 'selected="selected"'; } ?>>Option 1</option>
                                <option value="2" <?php if ($data['answer'] == 2) { echo 'selected="selected"'; } ?>>Option 2</option>
                                <option value="3" <?php if ($data['answer'] == 3) { echo 'selected="selected"'; } ?>>Option 3</option>
                                <option value="4" <?php if ($data['answer'] == 4) { echo 'selected="selected"'; } ?>>Option 4</option>
                            </select>
                        </label>
                    </p>
                    <p>
                        <label for="type"><span>Question Type: </span>
                            <select name="type" class="role" required style="width: 175px; padding: 1px;">
                                <option value="">Select</option>
                                <option value="html" <?php if ($data['test_type'] == "html") { echo 'selected="selected"'; } ?>>HTML</option>
                                <option value="css" <?php if ($data['test_type'] == "css") { echo 'selected="selected"'; } ?>>CSS</option>
                                <option value="javascript" <?php if ($data['test_type'] == "javascript") { echo 'selected="selected"'; } ?>>Javascript</option>
                                <option value="php" <?php if ($data['test_type'] == "php") { echo 'selected="selected"'; } ?>>PHP</option>
                            </select>
                        </label>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Update">
                    </p>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>