<?php
/**
 * @package hitsteps
 * @copyright Copyright (c)2013-2015 Hitsteps
 * @license GNU General Public License version 3, or later
 * @version $Id: hitstepsanalytics.php 712 2013-06-07 09:47:53Z
 * @since 2.06
 */

// no direct access
defined('_JEXEC') or die('');
?><img src="components/com_hitstepsanalytics/logo-48.png" width="48" height="48" alt="Hitsteps" align="left" /><a target="_blank" href="http://www.hitsteps.com/?tag=joomla-to-homepage"><h1>Hitsteps Analytics - an eye on your site</h1></a>
<?php
$purl='http://www.';
if (isset($_SERVER["HTTPS"])&&$_SERVER["HTTPS"]=='on'){
$purl='https://';
$htssl=" - SSL";
}

@    $plugin = &JPluginHelper::getPlugin('system','jhitsteps');
    if ($plugin){
    $pluginParams = json_decode($plugin->params,true);
    $hpar = $pluginParams['hitstepsapi'];
$hitstepsapi = substr($hpar,0,32);

}else{
//plugin disabled
?><font face="Verdana" style="font-size: 8pt; margin: 5px;">Hitsteps Live Analytics Plugin has been disabled in Plugin Manager. Please open Plugin Manager and enable hitsteps's plugin.</font>
<?php

}
?>




Hitsteps realtime visitor activity tracker and analytics, allows you to be aware what is going in your websites right now and has detailed archive for tracked visitor data.
<br>
If you don't have an API code yet, you can get 
your free trial one at <a href="http://www.hitsteps.com/?tag=joomla-to-ht">hitsteps.com</a>.<br><br><a href="http://www.hitsteps.com/register.php?tag=wp-getyourcode" target="_blank" class="btn btn-primary">Get your API code</a><br><small>Each site has it's own API Code. It Looks like 3defb4a2e4426642ea... and can be found in setting page of hitsteps.com</small><br><h2>How configure Hitsteps at Joomla?</h2>

Just <a href="http://www.hitsteps.com/register.php?tag=joomla-to-ht-reg">Sign up 
for a Hitsteps account</a> and follow registration steps.<br>
Then when you login to your hitsteps account, Add your website address and you'll see hitsteps setting page, you can see your Hitsteps API code there.<br>
<?php if ($id){ ?><a href="index.php?option=com_plugins&view=plugin&layout=edit&extension_id=<?php echo $id; ?>"><?php } ?>Open Hitsteps plugin in Joomla's Plugin manager.</a>, Search for "Hitsteps" in Plugin Manager and<br>Enter that API Code in Basic options panel field of Joomla plugin page and enable plugin.<br>All your Visitors information will be tracked and logged in real-time and you can monitor them in your hitsteps.com dashboard, Real-time! and it have more to offer!</p>
	<p class="submit"><a href="http://www.hitsteps.com/features.php" target="_blank" class="btn">View Hitsteps features</a></p>
<p class="submit">Hitsteps also support normal websites ( non joomla based 
) which you can see code in hitsteps.com setting page.<br><br>For Step-by-Step instruction on how install this joomla plugin, please visit <a href="http://www.hitsteps.com/plugin/?type=joomla" class="btn">our official guide</a>.


	
<?php
@$db = & JFactory::getDBO();
if(version_compare(JVERSION,'1.6.0','ge')) {
	$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "jhitsteps" AND `folder` = "system"');
} else {
	$db->setQuery('SELECT `id` FROM #__plugins WHERE `element` = "jhitsteps" AND `folder` = "system"');
}
$id = $db->loadResult();
if ($id){
?><h2><a href="index.php?option=com_plugins&view=plugin&layout=edit&extension_id=<?php echo $id; ?>">Configure Hitsteps Analytics Plugin</a><h2><?php } ?>
<?php if ($hpar!=''){ ?>
    <div style="background-color: #ffffff;"><iframe scrollable="no" scrolling="no" name="hit-steps-stat" frameborder="0" border="0" width="100%" height="400" src="<?php echo $purl;?>hitsteps.com/stats/wp3.2.php?code=<?php echo $hpar;?>"><p align="center">
		<a href="http://www.hitsteps.com/stats/dashboard.php?code=<?php echo $hitstepsapi; ?>&tag=joomla-dash-to-hs-dash">
		<span><font face="Verdana" style="font-size: 12pt">Open Hitsteps Dashboard</font></span></a><br>Your Browser IFrame is disabled.</iframe></div>
<?php } else { ?>
Please click on Extention menu, then Plugin manager and configure Hitsteps Live Stats plugin. Currently, Hitsteps API Code is not configured.
<?php } ?>
	
	
	
