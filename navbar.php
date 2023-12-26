<link rel="stylesheet" href="./layout/styles/index.css">

<body id="top">
    <div class="topspacer bgded overlay" style="background-image:url('images/backgrounds/backgroundnvida.jpg');">

        <div class="wrapper row1">
            <header id="header" class="hoc clear">

                <div id="logo" class="fl_left">
                    <h1><a href="index.php">Yoffa</a></h1>
                </div>

                <nav id="mainav" class="fl_right">
                    <ul class="clear">
                        <?php
                        if (!isset($_SESSION['username'])) {
                        ?>
                        <?php
                        }
                        ?>
                        <li>
                            <?php
                            if (!isset($_SESSION['username'])) {
                            ?>
                                <a href="login.php">Đăng nhập</a>
                            <?php
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (!isset($_SESSION['username'])) {
                            ?>
                                <a href="register.php">Đăng ký</a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="infomation_user">
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            }
                            ?>
                            <ul>
                                <li><a href="./information_user.php">Thông tin người dùng</a></li>
                            </ul>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['username'])) {
                            ?>
                                <a href="index.php?logout=1">Đăng xuất</a>
                                <!-- <a href="./logout.php">Đăng xuất</a> -->
                            <?php
                            }
                            ?>
                        </li>
                        <li>
                            <div id="cart-icon">
                                <a data-fancybox data-type="ajax" data-src="./ajax-cart.php" href="javascript:;">
                                    <i class="fa-solid fa-cart-shopping fa-2x"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>