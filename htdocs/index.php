<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>KiwiNote</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico" />
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
	</style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>

	<script type="text/javascript">
		var current_page = "";
		var noteToEdit = 0;
		var noteToRemove = 0;
		var notesToExport;

		function noteEdit(noteId, title, data)
		{
			noteToEdit = noteId;
			document.getElementById('noteEditTitle').value = title;
			document.getElementById('noteEditData').value = data;

			$('#noteEditModal').modal();
		}


		function noteEditDo()
		{
			$.post("newnote_do.php",
			{
				edit: noteToEdit,
				title: document.getElementById('noteEditTitle').value,
				data: document.getElementById('noteEditData').value
			},
		  	function(data,status)
		  	{
				$('#noteEditModal').modal('hide');
				noteToEdit = 0;

				showNotes(current_page);
		  	});
		}



		function showNotes(wiki_page)
		{
			current_page = wiki_page;
			cont = document.getElementById('maincont');

			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					cont.innerHTML = xmlhttp.responseText;
				}
			}

			xmlhttp.open("POST", "show_notes.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("wiki_page="+wiki_page);
		}



		function noteRemove(noteId, title)
		{
			noteToRemove = noteId;
			document.getElementById('noteRemoveTitle').innerHTML = title;

			$('#noteRemoveModal').modal();
		}

		function noteRemoveDo()
		{
			$.post("removenote_do.php",
			{
				id: noteToRemove
			},
		  	function(data,status)
		  	{
				document.getElementById('accordion'+noteToRemove).style.display = "none";

				$('#noteRemoveModal').modal('hide');
				noteToRemove = 0;

				//showNotes(current_page);
		  	});
		}


		function signup()
		{
			document.getElementById('serror').style.display = 'none';

			name = document.getElementById("sname").value;
			mail = document.getElementById("smail").value;
			pass = document.getElementById("spass").value;

			if(name=="" || mail=="" || pass=="")
			{
				document.getElementById('serror').style.display = 'block';
				document.getElementById("serror_msg").innerHTML = 'You should compile the entire form';
				return;
			}
			else if (pass.length < 6)
			{
				document.getElementById('serror').style.display = 'block';
				document.getElementById("serror_msg").innerHTML = 'Password too short (6 characters min)';
				return;
			}
			else if (name.length < 3)
			{
				document.getElementById('serror').style.display = 'block';
				document.getElementById("serror_msg").innerHTML = 'Name too short (3 characters min)';
				return;
			}

			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					//alert(xmlhttp.responseText);
					if(xmlhttp.responseText=="1")
					{
						document.getElementById('serror').style.display = 'block';
						document.getElementById("serror_msg").innerHTML = 'Name already used';
					}
					else if(xmlhttp.responseText=="2")
					{
						document.getElementById('serror').style.display = 'block';
						document.getElementById("serror_msg").innerHTML = 'Mail already used';
					}
					else if(xmlhttp.responseText=="0" || xmlhttp.responseText=="3")
					{
						window.location.href = "index.php";
					}
				}
			}

			xmlhttp.open("POST", "signup_do.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("name="+name+"&pass="+pass+"&mail="+mail);
		}



		function notesExport(page)
		{
			notesToExport = page;
			document.getElementById('notesExportTitle').innerHTML = page;
			//document.getElementById('noteEditData').innerHTML = data;

			$('#notesExportModal').modal();
		}

		function notesExportDo()
		{
			$('#notesExportModal').modal('hide');
			window.open("export.php?url="+notesToExport+"&format="+document.getElementById('notesExportType').value,'_blank');
		}
	</script>
	<?php
			session_start();

			if(isset($_SESSION['name']))
				$logged=1;
			else
				$logged=0;

	?>
  </head>

  <body>
	<!-- Modal Windows-->
		<!-- Remove -->
		<div id="notesRemoveModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="removeModalLabel">Remove</h3>
			</div>
			<div class="modal-body">
				Are you sure to remove notes from the page <span id="notesRemoveTitle"></span>?
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary" type="submit" onclick="javascript: notesRemoveDo()">Remove</button>
			</div>
		</div>

		<!-- Export -->
		<div id="notesExportModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="exportModalLabel">Export</h3>
			</div>
			<div class="modal-body">
				Export notes from the page <span id="notesExportTitle"></span>.
				<br><br>
				<label class="radio">
				<input type="radio" name="optionsRadios" id="notesExportType" value="xml" checked>
				XML file
				</label>
				<!--<label class="radio">
				<input type="radio" name="optionsRadios" id="notesExportType" value="txt">
				Plain text
				</label>-->
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary" type="submit" onclick="javascript: notesExportDo()">Export</button>
			</div>
		</div>

		<!-- Signup -->
		<div id="signupModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="signupModalLabel">Sign Up</h3>
			</div>
			<div class="modal-body">
			    <div class="alert" id="serror" style="display: none">
					<strong>Hey!</strong> <div id="serror_msg"></div>
				</div>

			  <form class="form-signin">
				Name:<br>
				<input type="text" class="input-block-level" id="sname" placeholder="Nickname">
				Email:<br>
				<input type="text" class="input-block-level" id="smail" placeholder="Email address">
				Password:<br>
				<input type="password" class="input-block-level" id="spass" placeholder="Password">
			  </form>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary" type="submit" onclick="javascript: signup()">Sign up</button>
			</div>
		</div>

		<!-- About -->
		<div id="aboutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="aboutModalLabel">About</h3>
			</div>
			<div class="modal-body">
				<?php require("text/about.htm"); ?>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>

		<!-- Contact -->
		<div id="pluginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="pluginModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="pluginModalLabel">Plugin</h3>
			</div>
			<div class="modal-body">
				<p><?php require("text/plugin.htm"); ?></p>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<a href="kiwinote.user.js" class="btn btn-primary btn-medium">Download &raquo;</a>
			</div>
		</div>

	<!-- Navigation bar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
        	<div class="navbar-inner">
            	<div class="container">
                	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    	<span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">KiwiNote</a>
                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li class="active"><a href="#aboutModal" data-toggle="modal">About</a></li>
                                <li class="active"><a href="#pluginModal" data-toggle="modal">Plugin</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->


		  			    <!-- Se non sei loggato visualizza il form di login, altrimenti visualizza il nome utente -->
						<?php if(!$logged)
							{ ?>
								<div class="pull-right navbar navbar-form" id="logindiv">
									  <input class="span2" type="text" id="luser" placeholder="User">
									  <input class="span2" type="password" id="lpass" placeholder="Password">

									<button class="btn btn-primary" type="submit" id="loginbtn" data-toggle="popover"
											data-placement="bottom" data-content="Bad username or password." title="Error" >Login</button>
								</div>
								<script type="text/javascript">
									$("#loginbtn").click(function()
									{
										$.post("login_do.php",
										{
											name: document.getElementById("luser").value,
											pass: document.getElementById("lpass").value
										},
									  	function(data,status)
									  	{
											if(data=="0")
											{
												window.location.href = "index.php";
											}
											else
											{
												$('#loginbtn').popover();
											}
									  	});
									});
								</script>
						<?php } else { ?>
								<div class="nav-collapse collapse">
				                <ul class="nav pull-right">
								    <li id="fat-menu" class="dropdown">
								      <a href="#" id="udrop" role="button" class="dropdown-toggle" data-toggle="dropdown"><b>
										<?php echo $_SESSION['name']; ?></b> <i class="icon-chevron-down icon-white"></i></a>
								      <ul class="dropdown-menu" role="menu" aria-labelledby="udrop">
								        <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
								        <li role="presentation" class="divider"></li>-->
								        <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Logout</a></li>
								      </ul>
								    </li>
								  </ul>
								</div>


						<?php } ?>
                    </div>
                </div>
            </div>

            <div class="container" id="maincont" style="max-width: 70%; margin: auto">
			<?php if(!$logged)
			{ ?>
				  <!-- Se non sei loggato visualizza questo messaggio di benvenuto -->
				  <div class="well">
					<h3>Welcome!</h3>
					<div align="center"><img src="img/logo.png" width="250px" /></div>
					<p><?php require("text/abstract.htm"); ?></p>
					<div align="right"><p><a href="#signupModal" data-toggle="modal" class="btn btn-primary btn-medium">Sign Up &raquo;</a></p></div>


				  </div>
			<?php } else {
				require('php/db.php');
				require('php/db_ops.php');
				require('php/conf.php');

				$pages = getUserPages($_SESSION['name']);
			?>
				<!-- Altrimenti visualizzo la lista delle pagine di wikipedia in cui l'utente ha inserito note -->
				<!--<div align="center" class="pagination">
					<ul>
					<li><a href="#">Prev</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">Next</a></li>
					</ul>
				</div>
				-->



				<table class="table table-bordered" style="text-align: center">
			<?php
				while ($row = mysql_fetch_array($pages))
				{
					?>
					<tr>
						<td><div align="center"><a href="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a></div></td>
						<td><div align="center"><?php echo $row[2]; ?> notes</div></td>
						<td>
							<div align="center">
							<!--<i class="icon-remove" onclick="javascript: notesRemove('<?php echo $row[0]; ?>')"></i>-->
							<i class="icon-share" onclick="javascript: notesExport('<?php echo $row[0]; ?>')"></i>
							<i class="icon-arrow-right" onclick="javascript: showNotes('<?php echo $row[0]; ?>')"></i>
							</div>
						</td>
					</tr>
					<?php
				} ?>

				</table>

				<div align="center" class="pagination">
					<ul>
					<li><a href="#">Prev</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">Next</a></li>
					</ul>
				</div>
			<?php } ?>

            </div> <!-- /container -->

	<?php
			if(isset($_GET['signup']))
				echo "<script type='text/javascript'>$('#signupModal').modal('show');</script>";
	?>
  </body>
</html>
