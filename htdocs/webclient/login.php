<!DOCTYPE HTML>
<html lang="it">

	<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=9"/>
	<title>Kiwinote</title>
	<link href="style.css" rel="stylesheet">
	<link rel="shortcut icon" href="../favicon.ico" />

    <script src="../js/jquery.js" type="text/javascript"></script>
	</head>

	<body>
  
    <div id="topBar">
    
      
    
    </div>
  
    <div id="content">
  
      <div id="login">
      
        <p style="display: none" id="error">
        Username e/o Password errati
        </p>
      
        <form name="login" action="#" method="POST">
          <label>Username</label><input name="luser" id="luser" type="text">
          <label>Password</label><input name="lpass" id="lpass" type="password">
		  <input type="hidden" id="nurl" value="<?php echo $_GET['url']; ?>">

		  <input type="hidden" id="nfu" value="<?php echo $_GET['fullscreen']; ?>">

          <input type="button" id="submitbtn" value="Login">
        
		  <script type="text/javascript">
			$("#submitbtn").click(function()
			{
				$.post("../login_do.php",
				{
					name: document.getElementById("luser").value,
					pass: document.getElementById("lpass").value
				},
			  	function(data,status)
			  	{
					if(data=="0")
					{
						urla = document.getElementById("nurl").value;
						fu = document.getElementById("nfu").value;
						window.location.href = "list.php?url="+urla+"&fullscreen="+fu;
					}
					else
					{
						document.getElementById("error").style.display = "block";
					}
			  	});
			});
		 </script>

        </form>
        
      </div>
  
    </div>
  
    <div id="bottomBar">
    
      <div id="leftButtons">
      
        <div class="buttonBottom">
        
          <div class="icon">
          
            <a href="../index.php?signup=1" target="blank"> <img src="icons/add.png" alt="Indietro"></img> </a>
            
          </div>
        
        </div>
        
      </div>
      
      <!--<div id="centerButtons">
      
        <div class="buttonBottom">
        
          <div class="icon">
          
            <a href="#"> <img src="icons/edit.png" alt="Modifica"></img> </a>
            
          </div>
        
        </div>
        
        <div class="buttonBottom">
        
          <div class="icon">
          
            <a href="#"> <img src="icons/erase.png" alt="Elimina"></img> </a>
            
          </div>
        
        </div>
        
      </div>-->
      
      <div id="rightButtons">
      
      <?php if($_GET['fullscreen']==0){ ?>
      
        <div id="fullscreen" class="buttonBottom">
        
          <div class="icon">
          
            <a href="#" 
            onclick="
              window.open('login.php?url=<?php echo $_GET['url']; ?>&fullscreen=1', 
              'Kiwinote', 
              'width=300, height=460'); 
            "> 
            
              <img src="icons/fullscreen.png" alt="PopUp"></img> 
            
            </a>
            
          </div>
        
        </div>
        
      <?php } ?>
        
      </div>
    
    </div>
 
  </body>
  
</html>
