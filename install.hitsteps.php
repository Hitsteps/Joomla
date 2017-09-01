<?php
/**
 * @package jhitsteps
 * @copyright Copyright (c)2013-2015 Hitsteps
 * @license GNU General Public License version 3, or later
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

// Install modules and plugins -- BEGIN

// -- General settings
jimport('joomla.installer.installer');
@$db = & JFactory::getDBO();
$status = new JObject();
$status->modules = array();
$status->plugins = array();
if(version_compare(JVERSION, '1.6.0', 'ge')) {
	// Joomla 1.6 Beta 13 removed installer?
	$src = dirname(__FILE__);
} else {
	$src = $this->parent->getPath('source');
}

// -- Plugin
$installer = new JInstaller;
$result = $installer->install($src.'/jhitsteps');
$status->plugins[] = array('name'=>'jhitsteps','group'=>'system', 'result'=>$result);

if(version_compare(JVERSION,'1.6.0','ge')) {
$query = 'update `extension_id` set enabled=1 FROM #__extensions WHERE `type` = "plugin" AND `element` = "jhitsteps" AND `folder` = "system"';
} else {
	$db->setQuery('update FROM #__plugins set enabled=1 WHERE `element` = "jhitsteps" AND `folder` = "system"');
}
$db->setQuery($query);



// -- Live Support module
$installer = new JInstaller;
$result = $installer->install($src.'/mod_jhitstepschat');
$status->modules[] = array('name'=>'Hitsteps Live Support Module','client'=>'site', 'result'=>$result);

// -- Stats module
$installer = new JInstaller;
$result = $installer->install($src.'/mod_jhitstepsstats');
$status->modules[] = array('name'=>'Hitsteps Statistics Widget','client'=>'site', 'result'=>$result);

// -- Admin Widget module
$installer = new JInstaller;
$result = $installer->install($src.'/mod_jhitstepsadmin');
$status->modules[] = array('name'=>'Hitsteps Admin Panel Dashboard','client'=>'administrator', 'result'=>$result);

$query = "UPDATE #__modules SET position='cpanel', ordering=-1, published=1 WHERE `module`='mod_jhitstepsadmin'";
$db->setQuery($query);
$db->query();

$query = "SELECT `id` FROM `#__modules` WHERE `module` = 'mod_jhitstepsadmin'";
$db->setQuery($query);
$modID = $db->loadResult();

//$query = "REPLACE INTO `#__modules_menu` (`moduleid`,`menuid`) VALUES ($modID, 0)";
//$db->setQuery($query);
//$db->query();

// Install modules and plugins -- END

// Finally, show the installation results form


# ----- hitsteps plugin
if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "jhitsteps" AND `folder` = "system"');
} else {
	$db->setQuery('SELECT `id` FROM #__plugins WHERE `element` = "jhitsteps" AND `folder` = "system"');
}
$id = $db->loadResult();

//enable them
$db->setQuery('update #__extensions set `enabled`="1" WHERE `element` = "jhitsteps";');
$db->query();
$db->setQuery('update #__extensions set `enabled`="1" WHERE `element` = "mod_jhitstepschat" ;');
$db->query();
$db->setQuery('update #__extensions set `enabled`="1" WHERE `element` = "mod_jhitstepsstats" ;');
$db->query();
$db->setQuery('update #__extensions set `enabled`="1" WHERE `element` = "mod_jhitstepsadmin" ;');
$db->query();
$db->setQuery('update #__extensions set `enabled`="1" WHERE `element` = "com_hitstepsanalytics" ;');
$db->query();

//get admin module id
$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_jhitstepsadmin"');
$amid = $db->loadResult();
//enable it
if ($amid>0){
$db->setQuery('replace into #__modules_menu (`moduleid`,`menuid`) values ('.$amid.',0);');
$db->query();
}

//get stats module id
$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_jhitstepsstats"');
$amid = $db->loadResult();
//enable it
if ($amid>0){
$db->setQuery('replace into #__modules_menu (`moduleid`,`menuid`) values ('.$amid.',0);');
$db->query();
}
//get chat module id
$db->setQuery('SELECT `id` FROM #__modules WHERE `module` = "mod_jhitstepschat"');
$amid = $db->loadResult();
//enable it
if ($amid>0){
$db->setQuery('replace into #__modules_menu (`moduleid`,`menuid`) values ('.$amid.',0);');
$db->query();
}


?>

<img src="components/com_hitstepsanalytics/logo-48.png" width="48" height="48" alt="Hitsteps" align="left" />
<a target="_blank" href="http://www.hitsteps.com/?tag=joomla-to-homepage"><h1>Hitsteps Analytics - an eye on your site</h1></a><br>

<div class="tdhdr">
Hitsteps realtime visitor activity tracker and analytics, allows you to be aware what is going in your websites right now and has detailed archive for tracked visitor data. <br>
If you don't have an API code yet, you can get 
your free trial one at <a href="http://www.hitsteps.com/?tag=joomla-to-ht">hitsteps.com</a>.<br><br><a href="http://www.hitsteps.com/register.php?tag=wp-getyourcode" target="_blank" class="btn btn-primary">Get your API code</a><br><small>Each site has it's own API Code. It Looks like 3defb4a2e4426642ea... and can be found in setting page of hitsteps.com</small><br><h2>How configure Hitsteps at Joomla?</h2>

Just <a href="http://www.hitsteps.com/register.php?tag=joomla-to-ht-reg">Sign up 
for a Hitsteps account</a> and follow registration steps.<br>
LThen when you login to your hitsteps account, Add your website address and you'll see hitsteps setting page, you can see your Hitsteps API code there.<br>
<?php if (0==1){ ?><a href="index.php?option=com_plugins&view=plugin&layout=edit&extension_id=<?php echo $id; ?>"><?php } ?>Open Hitsteps plugin in Joomla's Plugin manager.</a>, Search for "Hitsteps" in Plugin Manager and<br>Enter that API Code in Basic options panel field of Joomla plugin page and enable plugin.<br>All your Visitors information will be tracked and logged in real-time and you can monitor them in your hitsteps.com dashboard, Real-time! and it have more to offer!</p>
	<p class="submit"><a href="http://www.hitsteps.com/features.php" target="_blank" class="btn">view Hitsteps features</a></p>
<p class="submit">Hitsteps also support normal websites ( non joomla based 
) which you can see code in hitsteps.com setting page.<br><br>For Step-by-Step instruction on how install this joomla plugin, please visit <a href="http://www.hitsteps.com/plugin/?type=joomla" class="btn" target="_blank" >our official guide</a>.
</divP>
	
	
<style>
.tdhdr{
	-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px; border: 1px solid #bbb;background-color: #ffffff;padding: 10px;
	background-image: -webkit-gradient(
    linear,
    left bottom,
    left top,
    color-stop(0, rgb(241,241,241)),
    color-stop(1, rgb(250,250,250))
);
background-image: -moz-linear-gradient(
    center bottom,
    rgb(241,241,241) 0%,
    rgb(250,250,250) 100%
);

background-image: -o-linear-gradient(
       top,
       rgb(250,250,250) 48%,
       rgb(241,241,241) 52%
);


/* For Internet Explorer 5.5 - 7 */
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFDFDFD, endColorstr=#FFF1F1F1);
/* For Internet Explorer 8 */
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFDFDFD, endColorstr=#FFF1F1F1)";



}
.tdhdrw{
	-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px; border: 1px solid #bbb;background-color: #ffffff;padding: 10px;
	background-image: -webkit-gradient(
    linear,
    left bottom,
    left top,
    color-stop(0, rgb(248,248,248)),
    color-stop(1, rgb(255,255,255))
);
background-image: -moz-linear-gradient(
    center bottom,
    rgb(248,248,248) 0%,
    rgb(255,255,255) 100%
);
background-image: -o-linear-gradient(
       top,
       rgb(255,255,255) 48%,
       rgb(248,248,248) 52%
);



/* For Internet Explorer 5.5 - 7 */
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF, endColorstr=#FFF8F8F8);
/* For Internet Explorer 8 */
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF, endColorstr=#FFF8F8F8)";
}
</style>

<div class="tdhdrw">
<table class="adminlist" style="width: 50%; font-size: 9pt; margin: 15px; border: 1px solid #eaeaea; border-radius: 5px;">
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
			<td><strong><?php echo JText::_('Installed'); ?></strong></td>
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
			<td><strong><?php echo ($module['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
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
			<td><strong><?php echo ($plugin['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
</div>
<fieldset>
	<p>
	</p>
	<p>
		<?php JText::_('COM_hitsteps_JText::_6') ?>
	</p>
</fieldset>
