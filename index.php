    <?php
    include_once 'langs.php';
    include "functions.php";
    include "head.php";
    ?>
            <!-- Facebook page widget -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <!-- #Facebook widget -->

        <?php
        include 'menu_bar.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?php
                    include 'carousel.php';
                    ?>
                </div> 
                <div class="col-lg-3">
                    <div class="row-fluid chemis-row-list">
                        <?php
                        include 'news_feed.php';
                        ?>
                    </div>
                    <div class="row-fluid chemis-row-list hidden-sm">
                        <div class="fb-like" data-href="http://www.facebook.com/chemisproject" data-width="250" data-show-faces="true" data-send="true"></div>
                    </div>
                    <div class="row-fluid chemis-row-list hidden-sm">
                        <!-- VK Widget -->
                        <div id="vk_groups"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 0, width: "270", height: "180", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 56278271);
                        </script>
                    </div>
                    
                </div>
            </div>
        </div>         
        <?php
        include 'foot.php';
        ?>
    </body>
</html>
