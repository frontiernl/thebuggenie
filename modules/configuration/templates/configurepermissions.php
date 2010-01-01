<?php

	$bugs_response->setTitle(__('Configure permissions'));
	$bugs_response->addJavascript('config/permissions.js');

?>
<table style="table-layout: fixed; width: 100%" cellpadding=0 cellspacing=0>
	<tr>
		<?php include_component('configleftmenu', array('selected_section' => 5)); ?>
		<td valign="top">
			<div style="width: 750px;" id="config_permissions">
				<div class="configheader"><?php echo __('Configure permissions'); ?></div>
				<div class="rounded_box borderless" style="margin: 5px 0px 10px 0px; width: 750px;">
					<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
					<div class="xboxcontent" style="text-align: left; min-height: 85px;">
						<div class="header_div smaller" style="margin: 0 0 5px 0;"><?php echo __('Icon legend:'); ?></div>
						<div style="clear: both;">
							<?php echo image_tag('permission_unset_ok.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Not set (permissive system setting)'); ?></span>
							<?php echo image_tag('permission_unset_denied.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Not set (restrictive system setting)'); ?></span>
							<?php echo image_tag('permission_set_unset.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Not set (uses global permission)'); ?></span>
						</div>
						<div style="clear: both;">
							<?php echo image_tag('permission_set_ok.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Allowed'); ?></span>
							<?php echo image_tag('permission_set_denied.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Denied'); ?></span>
						</div>
						<div style="clear: both; padding: 10px 0 5px 5px;">
							<?php echo tbg_parse_text(__("Edit all global, group and team permissions from this page - user-specific permissions are handled from the user configuration page. The Bug Genie permissions are thoroughly explained in [[ConfigurePermissions]] in the wiki - look it up if you're ever stuck.")); ?>
						</div>
					</div>
					<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
				</div>
				<div style="margin: 10px 0 0 0; clear: both; height: 30px;" class="tab_menu">
					<ul id="permissions_tabs">
						<li class="selected" id="tab_general"><a onclick="switchSubmenuTab('tab_general', 'permissions_tabs');" href="javascript:void(0);"><?php echo __('General permissions'); ?></a></li>
						<li id="tab_pages"><a onclick="switchSubmenuTab('tab_pages', 'permissions_tabs');" href="javascript:void(0);"><?php echo __('Page access permissions'); ?></a></li>
						<li id="tab_projects"><a onclick="switchSubmenuTab('tab_projects', 'permissions_tabs');" href="javascript:void(0);"><?php echo __('Project-specific permissions'); ?></a></li>
					</ul>
				</div>
				<div id="permissions_tabs_panes">
					<div id="tab_general_pane" class="tab_pane">
						<p><?php echo __('These permissions control what you can do in The Bug Genie. Some of these permissions are also available as project-specific permissions, from the "%project_specific_permissions%" tab.', array('%project_specific_permissions%' => '<i>'.__('Project-specific permissions').'</i>')); ?></p>
						<ul>
							<?php include_template('configuration/permissionsblock', array('base_id' => 'general_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('configuration'), 'mode' => 'configuration', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
							<?php include_template('configuration/permissionsblock', array('base_id' => 'general_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('general'), 'mode' => 'general', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
							<?php include_template('configuration/permissionsblock', array('base_id' => 'general_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('issues'), 'mode' => 'general', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
						</ul>
					</div>
					<div id="tab_pages_pane" class="tab_pane" style="display: none;">
						<p><?php echo __('These permissions control which pages you can access in The Bug Genie. Some of these permissions are also available as project-specific permissions, from the "%project_specific_permissions%" tab.', array('%project_specific_permissions%' => '<i>'.__('Project-specific permissions').'</i>')); ?></p>
						<ul>
							<?php include_template('configuration/permissionsblock', array('base_id' => 'page_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('pages'), 'mode' => 'pages', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
							<?php include_template('configuration/permissionsblock', array('base_id' => 'page_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('project_pages'), 'mode' => 'pages', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
						</ul>
					</div>
					<div id="tab_projects_pane" class="tab_pane" style="display: none;">
						<p><?php echo __('These permissions control what you can do, and which pages you can access in The Bug Genie - on a project-specific basis. Some of these permissions are also available as site-wide permissions, from the "%general_permissions%" tab.', array('%general_permissions%' => '<i>'.__('General permissions').'</i>')); ?></p>
						<?php if (count(BUGSproject::getAll()) > 0): ?>
							<ul>
								<?php foreach (BUGSproject::getAll() as $project): ?>
									<li>
										<a href="javascript:void(0);" onclick="$('project_permission_details_<?php echo $project->getID(); ?>').toggle();"><?php echo image_tag('icon_project_permissions.png', array('style' => 'float: right;')); ?><?php echo $project->getName(); ?> <span class="faded_medium smaller"><?php echo $project->getKey(); ?></span></a>
										<ul style="display: none;" id="project_permission_details_<?php echo $project->getID(); ?>">
											<?php include_template('configuration/permissionsblock', array('base_id' => 'project_' . $project->getID() . '_project_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('project'), 'mode' => 'general', 'target_id' => $project->getID(), 'module' => 'core', 'access_level' => $access_level)); ?>
											<?php include_template('configuration/permissionsblock', array('base_id' => 'project_' . $project->getID() . '_page_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('project_pages'), 'mode' => 'pages', 'target_id' => $project->getID(), 'module' => 'core', 'access_level' => $access_level)); ?>
											<?php include_template('configuration/permissionsblock', array('base_id' => 'project_' . $project->getID() . '_issue_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('issues'), 'mode' => 'general', 'target_id' => $project->getID(), 'module' => 'core', 'access_level' => $access_level)); ?>
										</ul>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php else: ?>
							<div class="faded_medium" style="padding: 2px;"><?php echo __('There are no projects'); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>