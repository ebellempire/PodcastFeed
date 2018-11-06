<?php
/**
 * Helpers
 */
require_once 'helpers.php';

// Channel variables
$location = WEB_ROOT.'/items/browse?output=podcast';	
$podcast_link = get_option('podcast_link') ? get_option('podcast_link') : WEB_ROOT.'/';
$podcast_author = get_option('podcast_author') ? get_option('podcast_author') : option('site_title');
$podcast_title = get_option('podcast_title') ? get_option('podcast_title') : option('site_title');
$podcast_email = get_option('podcast_email') ? get_option('podcast_email') : option('administrator_email');
$podcast_image_url = get_option('podcast_image_url') ? get_option('podcast_image_url') : null;
$podcast_description = get_option('podcast_description') ? get_option('podcast_description') : null;
$podcast_language = get_option('podcast_language') ? get_option('podcast_language') : null;
$podcast_category = get_option('podcast_category') ? get_option('podcast_category') : null; // @TODO: add multiple category support
$podcast_copyright = date('Y').' '.$podcast_title; // @TODO: add option

/**
 * Create the parent channel feed
 */
 
$itunesns='http://www.itunes.com/dtds/podcast-1.0.dtd'; 
$atomns='http://www.w3.org/2005/Atom';

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" 
xmlns:atom="http://www.w3.org/2005/Atom" />');  


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
	$image->addChild('title',$podcast_title);
	$image->addChild('link',$podcast_link);
	
$owner=$channel->addChild('owner','', $itunesns); 
	$owner->addChild('email',$podcast_email, $itunesns); 
	$owner->addChild('name',$podcast_title, $itunesns); 

$cat=$channel->addChild('category','',$itunesns); 
$cat->addAttribute('text',$podcast_category); 

$channel->addChild('author',$podcast_author, $itunesns); 
$channel->addChild('type','episodic', $itunesns); // episodic or serial @TODO: add option

/**
 * Create the entries
 */ 
foreach( loop( 'items' ) as $item ){
	if($item->getItemType()['name'] == 'Podcast Episode'){
		
		// Item Variables
		$episode_title=  metadata( $item, array( 'Dublin Core', 'Title' ) ) ? metadata( $item, array( 'Dublin Core', 'Title' ) ) : 'Untitled';
		$episode_url = WEB_ROOT.'/items/show/'.$item->id;
		$episode_guid=$url;
		$episode_description=metadata($item,array('Dublin Core','Description'));
		$episode_is_explicit=($e=metadata($item,array('Item Type Metadata','Explicit'))) ? $e : 'no';
		
		// File Enclosure variables
		foreach( loop('files', $item->Files ) as $file ){

			if(enclosureIsMP3(metadata($file, 'MIME Type'))){
				$enclosure_url=file_display_url($file,'original');
				$enclosure_type=metadata($file, 'MIME Type');
				$enclosure_size = metadata($file, 'Size');	
				$mp3 = new MP3File($enclosure_url);
				$getDuration = $mp3->getDuration();
				$enclosure_duration = MP3File::formatTime($getDuration);	
				continue; // ...we have a file so stop the loop here		
			}
			
		}
		
		if($enclosure_url){
			
			$episode = $channel->addChild('item'); 
			$episode->addChild('link',$episode_url); 
			$episode->addChild('pubDate',strtotime($item->modified)); 
			$episode->addChild('title',$episode_title); 
			$episode->addChild('description',$episode_description); 
			$episode->addChild('summary',$episode_description,$itunesns); 
			$episode->addChild('guid',$episode_guid);
			$episode->addChild('explicit',$episode_is_explicit,$itunesns); 	
			$episode->addChild('duration',$enclosure_duration,$itunesns); 
			
			$enclosure=$episode->addChild('enclosure',''); 
			$enclosure->addAttribute('url',$enclosure_url); 
			$enclosure->addAttribute('length',$enclosure_size); 
			$enclosure->addAttribute('type',$enclosure_type); 
		
		} 
					
	}
}

/**
 * Render the resulting feed
 */
header('Content-type: text/xml'); 
$output=$xml->asXML(); 
echo $output; 