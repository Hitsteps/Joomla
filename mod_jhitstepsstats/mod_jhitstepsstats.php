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

@    $instance['hitsteps_online'] = $pluginParams['hitsteps_online']; 
@    $instance['hitsteps_visit'] = $pluginParams['hitsteps_visit']; 
@    $instance['hitsteps_pageview'] = $pluginParams['hitsteps_pageview']; 
@    $instance['hitsteps_unique'] = $pluginParams['hitsteps_unique']; 
@    $instance['hitsteps_returning'] = $pluginParams['hitsteps_returning']; 
@    $instance['hitsteps_new_visit'] = $pluginParams['hitsteps_new_visit']; 
@    $instance['hitsteps_yesterday_visit'] = $pluginParams['hitsteps_yesterday_visit']; 
@    $instance['hitsteps_yesterday_pageview'] = $pluginParams['hitsteps_yesterday_pageview']; 
@    $instance['hitsteps_yesterday_unique'] = $pluginParams['hitsteps_yesterday_unique']; 
@    $instance['hitsteps_yesterday_return'] = $pluginParams['hitsteps_yesterday_return']; 
@    $instance['hitsteps_yesterday_new_visit'] = $pluginParams['hitsteps_yesterday_new_visit']; 
@    $instance['hitsteps_total_visit'] = $pluginParams['hitsteps_total_visit']; 
@    $instance['hitsteps_total_pageview'] = $pluginParams['hitsteps_total_pageview']; 
@    $instance['credits'] = $pluginParams['credits']; 
@    $instance['affid'] = $pluginParams['affid']; 
@    $instance['use_theme'] = $pluginParams['use_theme']; 

?>
<?php if ($hpar!=''){ ?>

<script src="//www.hitsteps.com/api/widget_stats.php?code=<?php echo $hitstepsapi; ?><?php if (!$instance['hitsteps_online']) { ?>&online=yes<?php } ?><?php if (!$instance['hitsteps_visit']) { ?>&visit=yes<?php } ?><?php if (!$instance['hitsteps_pageview']) { ?>&pageview=yes<?php } ?><?php if (!$instance['hitsteps_unique']) { ?>&unique=yes<?php } ?><?php if (!$instance['hitsteps_returning']) { ?>&returning=yes<?php } ?><?php if (!$instance['hitsteps_new_visit']) { ?>&new_visit=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_visit']) { ?>&yesterday_visit=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_pageview']) { ?>&yesterday_pageview=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_unique']) { ?>&yesterday_unique=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_return']) { ?>&yesterday_return=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_new_visit']) { ?>&yesterday_new_visit=yes<?php } ?><?php if (!$instance['hitsteps_total_visit']) { ?>&total_visit=yes<?php } ?><?php if (!$instance['hitsteps_total_pageview']) { ?>&total_pageview=yes<?php } ?>"></script>

<?php if (!$instance['use_theme']){ ?><style>
.hitsteps_statistic_widget{

background-color: #627AAD;
border: 2px solid #ffffff;
color: #ffffff;
border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;
box-shadow:0 0 8px rgba(82,168,236,.5);-moz-box-shadow:0 0 8px rgba(82,168,236,.6);-webkit-box-shadow:0 0 8px rgba(82,168,236,.5); padding: 10px;
font-size: 8pt;
}
.hitsteps_online{
padding-bottom: 10px;
text-align: center;
}
#hitsteps_online{
font-size: 15pt;
}
.hitsteps_statistics_values{
font-weight: bold;
}
.hitsteps_credits{
text-align: right;
font-size: 8pt;
padding-top: 5px;
}
.hitsteps_credits a{
text-decoration: none;
color: #ffffff;
}
.hitsteps_credits a:hover{
text-decoration: underline;
}
</style><?php } ?>
<?php }else{ ?>Hitsteps API Code has not configured in your Plugin Manager<?php } ?>
