<?php echo text_output($title, 'h1', 'page-head');?>

<?php echo form_open('extensions/nova_ext_display_name/Manage/config/');?>

<?php foreach($jsons['nova_ext_display_name'] as $key=>$field){ ?>
			<p>
				<kbd><?=$field['name']?></kbd>
				<input type="text" name="<?=$key?>" value="<?=$field['value']?>">	
			</p>
<?php } ?>

		
			<br>
			<button name="submit" type="submit" class="button-main" value="Submit"><span>Update Label</span></button>
<?php echo form_close(); ?>



<?php if(!empty($fields)){ ?>
<?php echo form_open('extensions/nova_ext_display_name/Manage/config/');?>
        

			<p>
				<kbd>Database Columns Missing - This is expected if it is the first time you have used this Extension or an update has produced a change. Click the Create Column button below for each missing column or check the README file for manual instructions.</kbd>
				<select name="attribute">
				<?php foreach($fields as $key=>$field){?>
                  <option value="<?=$field?>"><?=$field?></option>
				<?php }?>
				</select>
			</p>

			<br>
			<button name="submit" type="submit" class="button-main" value="Add"><span>Create Column</span></button>
<?php echo form_close(); ?>
<?php } else { ?>
   <div><br>All expected columns found in the database</div>
    
<?php } ?>




<?php if(empty($write)){ ?>

	<?php echo form_open('extensions/nova_ext_display_name/Manage/config/');?>
	<br>
	<div>get_character_name Function Missing or Updated - This is expected if it is the first time you have used this Extension or an update has produced a change. Click the button below to modify your application/models/characters_model.php file or check the README file for manual instructions.</div>
	<br>
     
	<button name="submit" type="submit" class="button-main" value="write"><span>Update Model Configuration</span></button>


	<?php echo form_close(); ?>
<?php } else { ?>
   <div class="email-message"><br>get_character_name Function located, and up to date.</div>
<?php } ?>



