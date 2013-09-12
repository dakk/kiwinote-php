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
  
      <div id="noteCreation">
      
<?php 
	$title = "";
	$content = "";
	$edit = 0;

	if(isset($_GET['edit'])) 
	{
		$edit = $_GET['edit'];
		require('../php/db.php');
		require('../php/db_ops.php');

		session_start();
	
		$owner = $_SESSION['name'];
		$note = getUserNote($owner, $_GET['url'], $edit);
		$title = $note['title'];
		$content = $note['data'];
	} 

?>

        <form name="composeNote" action="#" method="POST">
          <label>Titolo:</label><input name="title" id="ntitle" type="text" value="<?php echo $title; ?>">
			<br><br>

          <label>
			<?php 
				$t = $_GET['type'];
				if($t == 1)
					echo "Contenuto";
				else if ($t == 2)
					echo "Indirizzo immagine";
				else if ($t == 3)
					echo "Indirizzo";
				else if ($t == 4)
					echo "Indirizzo video";
			?>:
		</label>

		<textarea name="content" id="ndata"><?php echo $content; ?></textarea>
		  <input type="hidden" id="nurl" value="<?php echo $_GET['url']; ?>">
		  <input type="hidden" id="ntype" value="<?php echo $_GET['type']; ?>">
		  <input type="hidden" id="nedit" value="<?php echo $edit; ?>">
          <input type="button" id="submitbtn" value="Invia">
        
		  <script type="text/javascript">
			$("#submitbtn").click(function()
			{
				$.post("../newnote_do.php",
				{
					title: document.getElementById("ntitle").value,
					data: document.getElementById("ndata").value,
					url: document.getElementById("nurl").value,
					type: document.getElementById("ntype").value,
					edit: document.getElementById("nedit").value
				},
			  	function(data,status)
			  	{
					//alert(data);
					window.location.href = "list.php?url="+(document.getElementById("nurl").value);
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
          
            <?php if (isset($_GET['edit'])){ ?>
            
            <a href="detail.php?id=<?php echo $_GET['edit']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>&url=<?php echo $_GET['url']; ?>"> <img src="icons/back.png" alt="Indietro"></img> </a>
            
            <?php }else{ ?>
            
            <a href="new.php?fullscreen=<?php echo $_GET['fullscreen']; ?>&url=<?php echo $_GET['url']; ?>"> <img src="icons/back.png" alt="Indietro"></img> </a>
            
            <?php } ?>
            
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
          

            <?php if (isset($_GET['edit'])){ ?>
            <a href="#" 
            onclick="
              window.open('compose.php?url=<?php echo $_GET['url']; ?>&type=<?php echo $_GET['type']; ?>&fullscreen=1&edit=<?php echo $_GET['edit']; ?>', 
              'Kiwinote', 
              'width=300, height=460'); 
            "> 
			<?php } else { ?>
            <a href="#" 
            onclick="

              window.open('compose.php?url=<?php echo $_GET['url']; ?>&type=<?php echo $_GET['type']; ?>&fullscreen=1', 
              'Kiwinote', 
              'width=300, height=460'); 
            "> 


			<?php } ?>            
              <img src="icons/fullscreen.png" alt="PopUp"></img> 
            
            </a>
            
          </div>
        
        </div>
        
      <?php } ?>
        
      </div>
    
    </div>
 
  </body>
  
</html>
