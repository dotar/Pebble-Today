<?php include "namedays.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
		<title>Today Configuration</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css' />
		<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
		<script src='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js'></script>
		
		<script>
			$( document ).on( "click", ".show-page-loading-msg", function() {
				var $this = $( this ),
					theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
					msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
					textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
					textonly = !!$this.jqmData( "textonly" );
					html = $this.jqmData( "html" ) || "";
				$.mobile.loading( "show", {
						text: msgText,
						textVisible: textVisible,
						theme: theme,
						textonly: textonly,
						html: html
				});
			})
			.on( "click", ".hide-page-loading-msg", function() {
				$.mobile.loading( "hide" );
			});
				
		</script>
		<style>
			.ui-header .ui-title { margin-left: 1em; margin-right: 1em; text-overflow: clip; }
			.smalltext {font-size: 12px; margin:2px}
			.bitcoin {
				font-size: 12px;
				font-weight: bold;
				border-bottom: 1px dashed #000;
				margin-bottom: 10px;
			}
			
			#watchcontainer {
				margin: 0;
				padding: 0;
				background: url(background-trans.png) no-repeat center;
				height: 168px;
				width: 144px;
				position: relative;
				image-rendering: -moz-crisp-edges;
				image-rendering: -moz-crisp-edges;
				image-rendering: -o-crisp-edges;
				image-rendering: -webkit-optimize-contrast;
				-ms-interpolation-mode: nearest-neighbor;
			}
			
			#weekday, #week, #day, #month {
				font-smooth: never;
				-webkit-font-smoothing : none;
				position: absolute;
				width: 100%;
			}
			#weekday, #week, #month {
				font-family: 'Roboto Condensed', sans-serif;
				font-size: 21px;
				color: #000000;
			}
			#weekday, #day, #month {
				width: 144 px;
				text-align: center;
			}
			#weekday {
				top: 10px;
				height: 26 px;
				color: white;
			}
			#week {
				top: 45px;
				width: 134px;
				height: 26px;
				text-align: right;
			}
			#day {
				top: 60px;
				font-family: Arial, sans-serif;
				font-weight: bold;
				font-size: 62px;
			}
			#month {
				top: 128px;
			}
			
		</style>
	</head>
	<body>
		<div data-role="page" id="page1">
		
			<div data-role="panel" id="aboutpanel" data-position="left" data-display="overlay" data-theme="c">
				<div data-theme="c" data-role="header" data-position="fixed">
					<h1>About Today</h1>
					<a href="#demo-links" data-rel="close" data-role="button" data-mini="true" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true" class="ui-btn-right">Close</a>
				</div>
				<!--<p style="text-align:center;margin-top:50px"><img src="screenshot.png"></p>-->
				<p style="width:100%;text-align:center;margin-top:50px">
					<div id=watchcontainer>
						<div id=weekday><?=date("l"); ?></div>
						<div id=week><?="w ".date("W"); ?></div>
						<div id=day><?=date("d"); ?></div>
						<div id=month><?=date("F"); ?></div>
					</div>
				</p>
				<p style="font-style:italic;">A quick way to view todays date, including week number.</p>
				<p>Version <?=$_GET['version']; ?></p>
				<p class="smalltext">This watchface was made by <a href="mailto:t.dotar@gmail.com?Subject=Watchface: Today">dotar</a>.</p>
				<p class="smalltext">
					Feel free to send a small donation!<br>
					<!--<span class="bitcoin">19XasqsSyij1sY37DLgjcgGYSUnyL31z6C</span><br>-->
					<div class="bitcoin" contentEditable=true onclick="document.execCommand('selectAll',false,null)">19XasqsSyij1sY37DLgjcgGYSUnyL31z6C</div>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="SDJ58BL46JEEE">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" class="show-page-loading-msg" data-textvisible="true">
					<img alt="" border="0" src="https://www.paypalobjects.com/sv_SE/i/scr/pixel.gif" width="1" height="1">
					</form>
				</p>
				<!--<a href="#demo-links" data-rel="close" data-role="button" data-mini="true" data-theme="c" data-icon="delete" data-inline="true">Close panel</a>-->
			</div><!-- /panel -->
		
			<div data-theme="b" data-role="header" data-position="fixed">
				<h1>Today Configuration</h1>
				<a href="#aboutpanel" data-role="button" data-mini="true" data-icon="info" data-iconpos="notext" data-theme="b" data-inline="true" class="ui-btn-left">About</a>
			</div>
			
			<div data-role="content">
				<?php if($_GET['version'] == "MAYBE IN THE FUTURE?") { ?>
					<div data-role="fieldcontain">
						<label for="lang">
							Language
						</label>
						<select id="lang" data-native-menu="true" name="lang" data-mini="true">

							<?php
								$langs = array(
									 0 => 'Swedish',
									 1 => 'English',
									 2 => 'French',
									 3 => 'German',
									 5 => 'Italian',
									 4 => 'Spanish',
									 6 => 'Dutch'
								);
							
								if (!isset($_GET['lang'])) {
									$lang = 1;
								} else {
									$lang = $_GET['lang'];
								}
							
								foreach ($langs as $v => $n) {
									if ($lang == $v) {
										$s = " selected";
									} else {
										$s = "";
									}
									echo '<option value="' . $v . '" ' . $s . '>' . $n . '</option>';
								}
							?>
						</select>
					</div>
				<?php } ?>
				<div data-role="fieldcontain">
					<label for="show_week">Show Week</label>
					<select name="show_week" id="show_week" data-theme="c" data-role="slider" data-mini="false">
						<?php
							if (!isset($_GET['show_week'])) {
								$show_week = 1;
							} else {
								$show_week = $_GET['show_week'];
							}
							
							if ($show_week == 0) {
								$s1 = " selected";
								$s2 = "";
							} else {
								$s1 = "";
								$s2 = " selected";
							}
							echo '<option value="0"' . $s1 .'>No</option><option value="1"' . $s2 . '>Yes</option>';
						?>
					</select>
				</div>
				
				<div data-role="fieldcontain">
					<label for="show_month">Show Month</label>
					<select name="show_month" id="show_month" data-theme="c" data-role="slider" data-mini="false">
					<?php
						if (!isset($_GET['show_month'])) {
							$show_month = 1;
						} else {
							$show_month = $_GET['show_month'];
						}
						
						if ($show_month == 0) {
							$s1 = " selected";
							$s2 = "";
						} else {
							$s1 = "";
							$s2 = " selected";
						}
						echo '<option value="0"' . $s1 .'>No</option><option value="1"' . $s2 . '>Yes</option>';
					?>
					</select>
				</div>
				
				<?php if($_GET['version'] == "Not right now") { ?>
					<div data-role="fieldcontain">
						<label for="show_name">
							Name Days (only Swedish for now)
						</label>
						<select id="show_name" data-native-menu="true" name="show_name" data-mini="true">

							<?php
								$names = array(
									 0 => 'Don\'t show name days',
									 1 => 'Swedish'
								);
							
								if (!isset($_GET['show_name'])) {
									$show_name = 0;
								} else {
									$show_name = $_GET['show_name'];
								}
							
								foreach ($names as $v => $n) {
									if ($show_name == $v) {
										$s = " selected";
									} else {
										$s = "";
									}
									echo '<option value="' . $v . '" ' . $s . '>' . $n . '</option>';
								}
							?>
						</select>
					</div>
				<?php } ?>
				
				<div data-role="fieldset" class="ui-grid-a">
						<div class="ui-block-a" id="cancelbutton">
							<input id="cancel" type="submit" data-theme="c" data-icon="delete" data-iconpos="left"
							value="Cancel" data-mini="false">
						</div>
						<div class="ui-block-b" id="savebutton">
							<input id="save" type="submit" data-theme="b" data-icon="check" data-iconpos="right"
							value="Save" data-mini="false">
						</div>
				</div>
				
			</div>
			
		</div>

	<script>
		function saveOptions() {
			//var getNameday = <?php echo json_encode(nameday($show_name)); ?>;
			var options = {
				'show_week': parseInt($("#show_week").val(), 10),
				'show_month': parseInt($("#show_month").val(), 10),
				'show_name': parseInt($("#show_name").val(), 10),
				//'name_day': getNameday,
				//'lang': parseInt($("#lang").val(), 10),
			}
			return options;
		}

		$().ready(function() {
			$("#cancel").click(function() {
				console.log("Cancel");
				document.location = "pebblejs://close#";
			});

			$("#save").click(function() {
				console.log("Submit");
				var location = "pebblejs://close#" + encodeURIComponent(JSON.stringify(saveOptions()));
				console.log("Close: " + location);
				console.log(location);
				document.location = location;
			});

		});
		
	</script>
</body>
</html>