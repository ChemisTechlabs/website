<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8">
	<title>ChemisProject - Page not found</title>
	<?php
		include_once 'head.php';
	?>
</head>

<body>
	<?php
		include_once 'header.php';
	?>
	<div id="chemis-page" class="pure-g-r">
		<div id="session-404" class="pure-u-1 session">
			<div class="pure-g-r">
				<div class="pure-u-1-2">
					<div class="margin-container">
						<img src="img/ufo.png">
						<h2>A página que você procura pode ter sido abduzida</h2>
						<p>
							Tente voltar ao nosso site por um dos links acima! (que ainda restam...)
						</p>
					</div>
				</div>
			</div>
		</div>
		<footer id="session-footer" class="pure-u-1 session">
			<p>ChemisProject ©All Rights reserved</p>
			<p>ChemisProject is an open source project under
				<a href="http://www.gnu.org/licenses/gpl-2.0.html" title="GNU GPL2" target="_blank">GNU General Public Liscense Version 2</a>
			</p>
		</footer>
	</div>
</body>
<script>
	var menuOpen=false;
	function openMenu(){
		if(menuOpen){
			$("#chemis-tool-bar").removeClass("open");
			menuOpen=false;
		}else{
			$("#chemis-tool-bar").addClass("open");
			menuOpen=true;
		}
	}
	
	$("#chemis-tool-bar li").click(function(){openMenu()});
	
	function setItemSelected(item) {
		$("#chemis-tool-bar li").removeClass("pure-menu-selected");
		$(item).addClass("pure-menu-selected");
	}

	$("#chemis-tool-bar li").click(function() {
		setItemSelected(this);
	});
</script>

</html>
