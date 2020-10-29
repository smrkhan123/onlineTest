<?php
include('config.php');
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
}
$test = $_GET['id'];
include('header.php');
?>
    <div class="test">
    <form action="result.php?id=<?php echo $test; ?>" method="POST">
        <h1><?php echo strtoupper($test); ?> TEST</h1>
        <?php 
        $fetch = 'SELECT * FROM questions WHERE test_type = "'.$test.'"';
        $run = mysqli_query($conn, $fetch);
        $rows = mysqli_num_rows($run);
        if ($rows>0) {
            $i = 1;
            while ($data=mysqli_fetch_assoc($run)) {
                if ($i==1) {
                    ?>
                    <div id='question<?php echo $i; ?>' class='cont'>
                        <h2 class='ques' id="qname<?php echo $i; ?>"><?php echo $i.'. '; ?><?php echo $data['question'];?></h2>
                        <input type="text" value="<?php echo $data['id']; ?>" name='<?php echo 'ques'.$i; ?>' style="display:none;"/>
                        <input type="radio" value="1" name='<?php echo $i; ?>'/><?php echo $data['option 1']; ?><br>
                        <input type="radio" value="2" name='<?php echo $i; ?>'/><?php echo $data['option 2']; ?><br>
                        <input type="radio" value="3" name='<?php echo $i; ?>'/><?php echo $data['option 3']; ?><br>
                        <input type="radio" value="4" name='<?php echo $i; ?>'/><?php echo $data['option 4']; ?><br>
                        <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $data['id']; ?>' name='<?php echo $i; ?>'/><br/> 
                        <button id='<?php echo $i; ?>' class='next' type='button'>Next</button>
                    </div>
                    <?php $i++;
                } elseif (($i > 1) && ($i < $rows)) {
                    ?>
                    <div id='question<?php echo $i; ?>' class='cont'>
                        <h2 class='ques' id="qname<?php echo $i; ?>"><?php echo $i.'. '; ?><?php echo $data['question'];?></h2>
                        <input type="text" value="<?php echo $data['id']; ?>" name='<?php echo 'ques'.$i; ?>' style="display:none;"/>
                        <input type="radio" value="1" name='<?php echo $i; ?>'/><?php echo $data['option 1']; ?><br>
                        <input type="radio" value="2" name='<?php echo $i; ?>'/><?php echo $data['option 2']; ?><br>
                        <input type="radio" value="3" name='<?php echo $i; ?>'/><?php echo $data['option 3']; ?><br>
                        <input type="radio" value="4" name='<?php echo $i; ?>'/><?php echo $data['option 4']; ?><br>
                        <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $data['id']; ?>' name='<?php echo $i; ?>'/><br/> 
                        <button id='<?php echo $i; ?>' class='previous' type='button'>Previous</button>
                        <button id='<?php echo $i; ?>' class='next' type='button'>Next</button>
                    </div>
                    <?php $i++;
                } elseif ($i == $rows) {
                    ?>
                    <div id='question<?php echo $i; ?>' class='cont'>
                        <h2 class='ques' id="qname<?php echo $i; ?>"><?php echo $i.'. '; ?><?php echo $data['question'];?></h2>
                        <input type="text" value="<?php echo $data['id']; ?>" name='<?php echo 'ques'.$i; ?>' style="display:none;"/>
                        <input type="radio" value="1" name='<?php echo $i; ?>'/><?php echo $data['option 1']; ?><br>
                        <input type="radio" value="2" name='<?php echo $i; ?>'/><?php echo $data['option 2']; ?><br>
                        <input type="radio" value="3" name='<?php echo $i; ?>'/><?php echo $data['option 3']; ?><br>
                        <input type="radio" value="4" name='<?php echo $i; ?>'/><?php echo $data['option 4']; ?><br>
                        <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $data['id']; ?>' name='<?php echo $i; ?>'/><br/> 
                        <button id='<?php echo $i; ?>' class='previous' type='button'>Previous</button>
                        <input type="submit" name="finish" value="Finish">
                    </div>
                    <?php $i++;
                }
            }
        } else {
                header("location: dashboard.php");
            }
        ?>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('.cont').addClass('hide');
        count=$('.questions').length;
        console.log(count);
         $('#question'+1).removeClass('hide');
         
         $(document).on('click','.next',function(){
             last=parseInt($(this).attr('id')); 
             console.log(last);   
             nex=last+1;
             console.log(nex);
             $('#question'+last).addClass('hide');
             
             $('#question'+nex).removeClass('hide');
         });
         
         $(document).on('click','.previous',function(){
             last=parseInt($(this).attr('id'));     
             pre=last-1;
             $('#question'+last).addClass('hide');
             
             $('#question'+pre).removeClass('hide');
         }); 
    </script>
</body>
</html>