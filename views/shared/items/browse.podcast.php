<?php
// Helpers
require_once 'helpers.php';

// Channel Variables
$location = WEB_ROOT.'/items/browse?output=podcast';
$podcast_link = get_option('podcast_link') ? get_option('podcast_link') : WEB_ROOT.'/';
$podcast_author = get_option('podcast_author') ? get_option('podcast_author') : option('site_title');
$podcast_title = get_option('podcast_title') ? get_option('podcast_title') : option('site_title');
$podcast_email = get_option('podcast_email') ? get_option('podcast_email') : option('administrator_email');
$podcast_image_url = get_option('podcast_image_url') ? get_option('podcast_image_url') : null;
$podcast_description = get_option('podcast_description') ? get_option('podcast_description') : null;
$podcast_language = get_option('podcast_language') ? get_option('podcast_language') : null;
$podcast_categories = get_option('podcast_category') ? get_option('podcast_category') : null; // @TODO: add multiple category support
$podcast_type = get_option('podcast_type') ? get_option('podcast_type') : null;
$podcast_parental_advisory = ($ex=get_option('podcast_parental_advisory')) ? ($ex == 1 ? 'yes' : 'no' ) : 'no';
$podcast_copyright = date('Y').' '.$podcast_title; // @TODO: add option

// XML Namespace Variables
$itunesns='http://www.itunes.com/dtds/podcast-1.0.dtd';
$atomns='http://www.w3.org/2005/Atom';
$contentns="http://purl.org/rss/1.0/modules/content/";

// Create the Parent Channel XML
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:itunes="'.$itunesns.'"
xmlns:atom="'.$atomns.'" xmlns:content="'.$contentns.'"/>');

$channel = $xml->addChild('channel');
$channel->addChild('link',$podcast_link);
$channel->addChild('pubDate',gmdate('r'));
$channel->addChild('language',$podcast_language);
$channel->addChild('webMaster',$podcast_email.' ('.$podcast_author.')');
$channel->addChild('description',$podcast_description);
$channel->addChild('title',$podcast_title);
$channel->addChild('copyright',$podcast_copyright);

$atomlink=$channel->addChild('link','',$atomns);
	$atomlink->addAttribute('href',WEB_ROOT.$_SERVER['REQUEST_URI']);
	$atomlink->addAttribute('rel',"self");
	$atomlink->addAttribute('type',"application/rss+xml");

$image=$channel->addChild('image','');
	$image->addChild('url',$podcast_image_url);

$itunesimage=$channel->addChild('image','',$itunesns);
	$itunesimage->addAttribute('href',$podcast_image_url);
	
$owner=$channel->addChild('owner','', $itunesns);
	$owner->addChild('email',$podcast_email, $itunesns);
	$owner->addChild('name',$podcast_title, $itunesns);

$channel->addChild('author',$podcast_author, $itunesns);
$channel->addChild('type',$podcast_type, $itunesns);
$channel->addChild('explicit',$podcast_parental_advisory, $itunesns);

$cats=explode('>',$podcast_categories);
	$cat=$channel->addChild('category','',$itunesns); 
	$cat->addAttribute('text',trim($cats[0]));
	if( count( $cats ) > 1 ){
		$subcat=$cat->addChild('category','',$itunesns); 
		$subcat->addAttribute('text',trim($cats[1])); 
	}


// Get Podcast Episodes
foreach( loop( 'items' ) as $item ){
	if($item->getItemType()['name'] == 'Podcast Episode'){

		// Item Variables
		$episode_title=  metadata( $item, array( 'Dublin Core', 'Title' ) ) ? metadata( $item, array( 'Dublin Core', 'Title' ) ) : 'Untitled';
		$episode_url = WEB_ROOT.'/items/show/'.$item->id;
		$episode_guid=$episode_url;
		$episode_description=($d=metadata($item,array('Dublin Core','Description'))) ? strip_tags($d,'<p><ol><ul><li><a>') : 'No description';
		$episode_is_explicit=($e=metadata($item,array('Item Type Metadata','Explicit'))) ? $e : false;
		$episode_is_blocked=($b=metadata($item,array('Item Type Metadata','Block'))) ? $b : false;
		$episode_order=($o=metadata($item,array('Item Type Metadata','Episode'))) ? $o : null;
		$episode_type=($t=metadata($item,array('Item Type Metadata','Episode Type'))) ? $t : null;
		$episode_season=($s=metadata($item,array('Item Type Metadata','Season'))) ? $s : null;

		// File Enclosure variables
		foreach( loop('files', $item->Files ) as $file ){
			if(enclosureIsMP3(metadata($file, 'MIME Type'))){
				$enclosure_url=file_display_url($file,'original');
				$enclosure_type=metadata($file, 'MIME Type');
				$enclosure_size = metadata($file, 'Size');
				$f = new MP3File($enclosure_url);
				$d = $f->getDuration();
				$enclosure_duration = MP3File::formatTime($d);
				continue; // ...we have a file so stop the loop here
			}
		}

		if($enclosure_url){

			// Add the Item XML
			$episode = $channel->addChild('item');
			$episode->addChild('link',$episode_url);
			$episode->addChild('pubDate',$item->added);
			$episode->addChild('title',$episode_title);
			$episode->addChild('title',$episode_title,$itunesns);
			$episode->addChild('author',$podcast_author,$itunesns);
			$episode->addChild('guid',$enclosure_url);
			$episode->addChild('duration',$enclosure_duration,$itunesns);
			if($episode_description){
				$episode->addChild('description',$episode_description);
				$episode->addChild('summary',strip_tags($episode_description),$itunesns);
				$episode->addChild('encoded','<![CDATA['.$episode_description.']]',$contentns);
			}
			if(is_numeric($episode_season) && ($episode_season > 0)){
				$episode->addChild('season',$episode_season,$itunesns);
			}
			if(is_numeric($episode_order) && ($episode_order > 0)){
				$episode->addChild('order',$episode_order,$itunesns);
				$episode->addChild('episode',$episode_order,$itunesns);
			}
			if($episode_type && (in_array( strtolower($episode_type), array('full','trailer','bonus') ) ) ){
				$episode->addChild('episodeType',$episode_type,$itunesns);
			}
			if($episode_is_explicit && ( in_array( strtolower($episode_is_explicit), array('yes','explicit','true','no','clean','false') ) ) ){
				$episode->addChild('explicit',$episode_is_explicit,$itunesns);
			}
			if($episode_is_blocked && ( strtolower($episode_is_blocked) == 'yes') ){
				$episode->addChild('block',$episode_is_blocked,$itunesns);
			}
			$enclosure=$episode->addChild('enclosure','');
				$enclosure->addAttribute('url',$enclosure_url);
				$enclosure->addAttribute('length',$enclosure_size);
				$enclosure->addAttribute('type',$enclosure_type);

		}
	}
}

// Render the XML
header('Content-type: text/xml');
$output=$xml->asXML();
echo $output; 