<?php
/**
 * @package HitstepsStats
 * @subpackage HitstepsChatWidget
 * @copyright Copyright (c)2013-2015 Hitsteps
 * @license GNU General Public License version 3, or later
 * @since 2.06
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');
jimport('joomla.html.parameter');

$wdimg="";
$wdoff="";
$lang="";
$floating=1;


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

@    $wdimg = $pluginParams['wdimg'];
@    $wdoff = $pluginParams['wdoff'];
@    $lang = $pluginParams['hitsteps_lang'];
@    $floating = $pluginParams['hitsteps_floatingchat'];

?>
<?php if ($hpar!=''){ ?>
<!-- HITSTEPS ONLINE SUPPORT CODE v2.06 Joomla - DO NOT CHANGE -->
<div align="center">
<script src="<?php echo $purl; ?>hitsteps.com/online.php?code=<?php echo $hitstepsapi; ?>&img=<?php echo urlencode($wdimg); ?>&lang=<?php echo urlencode($lang); ?>&off=<?php echo urlencode($wdoff); ?>" type="text/javascript" ></script>
<?php if (round($floating)==1){ ?><script src="<?php echo $purl; ?>hitsteps.com/onlinefloat.php?code=<?php echo $hitstepsapi; ?>&img=<?php echo urlencode($wdimg); ?>&lang=<?php echo urlencode($lang); ?>&off=<?php echo urlencode($wdoff); ?>" type="text/javascript" ></script><?php } ?>
</div>
<!-- HITSTEPS ONLINE SUPPORT CODE - DO NOT CHANGE -->
<?php } ?>
