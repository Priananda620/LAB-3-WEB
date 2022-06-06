<header class="d-flex align-items-center justify-content-between">
    <div id="header-inner-left">
        <div class="logo">
            <a href="index.php">
                <h1 class="fw-bold d-flex align-items-center"><span><img src="assets/logo/logo48.png"></span>My Tutor</h1>
            </a>
        </div>
    </div>

    <?php
    if (isset($_SESSION['sessionId'])) {
    ?>
        <div id="header-nav">
            <ul class="d-inline-flex">
                <li><a href="index.php#view-subjects">courses</a></li>
                <li><a href="tutor.php#view-tutors">tutors</a></li>
                <li><a>subscription</a></li>
                <li><a>profile</a></li>
            </ul>
        </div>

        <div class="user-avatar-rounded me-2" style="background-image:url('assets/user_images/<?php echo $_SESSION['user_data']['username'] . "_" . $_SESSION['user_data']['user_image'] ?>')"></div>
    <?php
    } else {
    ?>

        <div id="header-nav" class="d-inline-flex align-items-center">
            <p class="mb-0 me-2">Login To View The Nav Menus</p>
            <a class="button me-2 login-show">Login</a>
        </div>

    <?php } ?>
    <div id="header-inner-right">
        <div class="dark-switch">
            <input id="dark-switch-input" type="checkbox" checked="">
            <label for="dark-switch-input"></label>
        </div>
    </div>
</header>