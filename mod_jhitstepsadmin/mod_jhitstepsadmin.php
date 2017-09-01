<?php
/**
 * @package HitstepsStats
 * @subpackage HitstepsAdminWidget
 * @copyright Copyright (c)2013-2015 Hitsteps
 * @license GNU General Public License version 3, or later
 * @since 2.06
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');


@    $plugin = &JPluginHelper::getPlugin('system','jhitsteps');
    if ($plugin){
    $pluginParams = json_decode($plugin->params,true);
    $hpar = $pluginParams['hitstepsapi'];

}else{
//plugin disabled
?><font face="Verdana" style="font-size: 8pt; margin: 5px;">Hitsteps Live Analytics Plugin has been disabled in Plugin Manager.</font>
<?php
return;
}
$purl='http://www.';
if (isset($_SERVER["HTTPS"])&&$_SERVER["HTTPS"]=='on'){
$purl='https://';
$htssl=" - SSL";
}

$hitstepsapi = substr($hpar,0,32);


?>
<?php if ($hpar!=''){ ?>
    <div style="background-color: #ffffff;"><iframe scrollable="no" scrolling="no" name="hit-steps-stat" frameborder="0" border="0" width="100%" height="400" src="<?php echo $purl;?>hitsteps.com/stats/wp3.2.php?code=<?php echo $hpar;?>"><p align="center">
		<a href="http://www.hitsteps.com/stats/dashboard.php?code=<?php echo $hitstepsapi; ?>&tag=joomla-dash-to-hs-dash">
		<span>
		<font face="Verdana" style="font-size: 12pt">Open Hitsteps Dashboard</font></span></a><br>Your Browser IFrame is disabled.</iframe></div>
<?php } else { ?>
Please click on Extention menu, then Plugin manager and configure Hitsteps Live Stats plugin.
<?php } ?>
