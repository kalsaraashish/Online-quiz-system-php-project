<?php
session_start();
include "../conn.php";
$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$count = 0;
$ans = "";

$queno = $_GET["questionno"];
if (isset($_SESSION["answer"][$queno])) {
    $ans = $_SESSION["answer"][$queno];

}
$check = mysqli_query($con, "select * from questions where category='$_SESSION[exam_category]' && question_no='" . $queno . "'");
$count = mysqli_num_rows($check);
if ($count == 0) {
    echo "over";
} else {
    while ($row = mysqli_fetch_array($check)) {
        $question_no = $row["question_no"];
        $question = $row["question"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"];

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/deshbord.css">
        <title>deshbord</title>
    </head>

    <body>
        <div class="main-con">
            <div class="ex-display">

                <div class="qustion"><?php echo "(" . $question_no . ")" . $question; ?></div>
                <div class="opt">
                    <div class="opt-gap" id="load_questions">
                        <input type="radio" name="r1" value="<?php echo $opt1; ?>"
                            onclick="radioclick(this.value,<?php echo $question_no ?>)" <?php
                               if ($ans == $opt1) {
                                   echo "checked";
                               }
                               ?>>
                        <label><?php echo $opt1; ?></label>
                    </div>
                    <div class="opt-gap" id="load_questions">
                        <input type="radio" name="r1" value="<?php echo $opt2; ?>"
                            onclick="radioclick(this.value,<?php echo $question_no ?>)" <?php
                               if ($ans == $opt2) {
                                   echo "checked";
                               }
                               ?>>
                        <label><?php echo $opt2; ?></label>
                    </div>
                    <div class="opt-gap" id="load_questions">
                        <input type="radio" name="r1" value="<?php echo $opt3; ?>"
                            onclick="radioclick(this.value,<?php echo $question_no ?>)" <?php
                               if ($ans == $opt3) {
                                   echo "checked";
                               }
                               ?>>
                        <label><?php echo $opt3; ?></label>
                    </div>
                    <div class="opt-gap" id="load_questions">
                        <input type="radio" name="r1" value="<?php echo $opt4; ?>"
                            onclick="radioclick(this.value,<?php echo $question_no ?>)" <?php
                               if ($ans == $opt4) {
                                   echo "checked";
                               }
                               ?>><label><?php echo $opt4; ?></label>
                    </div>
                </div>
            </div>
    </body>

    </html>
    <?php
}
?>
