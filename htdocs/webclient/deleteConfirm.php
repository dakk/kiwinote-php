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
  
      <div id="confirm">
      
        <p>
        Sei sicuro di voler eliminare questa nota?
        </p>
      
        <div id="answer">
        

		  <input type="hidden" id="nid" value="<?php echo $_GET['id']; ?>" >
		  <input type="hidden" id="nurl" value="<?php echo $_GET['url']; ?>" >
		  <input type="hidden" id="nful" value="<?php echo $_GET['fullscreen']; ?>" >

          <div id="yes"><a href="#" id="yes">SI</a></div>
          <div id="no"><a href="detail.php?id=<?php echo $_GET['id']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>&url=<?php echo $_GET['url']; ?>">NO</a></div>

        						<script type="text/javascript">
									$("#yes").click(function()
									{
										$.post("../removenote_do.php",
										{
											id: document.getElementById("nid").value
										},
									  	function(data,status)
									  	{
											var url = document.getElementById("nurl").value;
											var fu = document.getElementById("nful").value;
											window.location.href = "list.php?fullscreen="+fu+"url="+url;
									  	});
									});
								</script>
        
        </div>
        
      </div>
  
    </div>
  
    <div id="bottomBar">
    
      <div id="leftButtons">
      
        <div class="buttonBottom">
        
          <div class="icon">
          
            <a href="detail.php?fullscreen=<?php echo $_GET['fullscreen']; ?>&url=<?php echo $_GET['url']; ?>"> <img src="icons/back.png" alt="Indietro"></img> </a>
            
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
              window.open('deleteConfirm.php?url=<?php echo $_GET['url']; ?>&fullscreen=1', 
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
$("#yes").click(function(){
     window.location=$(this).find("a").attr("href"); 
     return false;
});

$("#yes").css("cursor","pointer");

$("#no").click(function(){
     window.location=$(this).find("a").attr("href"); 
     return false;
});

$("#no").css("cursor","pointer");
</script>
