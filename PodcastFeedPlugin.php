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
		'items_browse_per_page',
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
		'podcast_type'=>null,
		'podcast_parental_advisory'=>0,
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
        set_option('podcast_type', $_POST['podcast_type']);
        set_option('podcast_parental_advisory', $_POST['podcast_parental_advisory']);
    }	 
    
	public function filterItemsBrowsePerPage( $perPage ){
		// @TODO: if the loop on items/browse was made more specific (e.g. limited by item type), I wouldn't need this
		if( isset($_GET["output"]) && $_GET["output"] == 'podcast'){
			$perPage=null; // no pagination
		}
		return $perPage;
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
			'description' => 'Serialized or episodic audio content, delivered via web syndication.',
		);	
		$podcastElements=array(
			array(
				'name'=>'Episode',
				'description'=>'The episode number. Specify a non-zero integer (1, 2, 3, etc.) representing your episode number. Use this tag to specify the recommended order for episodes within a season. By default, episodes will appear in descending order from newest to oldest.',
				'order'=>1
			),
			array(
				'name'=>'Season',
				'description'=>'The episode season number. Specify a non-zero integer (1, 2, 3, etc.) representing your season number. If only one season exists in the RSS feed, podcast directories may not display a season number. When you add a second season to the RSS feed, the season numbers will be displayed. If your podcast will not be released on a season schedule, it is recommended to leave this field blank.',
				'order'=>2
			),		
			array(
				'name'=>'Episode Type',
				'description'=>'The episode type. Specify "full" when you are submitting the complete content of your show. Specify "trailer" when you are submitting a short, promotional piece of content that represents a preview of your current show. Specify "bonus" when you are submitting extra content for your show (for example, behind the scenes information or interviews with the cast) or cross-promotional content for another show.',
				'order'=>3
			),					
			array(
				'name'=>'Explicit',
				'description'=>'The episode parental advisory information. If you specify "yes," "explicit," or "true," indicating the presence of explicit content, podcast directories may add an Explicit parental advisory graphic for your episode. Episodes containing explicit material aren’t available in some territories. If you specify "no," "clean," or "false," indicating that the episode does not contain explicit language or adult content, podcast directories may display a Clean parental advisory graphic for your episode.',
				'order'=>4
			),	
			array(
				'name'=>'Block',
				'description'=>'The episode show or hide status. Specifying "Yes" prevents that episode from appearing in podcast directories. For example, you might want to block a specific episode if you know that its content would otherwise cause the entire podcast to be removed from podcast directories. Specifying any value other than Yes has no effect.',
				'order'=>5
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