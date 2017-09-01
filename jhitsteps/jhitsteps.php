<?php
/**
# Hitsteps Live Stats - hitsteps Code module for Joomla
#
# @version	V2.06
# @author	Hitsteps <sales@hitsteps.com>
# @link		http://www.hitsteps.com
# @copyright 	Copyright (C) 2013 Hitsteps. All rights reserved.
# @license 	http://www.gnu.org/copyleft/gpl.html GNU/GPL
# 
# Hitsteps Live Stats is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
# 
# Hitsteps Live Stats is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with Hitsteps Live Stats.  If not, see <http://www.gnu.org/licenses/>.
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.plugin.plugin');



class plgSystemjhitsteps extends JPlugin
{


	

	function onAfterRender()
	{
		$mainframe = JFactory::getApplication();


@		$document	=& JFactory::getDocument();
		$doctype	= $document->getType();
@		$user       =&JFactory::getUser();
		$username       =&JFactory::getUser()->name;

		// Only render for HTML output
		if ( $doctype !== 'html' ) { return; }
		
		// Don't show if admin tracking is off and we're in admin
		if ($mainframe->isAdmin() && $this->params->get('hitsteps_trackadmin', 0) == 0) return;


		ob_start();

		
		$hitstepsapi = substr($this->params->get('hitstepsapi', ''),0,32);
		$lang = $this->params->get('hitsteps_lang', '');


		if ($hitstepsapi=='') {
		} else { 

    		if ($this->params->get('hitsteps_trackemails', 0)==1) {
    		    echo "
                <script type='text/javascript'>\n
                  tag='".addslashes($user->get('email'))."';
                 </script>\n";
    		}
    		if ($this->params->get('hitsteps_trackname', 1)==1) {
    		if ($username!=''){
    		    echo "
                <script type='text/javascript'>\n
                  ipname='".addslashes($username)."';
                 </script>\n";    		}
                 }
    		
$purl='http://www.';
$htssl='';
if (isset($_SERVER["HTTPS"])){
if ($_SERVER["HTTPS"]=='on'){
$purl='https://';
$htssl=" - SSL";
}
}





$keyword[0]='Realtime Web Statistics';
$keyword[1]='website statistics';
$keyword[2]='website tracking software';
$keyword[3]='website tracking';
$keyword[4]='blog statistics';
$keyword[5]='blog tracking';
$keyword[6]='Realtime website statistics';
$keyword[7]='Realtime website tracking software';
$keyword[8]='Realtime website tracking';
$keyword[9]='Realtime blog statistics';
$keyword[10]='Realtime blog tracking';
$keyword[11]='free website tracking';
$keyword[12]='visitor activity tracker';
$keyword[13]='visitor activity monitoring';
$keyword[14]='visitor activity monitor';
$keyword[15]='user activity tracking';
$keyword[16]='website analytics';
$keyword[17]='blog analytics';
$keyword[18]='visitor analytics';
$keyword[19]='web stats';
$keyword[20]='web stats';
$keyword[21]='web stats';
$keyword[22]='web stats';
$keyword[23]='web stats';
$keyword[24]='web stats';
$keyword[25]='web stats';
$keyword[26]='web statistics';
$keyword[27]='web statistics';
$keyword[28]='web statistics';
$keyword[29]='web statistics';
$keyword[30]='web statistics';
$keyword[31]='web statistics';
$keyword[32]='web statistics';
$keyword[33]='web stats';
$keyword[34]='web stats';
$keyword[35]='web stats';

$hpublish='';
/*
    $module = &JModuleHelper::getModule('mod_jhitstepsstats');
    $param = $module->position; 
if ($param){$hpublish='publish=1&';}else{
//joomla 1.5 compatibility
    $module = &JModuleHelper::getModule('jhitstepsstats');
@    $param = $module->position; 
if ($param){$hpublish='publish=1&';};
}
*/



$hitstepsscript = '
<!-- HITSTEPS TRACKING CODE'.$htssl.' - Joomla - v2.06 - DO NOT CHANGE -->
<script type="text/javascript">
(function(){
var hstc=document.createElement("script");
hstc.src="'.$purl.'hitsteps.com/track.php?code='.$hitstepsapi.'&lang='.urlencode($lang).'";
hstc.async=true;
var htssc = document.getElementsByTagName("script")[0];
htssc.parentNode.insertBefore(hstc, htssc);
})();
</script>
<noscript><a href="http://www.hitsteps.com/"><img src="'.$purl.'hitsteps.com/track.php?mode=img&code='.$hitstepsapi.'" alt="'.$keyword[mt_rand(0,35)].'" />'.$keyword[mt_rand(0,35)].'</a></noscript>
<!-- HITSTEPS TRACKING CODE'.$htssl.' - DO NOT CHANGE -->
			';
echo $hitstepsscript;

    }
    
		$output = ob_get_clean();





		$body = JResponse::getBody();
		$body = str_replace('</body>', $output.'</body>', $body);
		JResponse::setBody($body);


   }


}
?>
