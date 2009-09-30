<?php
/**
 * Elgg shared access plugin
 * 
 * @package ElggSharedAccess
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Curverider Ltd
 * @copyright Curverider Ltd 2008-2009
 * @link http://elgg.com/
 * @author Brett Profitt
 */

$user = $vars['user'];

$body = elgg_view_title(elgg_echo('shared_access:shared_access'));

$new_collection_link = "<a href=\"{$vars['url']}pg/shared_access/new\" class='new_collection_button'>" . elgg_echo('shared_access:new_collection') . "</a>";

// grab invitations
$sacs = get_entities_from_relationship('shared_access_invitation', $user->getGUID());
$sacs_html = '';
foreach ($sacs as $sac) {
	$sacs_html .= elgg_view('shared_access/collection', array('sac'=>$sac, 'user'=>$user, 'invitation'=>true));
}

// grab all sacs
$sacs = get_entities_from_relationship('shared_access_member', $user->getGUID());
foreach ($sacs as $sac) {
	$sacs_html .= elgg_view('shared_access/collection', array('sac'=>$sac, 'user'=>$user));
}

if ($sacs_html == '') {
	$sacs_html = elgg_echo('shared_access:no_shared_access_collections');
}

$body = "<div id='collections_page_head'>" . $new_collection_link . $body ."</div>" . $sacs_html;

$boxes = elgg_view('shared_access/sidebar/new_collection');
echo elgg_view_layout('sidebar_boxes', $boxes, $body);