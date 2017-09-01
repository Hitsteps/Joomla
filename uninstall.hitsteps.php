<?php
/**
 * @package hitsteps
 * @copyright Copyright (c)2009-2013 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 * @version $Id: uninstall.hitsteps.php 712 2013-06-07 09:47:53Z nikosdion $
 * @since 3.0
 */

// no direct access
defined('_JEXEC') or die('');

if( version_compare( JVERSION, '1.6.0', 'ge' ) && !defined('_hitsteps_HACK') ) {
	return;
} else {
	global $hitsteps_installation_has_run;
	if($hitsteps_installation_has_run) return;
}

jimport('joomla.installer.installer');
@$db = & JFactory::getDBO();
$status = new JObject();
$status->modules = array();
$status->plugins = array();
$src = $this->parent->getPath('source');

# ----- hitsteps admin widget module
if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `element` = "mod_jhitstepsadmin" AND `type` = "module"');
} else {
	$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_jhitstepsadmin"');
}
$id = $db->loadResult();
if($id)
{
	$installer = new JInstaller;
	$result = $installer->uninstall('module',$id,1);
	$status->modules[] = array('name'=>'mod_jhitstepsadmin','client'=>'administrator', 'result'=>$result);
}
# ----- hitsteps stats module
if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `element` = "mod_jhitstepsstats" AND `type` = "module"');
} else {
	$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_jhitstepsstats"');
}
$id = $db->loadResult();
if($id)
{
	$installer = new JInstaller;
	$result = $installer->uninstall('module',$id,1);
	$status->modules[] = array('name'=>'mod_jhitstepsstats','client'=>'site', 'result'=>$result);
}

# ----- hitsteps chat module
if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `element` = "mod_jhitstepschat" AND `type` = "module"');
} else {
	$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_jhitstepschat"');
}
$id = $db->loadResult();
if($id)
{
	$installer = new JInstaller;
	$result = $installer->uninstall('module',$id,1);
	$status->modules[] = array('name'=>'mod_jhitstepsadmin','client'=>'site', 'result'=>$result);
}

# ----- hitsteps plugin
if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "jhitsteps" AND `folder` = "system"');
} else {
	$db->setQuery('SELECT `id` FROM #__plugins WHERE `element` = "jhitsteps" AND `folder` = "system"');
}
$id = $db->loadResult();
if($id)
{
	$installer = new JInstaller;
	$result = $installer->uninstall('plugin',$id,1);
	$status->plugins[] = array('name'=>'plg_srp','group'=>'system', 'result'=>$result);
}

$hitsteps_installation_has_run = true;
?>

<?php $rows = 0;?>
<h2><?php echo JText::_('hitsteps Uninstallation Status'); ?></h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('Extension'); ?></th>
			<th width="30%"><?php echo JText::_('Status'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo 'hitsteps '.JText::_('Component'); ?></td>
			<td><strong><?php echo JText::_('Removed'); ?></strong></td>
		</tr>
		<?php if (count($status->modules)) : ?>
		<tr>
			<th><?php echo JText::_('Module'); ?></th>
			<th><?php echo JText::_('Client'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->modules as $module) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo ($module['result'])?JText::_('Removed'):JText::_('Not removed'); ?></strong></td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
		<?php if (count($status->plugins)) : ?>
		<tr>
			<th><?php echo JText::_('Plugin'); ?></th>
			<th><?php echo JText::_('Group'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->plugins as $plugin) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo ($plugin['result'])?JText::_('Removed'):JText::_('Not removed'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
