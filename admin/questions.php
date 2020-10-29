<?php
include('../config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}
else{
    $username = ucfirst($_SESSION['username']);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = 'DELETE FROM questions WHERE id = "'.$id.'"';
    $run = mysqli_query($conn, $delete);
    if (!run) {
        echo "Some error occured! ".mysqli_error($conn);
    }
}
include('header.php');
?>

    <div class="questions">
        <a href="addquestions.php" style="float:right;"><button>Add Question</button></a>
        <h2>All Questions</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Question</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Right Answer</th>
                <th>Question Type</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
            $qry = "SELECT * FROM questions";
            $run = mysqli_query($conn, $qry);
            if (mysqli_num_rows($run)>0) {
                while ($data = mysqli_fetch_assoc($run)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['question']; ?></td>
                        <td><?php echo $data['option 1']; ?></td>
                        <td><?php echo $data['option 2']; ?></td>
                        <td><?php echo $data['option 3']; ?></td>
                        <td><?php echo $data['option 4']; ?></td>
                        <td><?php echo $data['answer']; ?></td>
                        <td><?php echo $data['test_type']; ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <input type="submit" name="delete" value="Delete" style="background-color:transparent;color:white;">
                            </form>
                        </td>
                        <td><a href="updatequestion.php?id=<?php echo $data['id']; ?>"><button style="background-color:transparent;color:white;">Edit</button></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</body>
</html>