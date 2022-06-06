<?php session_start(); 
if(!isset($_SESSION['sessionId'])){
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
    <div id="full-page-container">

        <?php include("component/headerFixed.php") ?>

        <section id="view-tutors" class="pb-0" style="padding-top: 8em;">
            <h2>Our Tutors</h2>
        </section>
        <?php
        require_once 'api/db_config.php';
        $sqlcnt = new mysqli($db_host, $db_username, $db_password, $db_name);


        $view = 10;
        if (isset($_GET['page'])) {
            $active_page = $_GET['page'];
        } else {
            $active_page = 1;
        }
        $start = ($active_page - 1) * $view;
        $limit = " LIMIT $start, $view";

        $sql = "SELECT * FROM tbl_tutors";

        $query = $sqlcnt->query($sql . $limit);
        $row = $query->fetch_assoc();
        ?>

        <section class="pt-5">
            <div id="subjects-flex-wrapper">
                <?php
                do {
                ?>
                    <div class="subject-item">
                        <div>
                            <h3><?php echo $row['tutor_name'] ?></h3>

                            <p><?php echo $row['tutor_description'] ?></p>

                            <div class="d-flex flex-row">
                                <div class="subject-tiny-rounded"><?php echo $row['tutor_phone'] ?> <i class="fa-solid fa-phone"></i></div>
                                <div class="subject-tiny-rounded"><?php echo $row['tutor_email'] ?> <i class="fa-solid fa-envelope"></i></div>
                            </div>
                        </div>
                        <div class="subject-image">
                            <div style="background-image:url('assets/tutors/<?php echo $row['tutor_id'] ?>.jpg')"></div>
                        </div>

                    </div>
                <?php
                } while ($row = $query->fetch_assoc());

                $sqltotal = $sql;
                $qtotal = $sqlcnt->query($sqltotal);
                $total_data = $qtotal->num_rows;
                // echo "<h1>".$total_data."</h1>";
                $total_page = ceil($total_data / $view);
                ?>



            </div>
            <div class="page-selector-wrapper d-flex">
                <ul class="d-inline-flex">
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <?php if ($i == $active_page) { ?>
                            <li class="d-flex">
                                <p><strong><?php echo $i; ?></strong></p>
                            </li>
                        <?php } else { ?>
                            <li class="d-flex">
                                <a href="
							<?php if (isset($_GET['search-query'])) {
                                echo "?search-query=";
                                echo $_GET['search-query'];
                                echo "&";
                            } else if (isset($_GET['latest'])) {
                                echo "?latest=";
                                echo $_GET['latest'];
                                echo "&";
                            } else if (isset($_GET['non-answered'])) {
                                echo "?non-answered=";
                                echo $_GET['non-answered'];
                                echo "&";
                            } else {
                                echo "?";
                            }
                            ?>
							page=<?php echo $i . "#view-subjects"; ?>">

                                    <?php echo $i; ?>

                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </section>

        <?php include("component/footer.php") ?>

    </div>
</body>

</html>