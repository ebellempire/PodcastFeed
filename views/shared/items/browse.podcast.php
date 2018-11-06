<?php
$location = WEB_ROOT.'/items/browse?output=podcast';	
$podcast_link = get_option('podcast_link') ? get_option('podcast_link') : WEB_ROOT.'/';
$podcast_author = get_option('podcast_author') ? get_option('podcast_author') : option('site_title');
$podcast_title = get_option('podcast_title') ? get_option('podcast_title') : option('site_title');
$podcast_email = get_option('podcast_email') ? get_option('podcast_email') : option('administrator_email');
$podcast_image_url = get_option('podcast_image_url') ? get_option('podcast_image_url') : null;
$podcast_description = get_option('podcast_description') ? get_option('podcast_description') : null;
$podcast_language = get_option('podcast_language') ? get_option('podcast_language') : null;

/**
 * Create the parent feed
 */
$feed = new Zend_Feed_Writer_Feed;
$feed->setTitle($podcast_title);
$feed->setLink($podcast_link);
$feed->setFeedLink($location, 'rss');
$feed->setImage(array(
	'uri'	=> $podcast_image_url,
	'link'	=> $podcast_image_url,
	'title'	=> $podcast_title,
));
$feed->setLanguage($podcast_language);
$feed->setDescription($podcast_description);
$feed->addAuthor(array(
	'name'  => $podcast_author,
	'uri'   => WEB_ROOT,
	'email' => $podcast_email,
));
$feed->setDateModified(time());
$feed->addHub('https://pubsubhubbub.appspot.com/');

/**
 * Create the entries
 */ 
foreach( loop( 'items' ) as $item )
{
	if($item->getItemType()['name'] == 'Podcast Episode'){
		$title=  metadata( $item, array( 'Dublin Core', 'Title' ) ) ? metadata( $item, array( 'Dublin Core', 'Title' ) ) : 'Untitled';
		$url = WEB_ROOT.'/items/show/'.$item->id;
		$desc=metadata($item,array('Dublin Core','Description'));
	
		$entry = $feed->createEntry();
			$entry->setTitle($title);
			$entry->setLink($url);
			$entry->addAuthor(array('name'  => $podcast_author));
			$entry->setDateModified(strtotime($item->modified));
			$entry->setDateCreated(strtotime($item->added));
			$entry->setContent($desc);
		$feed->addEntry($entry);		
	}
}

/**
 * Render the resulting feed
 */
echo $feed->export('rss');