<?php
	$stateLabels = array(
		'current'      => 'Installed and up to date',
		'outdated'     => 'Installed but outdated - update available',
		'legacy'       => 'Older unmarked version present - update available',
		'missing'      => 'Not installed',
		'missing_file' => 'Model file not found',
	);
?>

<?php echo text_output($title, 'h1', 'page-head');?>


<?php /* ---------- Status ---------- */ ?>

<?php echo text_output('Status', 'h3', 'page-subhead');?>

<table class="table100 zebra">
	<tbody>
		<tr>
			<td class="cell-label">Database columns</td>
			<td class="cell-spacer"></td>
			<td>
				<?php if (empty($missing_columns)): ?>
					All present
				<?php else: ?>
					<?php echo count($missing_columns);?> missing
					(<?php echo implode(', ', $missing_columns);?>)
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="cell-label">Display-name model code</td>
			<td class="cell-spacer"></td>
			<td><?php echo $stateLabels[$character_state];?></td>
		</tr>
	</tbody>
</table>

<br>


<?php /* ---------- Database setup ---------- */ ?>

<?php echo text_output('Database', 'h3', 'page-subhead');?>

<?php if ( ! $db_ready): ?>
	<p>
		One click will add the <code>display_name</code> column to
		<code><?php echo $this->db->dbprefix;?>characters</code>. Safe to re-run.
	</p>
	<?php echo form_open('extensions/nova_ext_display_name/Manage/config/');?>
		<button name="action" type="submit" class="button-main" value="setup_database"><span>Set Up Database</span></button>
	<?php echo form_close();?>
<?php else: ?>
	<p>All required columns are present.</p>
<?php endif; ?>

<br>


<?php /* ---------- Model code ---------- */ ?>

<?php echo text_output('Display-name model code', 'h3', 'page-subhead');?>

<?php if ($character_state === 'current'): ?>
	<p>The display-name model code in <code>application/models/Characters_model.php</code> is up to date.</p>

<?php elseif ($character_state === 'missing_file'): ?>
	<p>
		<code>application/models/Characters_model.php</code> was not found. Restore the file from your Nova install before continuing.
	</p>

<?php else: ?>
	<p>
		<?php if ($character_state === 'outdated'): ?>
			The injected code in <code>application/models/Characters_model.php</code> is out of date and will be replaced.
		<?php elseif ($character_state === 'legacy'): ?>
			An older, unmarked version of <code>get_character_name()</code> is present in
			<code>application/models/Characters_model.php</code> and will be replaced with the current shim.
		<?php else: ?>
			Inject the display-name shim into <code>application/models/Characters_model.php</code> so character
			names use the Display Name when one is set.
		<?php endif; ?>
	</p>
	<?php echo form_open('extensions/nova_ext_display_name/Manage/config/');?>
		<button name="action" type="submit" class="button-main" value="install_character">
			<span><?php echo ($character_state === 'missing') ? 'Install Model Code' : 'Update Model Code';?></span>
		</button>
	<?php echo form_close();?>
<?php endif; ?>

<br>


<?php /* ---------- Labels ---------- */ ?>

<?php echo text_output('Labels', 'h3', 'page-subhead');?>

<p>Customise the wording shown on the character forms.</p>

<?php echo form_open('extensions/nova_ext_display_name/Manage/config/');?>
	<?php foreach ($jsons['nova_ext_display_name'] as $key => $field): ?>
		<p>
			<kbd><?php echo $field['name'];?></kbd>
			<input type="text" name="<?php echo $key;?>" value="<?php echo htmlspecialchars($field['value'], ENT_QUOTES);?>">
		</p>
	<?php endforeach; ?>
	<br>
	<button name="action" type="submit" class="button-main" value="save_labels"><span>Update Labels</span></button>
<?php echo form_close();?>
