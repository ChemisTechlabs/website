<?php
include "functions.php";
include 'head.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel({interval: 5000});
    });
</script>
<body> 	   
    <?php
    include 'menu_bar.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 hidden-phone hidden-tablet">
                <?php
                    include 'carousel.php';
                ?>
            </div> 
            <div class="col-lg-4">
                <?php
                include "dbinit.php";

                $query = "SELECT * FROM `news`";
                $result = mysql_query($query);

                if (!$result) {
                    print "<center><br>ошибка:" . mysql_error() . "<br></center>";
                } elseif (mysql_num_rows($result) == 0) {
                    print "<center><div class=\"alert alert-error\">Новостей нет</div></center>\n";
                } else {
                    $rows = array();
                    while ($row = mysql_fetch_assoc($result)) {
                        $rows[] = $row;
                    }
                    $rows = array_reverse($rows);
                    foreach ($rows as $row) {
                        print "<div class=\"panel panel-info\"><div class=\"panel-heading\"><h3 class=\"panel-title\">{$row['date']}</h3></div><div style=\"color:#800080;\">{$row['text']}</div></div>";
                    }
                }
                ?>
            </div>  
        </div>
    </div>         
    <?php
    include 'foot.php';
    ?>
</body>
</html>