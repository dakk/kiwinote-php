	<!-- Modals -->
	<div id="noteRemoveModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="noteRemoveModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="noteRemoveModalLabel">Remove</h3>
		</div>
		<div class="modal-body">
			Are you sure to remove the note '<span id="noteRemoveTitle"></span>'?
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit" onclick="javascript: noteRemoveDo()">Remove</button>
		</div>
	</div>

	<div id="noteEditModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="noteEditModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="noteEditModalLabel">Edit '<input type="text" id="noteEditTitle">'</h3>
		</div>
		<div class="modal-body" >
			<textarea rows="6" style="max-width: 95%; width: 95%;" id="noteEditData"></textarea>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit" onclick="javascript: noteEditDo()">Edit</button>
		</div>
	</div>
<div>
	<?php
		session_start();

		$wiki_page = $_POST['wiki_page'];
	
		require('php/db.php');
		require('php/db_ops.php');
		require('php/conf.php');

		$notes = getUserNotes($_SESSION['name'], $wiki_page);
		$title = mysql_fetch_array($notes);
		$title = $title['wiki_page_title'];
		$notes = getUserNotes($_SESSION['name'], $wiki_page);

	?> 

	<table>
		<tr>
			<td><a class="icon-chevron-left" href="index.php"></a></td>
			<td><h3><?php echo $title; ?></h3></td>
			<td>
				<!-- Forma di ricerca qua' -->
			</td>
		</tr>
	</table>
	<?php
		$i = 0;

		while ($row = mysql_fetch_array($notes)) 
		{			
	?>
			<div class="accordion" id="accordion<?php echo $row['id']; ?>">
				<div class="accordion-group">
					<div class="accordion-heading">
							<table style="max-width: 100%; width: 100%"><tr>
							<td style="max-width: 5%; width: 5%"><div align="center">
							<?php 
								if($row['type'] == 1)
									echo '<i class="icon-book"></i> ';
								else if($row['type'] == 2)
									echo '<i class="icon-camera"></i>';
								else if($row['type'] == 3) // link
									echo '<i class="icon-globe"></i>';
								else if($row['type'] == 4)
									echo '<i class="icon-film"></i>';
							?></div>
							</td>
							<td style="max-width: 90%; width: 90%"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $row['id']; ?>" href="#c<?php echo $row['id']; ?>">
							<?php echo $row['title']; ?>
							</a></td>
							<td>
								<div align="center">
								<?php if($row['type'] == 1) { ?>
									<i class="icon-edit" onclick="javascript: noteEdit(<?php echo $row['id']; ?>, '<?php echo $row['title']; ?>', '<?php echo $row['data']; ?>');"></i>
								<?php } ?>	
								<i class="icon-remove" onclick="javascript: noteRemove(<?php echo $row['id']; ?>, '<?php echo $row['title']; ?>');"></i>
								</div>
							</td></tr></table>
					</div>
				<div id="c<?php echo $row['id']; ?>" class="accordion-body collapse">
					<div class="accordion-inner">
							<?php showNoteData($row['data'], $row['type'], false); ?>
					</div>
				</div>
			</div>
		</div>
	<?php
			$i++;
		}
	?>
</div>

