<?php
class PodcastFeedPlugin extends Omeka_Plugin_AbstractPlugin{

	protected $_hooks = array(
		'install',
		'uninstall',
		'config_form',
		'config',
	);

	protected $_filters = array(
		'response_contexts',
		'action_contexts',
	);
		
	protected $_options = array(
		'podcast_image_url'=>null,
		'podcast_title'=>null,
		'podcast_author'=>null,
		'podcast_description'=>null,
		'podcast_language'=>null,
		'podcast_link'=>null,
		'podcast_email'=>null,
		'podcast_category'=>null,
	);
	
    public function hookConfigForm(){
        require dirname(__FILE__) . '/config_form.php';
    }	
    
    public function hookConfig(){
        set_option('podcast_image_url', $_POST['podcast_image_url']);
		set_option('podcast_title', $_POST['podcast_title']);
        set_option('podcast_author', $_POST['podcast_author']);
        set_option('podcast_description', $_POST['podcast_description']);
        set_option('podcast_language', $_POST['podcast_language']);
        set_option('podcast_link', $_POST['podcast_link']);
        set_option('podcast_email', $_POST['podcast_email']);
        set_option('podcast_category', $_POST['podcast_category']);
    }	    
    	
	public function filterResponseContexts( $contexts ){
		$contexts['podcast'] = array(
			'suffix' => 'podcast',
			'headers' => array( 
				'Content-Type' => 'text/xml',
				'Access-Control-Allow-Origin'=>'*' ) 
			);
		return $contexts;
	}
	
	public function filterActionContexts( $contexts, $args ){
		$controller = $args['controller'];

		if( is_a( $controller, 'ItemsController' ) ){
			$contexts['browse'][] = 'podcast' ;
		}
		return $contexts;
	}
	
    public function hookInstall(){		
		// Plugin Settings
		$this->_installOptions(); 
		// Item Type Definition
		$PodcastItemType = array(
			'name'=> 'Podcast Episode',
			'description' => 'Serialized audio content, delivered via web syndication.',
		);	
		$podcastElements=array(
			array(
				'name'=>'Explicit',
				'description'=>'Enter "Yes" or "No" to indicate whether this episode contains explicit language or topics.',
				'order'=>1
			),			
		);	
		// Item Type Elements to be added
		$add_elements=array();
		foreach($podcastElements as $element){
			if(!element_exists('Item Type Metadata',$element['name'])){
				$add_elements[]=$element;
			}else{
				$ElementObj=get_record('Element',array(
					'elementSet'=>'Item Type Metadata',
					'name'=>$element['name']));
				$add_elements[]=$ElementObj;
			}
		}
		// Add Item Type and Item Type Elements	 
		$itemTypeExists=get_record('ItemType',array('name'=>$PodcastItemType['name'])); 
		if(!$itemTypeExists){		
			insert_item_type($PodcastItemType,$add_elements);
		}else{
			$itemTypeExists->addElements($add_elements);
			$itemTypeExists->save();
		}			 
    }

    public function hookUninstall(){        
		$this->_uninstallOptions();	
    }		

}