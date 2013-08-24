<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <nav class="navbar navbar-collapse navbar-fixed-top bs-docs-nav" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../"><img src="img/nav.png" class="img-responsive"></a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="divider-vertical"></li>
                <li><a href="downloads.php">Downloads</a></li>
                <li class="divider-vertical"></li>
                <li><a href="about.php">About</a></li>
                <li class="divider-vertical"></li>
                <li><a href="contact.php">Contact</a></li>       
            </ul>
            <ul class="nav navbar-nav navbar-right">  
                <?
                if (!isLoggedIn()) {
                    echo "<li class=\"dropdown\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Login / Register<b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"login.php\">Login</a></li>
                                    <li><a href=\"join.php\">Register</a></li>
                                </ul>
                          </li>";
                } else {
                    $adm_menu = "";
                    if (isAdmin()) {
                        $adm_menu = "<li><a href=\"admin\">Admin panel</a></li>";
                    }

                    echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">" . $user . "<b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"alpha.php\">Alpha test</a></li>
                                $adm_menu
                                <li><a href=\"edit.php\">Settings</a></li>
                                <li><a href=\"logout.php\">Exit</a></li>
                            </ul>
                          </li>";
                }
                ?>        
            </ul>
        </div>
    </nav>
</header>

