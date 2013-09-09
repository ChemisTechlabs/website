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
                <li><a href="index.php"><?php echo $lang['MENU_HOME']; ?></a></li>
                <li class="divider-vertical"></li>
                <li><a href="downloads.php"><?php echo $lang['MENU_DOWNLOADS']; ?></a></li>
                <li class="divider-vertical"></li>
                <li><a href="about.php"><?php echo $lang['MENU_ABOUT']; ?></a></li>
                <li class="divider-vertical"></li>
                <li><a href="contact.php"><?php echo $lang['MENU_CONTACT']; ?></a></li>       
            </ul>
            <ul class="nav navbar-nav navbar-right">  
              <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['MENU_LANG']; ?><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="?lang=en">English</a></li>
          <li><a href="?lang=br">Portuguese</a></li>
          <li><a href="?lang=ru">Русский</a></li>         
        </ul>
      </li>
                <?
                if (!isLoggedIn()) {
                	if (offline()) {
                	echo "<li class=\"dropdown\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$lang['MENU_LOGREG']." <b class=\"caret\"></b></a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"login.php\">".$lang['MENU_LOGIN']."</a></li>
                                    <li><a href=\"join.php\">".$lang['MENU_REGISTER']."</a></li>
                                </ul>
                          </li>";
                       }  
                } else {
                   if (isAdmin()) {
                        $adm_menu = "<li><a href=\"admin\">".$lang['MENU_ADMIN']."</a></li>";
                    }
                     if (offline()) {
                    echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">" . $user . "<b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"alpha.php\">".$lang['MENU_ALPHA']."</a></li>";
                               }
                               echo $adm_menu;
                              if (offline()) {
                                echo "                                
                                <li><a href=\"edit.php\">".$lang['MENU_SETTINGS']."</a></li>
                                <li><a href=\"logout.php\">".$lang['MENU_EXIT']."</a></li>
                            </ul>
                          </li>";
                }
         }  
                ?>            
      </ul>
     </div>
    </nav>
</header>
  <?
 if (offline()) {
 	} else {
 		echo "
 		<div class=\"alert alert-info\">  
 ".$lang['O_TITLE']." 
</div>
<hr>";
}
?>
