<?php
include_once 'langs.php';
include "functions.php";
include 'head.php';
include 'menu_bar.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="well well-small" style="color:#800080;">
                    <h2><?php echo $lang['C_TITLE']; ?></h2>
                </div>
                <div style="font-size: large;">
                    <?php echo $lang['C_SLOGAN']; ?><br>
                    <hr>
                   <?php echo $lang['C_GUILHERME']; ?> <a href="mailto:guilhermecaldas@yandex.com">guilhermecaldas@yandex.com</a><br>
                    <hr>
                   <?php echo $lang['C_NIKITA']; ?> <br><a href="mailto:nik.pr2012@yandex.ru">nik.pr2012@yandex.ru</a>
                    <hr>
                    <?php echo $lang['C_ANA']; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <img src="img/biglogo.jpg" class="img-responsive" alt="Chemis team">
            </div>
        </div>
    </div>
    <?php
    include 'foot.php';
    ?>
</body>
</html>
