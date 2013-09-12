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
	<link href="style.css" rel="stylesheet">
	<link rel="shortcut icon" href="../favicon.ico" />

	</head>

	<body>
  
    <div id="topBar">
    
    </div>
  
    <div id="content">
  
      <div id="listNote">

<?php
		session_start();

		$wiki_page = $_GET['url'];
	
		require('../php/db.php');
		require('../php/db_ops.php');
		require('../php/conf.php');

		$notes = getUserNotes($_SESSION['name'], $wiki_page);
		//$title = mysql_fetch_array($notes)['wiki_page_title'];
		//$notes = getUserNotes($_SESSION['name'], $wiki_page);

		while ($row = mysql_fetch_array($notes)) 
		{
?>        
        <div class="note">
		<?php
			if($row['type'] == 1)
				echo '<div class="icon text"></div>';
			else if($row['type'] == 2)
				echo '<div class="icon photo"></div>';
			else if($row['type'] == 3) // link
				echo '<div class="icon link"></div>';
			else if($row['type'] == 4)
				echo '<div class="icon video"></div>';  
		?>        
          <div class="title">
            <a href="detail.php?id=<?php echo $row['id']; ?>&url=<?php echo $_GET['url']; ?>&fullscreen=<?php echo $_GET['fullscreen']; ?>"><?php echo $row['title']; ?></a>
          </div>
          
          <div class="description">
            <?php echo $row['creation_date']; ?>
          </div>
          
        </div>
 
<?php } ?>
	</div>

<!--       
        <div class="note">
        
          <div class="icon video">
            
          </div>
          
          <div class="title">
            <a href="detail.php">PROVA 3</a>
          </div>
          
          <div class="description">
            descrizione 3
          </div>
          
        </div>
        
        <div class="note">
        
          <div class="icon photo">
            
          </div>
          
          <div class="title">
            <a href="detail.php">PROVA 4</a>
          </div>
          
          <div class="description">
            descrizione 4
          </div>
          
        </div>
        
        <div class="note">
        
          <div class="icon text">
            
          </div>
          
          <div class="title">
            <a href="detail.php">PROVA 5</a>
          </div>
          
          <div class="description">
            descrizione 5
          </div>
          
        </div>
        
        <div class="note">
        
          <div class="icon link">
            
          </div>
          
          <div class="title">
            <a href="detail.php">PROVA 6</a>
          </div>
          
          <div class="description">
            descrizione 6
          </div>
          
        </div>
    
      </div>
    
    </div>
  -->
    <div id="bottomBar">
    
      <div id="leftButtons">
      
        <div class="buttonBottom">
        
          <div class="icon">
          
            <a href="logout.php?fullscreen=<?php echo $_GET['fullscreen']; ?>&url=<?php echo $_GET['url']; ?>"> <img src="icons/user.png" alt="Logout"></img> </a>


            
          </div>
        
        </div>
        
      </div>
      
      <div id="centerButtons">
      
        <div class="buttonBottom">
        <!--
          <div class="icon">
          
            <a href="#"> <img src="icons/edit.png" alt="Modifica"></img> </a>
            
          </div>
        -->
        </div>
        
        <div class="buttonBottom">
        <!--
          <div class="icon">
            <a href="#"> <img src="icons/erase.png" alt="Elimina"></img> </a> 
          </div>
        -->
        </div>
        
      </div>
      
      <div id="rightButtons">
      
      <?php if($_GET['fullscreen']==0){ ?>
      
        <div id="fullscreen" class="buttonBottom">
        
          <div class="icon">
          
            <a href="#" 
            onclick="
              window.open('list.php?url=<?php echo $_GET['url']; ?>&fullscreen=1', 
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
$(".note").click(function(){
     window.location=$(this).find("a").attr("href"); 
     return false;
});

$(".note").css("cursor","pointer");
</script>
