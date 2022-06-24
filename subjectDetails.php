<?php session_start();
if (!isset($_GET['subId'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tutor | Priananda </title>

    <?php include("component/headLinks.php") ?>
</head>

<body>
    <?php include("component/overlayLoginRegister.php") ?>
    <div id="full-page-container">
        

        <?php include("component/headerFixed.php") ?>



        <?php
        require_once 'api/db_config.php';

        $subId = $_GET['subId'];
        

        $sqlcnt = new mysqli($db_host, $db_username, $db_password, $db_name);


        $sql = "SELECT * FROM tbl_subjects JOIN tbl_tutors ON tbl_subjects.tutor_id = tbl_tutors.tutor_id  WHERE md5(tbl_subjects.subject_id) = '$subId' LIMIT 1";

        $query = $sqlcnt->query($sql);
        $row = $query->fetch_assoc();
        ?>
<!-- 
        <section id="subject-details" class="pb-0 mb-5" style="padding: 8em 15em;">
            <h2>Subject details</h2>
        </section> -->

        <section class="d-flex justify-content-center">
            <div class="d-inline-flex" id="subject-details-wrap" style="width: 70%">
                <?php

                if (!empty($row)) {
                    do {
                ?>
                        <div class="d-flex flex-column" id="subject-details-outter">
                            <div class="d-inline-flex" id="subject-details-bytutor" style="background-image:url('assets/tutors/<?php echo $row['tutor_id']?>.jpg')">

                                <a href="" class="d-inline-flex align-items-center">
                                    <div class="user-avatar-rounded" style="background-image:url('assets/tutors/<?php echo $row['tutor_id']?>.jpg')"></div>
                                    <div class="tutor-data mx-2">
                                        <h4><span class="unfocus-text">by&nbsp;</span><?php echo $row['tutor_name'] ?></h4>
                                        <div class="d-inline-flex my-2">
                                            <div class="subject-tiny-rounded"><?php echo $row['subject_rating']?>&nbsp;<i class="fa-solid fa-star"></i></div>
                                            <div class="subject-tiny-rounded"><?php echo $row['subject_sessions']?>&nbsp;sessions</div>
                                            <div class="subject-tiny-rounded">RM&nbsp;<?php echo $row['subject_price']?></div>
                                        </div>
                                        
                                        <!-- <p class="unfocus-text"><?php //echo $row['subject_rating']?>&nbsp;<i class="fa-solid fa-star"></i></p> -->
                                    </div>
                                </a>
                                <div style="margin-left: auto">
                                    <div class="hamburger-quora">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24">
                                            <g id="overflow" class="icon_svg-stroke" stroke-width="1.5" stroke="#666" fill="none" fill-rule="evenodd">
                                                <path d="M5,14 C3.8954305,14 3,13.1045695 3,12 C3,10.8954305 3.8954305,10 5,10 C6.1045695,10 7,10.8954305 7,12 C7,13.1045695 6.1045695,14 5,14 Z M12,14 C10.8954305,14 10,13.1045695 10,12 C10,10.8954305 10.8954305,10 12,10 C13.1045695,10 14,10.8954305 14,12 C14,13.1045695 13.1045695,14 12,14 Z M19,14 C17.8954305,14 17,13.1045695 17,12 C17,10.8954305 17.8954305,10 19,10 C20.1045695,10 21,10.8954305 21,12 C21,13.1045695 20.1045695,14 19,14 Z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>

                            </div>


                            <h2 class="my-4"><?php echo $row['subject_name'] ?></h2>

                            <p class="mb-5"><?php echo $row['subject_description'] ?></p>
                            <img style="width: 50%" src="assets/courses/<?php echo $row['subject_id']?>.jpg">
                            <div class="d-flex my-4 align-items-center">
                                <div>10 enrolled</div>
                                <div class="spacer-left mx-2" style="height: 1em; background: rgb(0, 0, 168)"></div>
                                <?php if(isset($_SESSION['sessionId'])){?>
                                    <a class="button"><i class="fa-solid fa-angles-right"></i>&nbsp;&nbsp;Enroll Now</a>
                                <?php } else {?>
                                    <a class="button login-show"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;login to enroll</a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php
                    } while ($row = $query->fetch_assoc());

                    ?>

                <div style="width: 350px;" class="">
                    <h4>Related Courses</h4>
                    <div style="width: 100%; height: 50em; border: 1px solid grey">

                    </div>
                </div>

            </div>
        <?php } ?>
        </section>

        <?php include("component/footer.php") ?>

    </div>
</body>

</html>