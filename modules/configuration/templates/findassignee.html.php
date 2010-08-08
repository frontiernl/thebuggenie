<?php TBGContext::loadLibrary('ui'); ?>
<?php if ($message): ?>
	<p class="faded_medium" style="padding: 5px;"><?php echo __('Please specify something to search for'); ?></p>
<?php else: ?>
	<div class="config_header nobg" style="margin-top: 10px;"><b><?php echo __('The following customers were found based on your search criteria'); ?>:</b></div>
	<?php if ($customers): ?>
		<div style="margin: 5px 0 0 10px;">
			<?php foreach ($customers as $customer): ?>
				<form action="<?php echo make_url('configure_project_add_assignee', array('project_id' => $theProject->getID(), 'assignee_type' => 'customer', 'assignee_id' => $customer->getID())); ?>" onsubmit="assignToProject('<?php echo make_url('configure_project_add_assignee', array('project_id' => $theProject->getID(), 'assignee_type' => 'customer', 'assignee_id' => $customer->getID())); ?>', 'assign_customer');return false;" method="post" id="assign_customer">
					<label for="role_team_<?php echo $customer->getID(); ?>"><?php echo $customer->getName(); ?>:</label>&nbsp;
					<select name="role" id="role_team_<?php echo $customer->getID(); ?>">
						<?php foreach (TBGProjectAssigneesTable::getTypes() as $type_id => $type_desc): ?>
							<option value="<?php echo $type_id; ?>"><?php echo $type_desc; ?></option>
						<?php endforeach ;?>
					</select>
					&nbsp;<label for="target"><?php echo __('%role% for %item%', array('%role%' => '', '%item%' => '')); ?></label>&nbsp;
					<select name="target" id="target">
						<option value="project_<?php echo $theProject->getID(); ?>"><?php echo $theProject->getName(); ?></option>
						<?php if ($theProject->isEditionsEnabled()): ?>
							<optgroup label="<?php echo __('Editions'); ?>">
							<?php foreach ($theProject->getEditions() as $anEdition): ?>
								<option value="edition_<?php echo $anEdition->getID(); ?>"><?php echo $anEdition->getName(); ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endif; ?>
						<?php if ($theProject->isComponentsEnabled()): ?>
							<optgroup label="<?php echo __('Components'); ?>">
							<?php foreach ($theProject->getComponents() as $aComponent): ?>
								<option value="component_<?php echo $aComponent->getID(); ?>"><?php echo $aComponent->getName(); ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endif; ?>
					</select>
					&nbsp;
					<input type="submit" value="<?php echo __('Add customer'); ?>">
				</form>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p class="faded_medium" style="padding: 2px 0 0 10px;"><?php echo __('Could not find any customers based on your search criteria'); ?></p>
	<?php endif;?>
	<div class="config_header nobg" style="margin-top: 10px;"><b><?php echo __('The following teams were found based on your search criteria'); ?>:</b></div>
	<?php if ($teams): ?>
		<div style="margin: 5px 0 0 10px;">
			<?php foreach ($teams as $team): ?>
				<form action="<?php echo make_url('configure_project_add_assignee', array('project_id' => $theProject->getID(), 'assignee_type' => 'team', 'assignee_id' => $team->getID())); ?>" onsubmit="assignToProject('<?php echo make_url('configure_project_add_assignee', array('project_id' => $theProject->getID(), 'assignee_type' => 'team', 'assignee_id' => $team->getID())); ?>', 'assign_team');return false;" method="post" id="assign_team">
					<label for="role_team_<?php echo $team->getID(); ?>"><?php echo $team->getName(); ?>:</label>&nbsp;
					<select name="role" id="role_team_<?php echo $team->getID(); ?>">
						<?php foreach (TBGProjectAssigneesTable::getTypes() as $type_id => $type_desc): ?>
							<option value="<?php echo $type_id; ?>"><?php echo $type_desc; ?></option>
						<?php endforeach ;?>
					</select>
					&nbsp;<label for="target"><?php echo __('%role% for %item%', array('%role%' => '', '%item%' => '')); ?></label>&nbsp;
					<select name="target" id="target">
						<option value="project_<?php echo $theProject->getID(); ?>"><?php echo $theProject->getName(); ?></option>
						<?php if ($theProject->isEditionsEnabled()): ?>
							<optgroup label="<?php echo __('Editions'); ?>">
							<?php foreach ($theProject->getEditions() as $anEdition): ?>
								<option value="edition_<?php echo $anEdition->getID(); ?>"><?php echo $anEdition->getName(); ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endif; ?>
						<?php if ($theProject->isComponentsEnabled()): ?>
							<optgroup label="<?php echo __('Components'); ?>">
							<?php foreach ($theProject->getComponents() as $aComponent): ?>
								<option value="component_<?php echo $aComponent->getID(); ?>"><?php echo $aComponent->getName(); ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endif; ?>
					</select>
					&nbsp;
					<input type="submit" value="<?php echo __('Add team'); ?>">
				</form>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p class="faded_medium" style="padding: 2px 0 0 10px;"><?php echo __('Could not find any teams based on your search criteria'); ?></p>
	<?php endif;?>
	<div class="config_header nobg" style="margin-top: 10px;"><b><?php echo __('The following users were found based on your search criteria'); ?>:</b></div>
	<?php if ($users): ?>
		<div style="margin: 5px 0 0 10px;">
			<?php foreach ($users as $user): ?>
				<form action="<?php echo make_url('configure_project_add_assignee', array('project_id' => $theProject->getID(), 'assignee_type' => 'user', 'assignee_id' => $user->getID())); ?>" onsubmit="assignToProject('<?php echo make_url('configure_project_add_assignee', array('project_id' => $theProject->getID(), 'assignee_type' => 'user', 'assignee_id' => $user->getID())); ?>', 'assign_user');return false;" method="post" id="assign_user">
					<label for="role_<?php echo $user->getID(); ?>"><?php echo $user->getNameWithUsername(); ?>:</label>&nbsp;
					<select name="role" id="role_<?php echo $user->getID(); ?>">
						<?php foreach (TBGProjectAssigneesTable::getTypes() as $type_id => $type_desc): ?>
							<option value="<?php echo $type_id; ?>"><?php echo $type_desc; ?></option>
						<?php endforeach ;?>
					</select>
					&nbsp;<label for="target"><?php echo __('%role% for %item%', array('%role%' => '', '%item%' => '')); ?></label>&nbsp;
					<select name="target" id="target">
						<option value="project_<?php echo $theProject->getID(); ?>"><?php echo $theProject->getName(); ?></option>
						<?php if ($theProject->isEditionsEnabled()): ?>
							<optgroup label="<?php echo __('Editions'); ?>">
							<?php foreach ($theProject->getEditions() as $anEdition): ?>
								<option value="edition_<?php echo $anEdition->getID(); ?>"><?php echo $anEdition->getName(); ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endif; ?>
						<?php if ($theProject->isComponentsEnabled()): ?>
							<optgroup label="<?php echo __('Components'); ?>">
							<?php foreach ($theProject->getComponents() as $aComponent): ?>
								<option value="component_<?php echo $aComponent->getID(); ?>"><?php echo $aComponent->getName(); ?></option>
							<?php endforeach; ?>
							</optgroup>
						<?php endif; ?>
					</select>
					&nbsp;
					<input type="submit" value="<?php echo __('Add user'); ?>">
				</form>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p class="faded_medium" style="padding: 2px 0 0 10px;"><?php echo __('Could not find any users based on your search criteria'); ?></p>
	<?php endif;?>
<?php endif; ?>
<div style="padding: 10px 0 10px 0; display: none;" id="assign_dev_indicator"><span style="float: left;"><?php echo image_tag('spinning_16.gif'); ?></span>&nbsp;<?php echo __('Please wait'); ?></div>