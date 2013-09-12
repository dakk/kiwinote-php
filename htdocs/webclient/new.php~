<?php 
	session_start();
			
	if(!isset($_SESSION['name']))
		header( "Location: login.php?fullscreen=".$_GET['fullscreen']."&url=".$_GET['url'] ) ;
?>

<!DOCTYPE HTML>
<html lang="it">

	<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=9"/>
	<title>Kiwinote</title>
	<link rel="shortcut icon" href="../favicon.ico" />
	<link href="style.css" rel="stylesheet">

	</head>

	<body>
  
    <div id="topBar">
    
    </div>
  
    <div id="content">
  
      <div id="newNoteSelection">
      
        <div class="noteType">
        
          <div class="icon text">
          
          </div>
          
          <div class="description">
            <a href="compose.php?type=1&url=<?php echo $_GET['url']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>">Testo</a>
          </div>
        
        </div>
        
                <div class="noteType">
        
          <div class="icon link">
          
          </div>
          
          <div class="description">
            <a href="compose.php?type=3&url=<?php echo $_GET['url']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>">Link</a>
          </div>
        
        </div>
        
                <div class="noteType">
        
          <div class="icon photo">
          
          </div>
          
          <div class="description">
            <a href="compose.php?type=2&url=<?php echo $_GET['url']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>">Immagine</a>
          </div>
        
        </div>
        
                <div class="noteType">
        
          <div class="icon video">
          
          </div>
          
          <div class="description">
            <a href="compose.php?type=4&url=<?php echo $_GET['url']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>">Video</a>
          </div>
        
        </div>
      
      </div>
  
    </div>
  
    <div id="bottomBar">
    
      <div id="leftButtons">
      
        <div class="buttonBottom">
        
          <div class="icon">
          
            <a href="login.php?fullscreen=<?php echo $_GET['fullscreen']; ?>&url=<?php echo $_GET['url']; ?>"> <img src="icons/user.png" alt="Logout"></img> </a>
            
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
              window.open('new.php?url=<?php echo $_GET['url']; ?>&fullscreen=1', 
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

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(".noteType").click(function(){
     window.location=$(this).find("a").attr("href"); 
     return false;
});

$(".noteType").css("cursor","pointer");
</script>
