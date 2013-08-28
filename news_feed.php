<?
                $page = $_GET['page'];
                $result0 = mysql_query("SELECT COUNT(*) FROM $news_table");
                $temp = mysql_fetch_array($result0);
                $posts = $temp[0];
                $total = (($posts - 1) / $num) + 1;
                $total = intval($total);
                $page = intval($page);
                if (empty($page) or $page < 0)
                    $page = 1;
                if ($page > $total)
                    $page = $total;
                $start = $page * $num - $num;
                $result = @mysql_query("SELECT * FROM $news_table ORDER BY id ASC LIMIT $start, $num");

                if (!$result) {
                    print "<center><br>error:" . mysql_error() . "<br></center>";
                } elseif (mysql_num_rows($result) == 0) {
                    print "<center><div class=\"alert alert-error\">No news</div></center>\n";
                } else {
                    $rows = array();
                    while ($row = mysql_fetch_assoc($result)) {
                        $rows[] = $row;
                    }
                    $rows = array_reverse($rows);
                    foreach ($rows as $row) {
                        print "<div class=\"panel panel-info\"><div class=\"panel-heading\"><h4 class=\"panel-title\">{$row['date']}</h4></div><div class=\"container\">{$row['text']}</div></div>";
                    }
                }
                ?>
                <?
                if ($page - 5 > 0)
                    $page5left = '<a href=?page=' . ($page - 5) . '>' . ($page - 5) . '</a>';
                if ($page - 4 > 0)
                    $page4left = '<a href=?page=' . ($page - 4) . '>' . ($page - 4) . '</a>';
                if ($page - 3 > 0)
                    $page3left = '<a href=?page=' . ($page - 3) . '>' . ($page - 3) . '</a>';
                if ($page - 2 > 0)
                    $page2left = '<a href=?page=' . ($page - 2) . '>' . ($page - 2) . '</a>';
                if ($page - 1 > 0)
                    $page1left = '<a href=?page=' . ($page - 1) . '>' . ($page - 1) . '</a>';
                if ($page)
                    $pagenow = '<a href=?page=' . ($page) . '>' . ($page) . '</a>';
                if ($page + 5 <= $total)
                    $page5right = '<a href=?page=' . ($page + 5) . '>' . ($page + 5) . '</a>';
                if ($page + 4 <= $total)
                    $page4right = '<a href=?page=' . ($page + 4) . '>' . ($page + 4) . '</a>';
                if ($page + 3 <= $total)
                    $page3right = '<a href=?page=' . ($page + 3) . '>' . ($page + 3) . '</a>';
                if ($page + 2 <= $total)
                    $page2right = '<a href=?page=' . ($page + 2) . '>' . ($page + 2) . '</a>';
                if ($page + 1 <= $total)
                    $page1right = '<a href=?page=' . ($page + 1) . '>' . ($page + 1) . '</a>';
                ?>
                <?
                if ($total > 1) {
                    echo "<ul class=\"pager\"><li>$page5left</li> <li>$page4left</li> <li>$page3left<li> <li>$page2left</li> <li>$page1left</li> <li class=\"disabled\">$pagenow</li> <li>$page1right</li> <li>$page2right</li> <li>$page3right</li> <li>$page4right</li> <li>$page5right</li></ul>";
                }
                ?>
