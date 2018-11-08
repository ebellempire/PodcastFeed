<style>
	.helper{font-size:.95em;opacity:0.9;font-style: italic;margin-top:0;}
	#podcast-feed-settings .input-block{width:100%;float: none;}
</style>

<h2><?php echo __('Podcast Feed Settings'); ?></h2>
<p><?php echo __('* All fields are required.</p>');?>
<fieldset id="podcast-feed-settings">

	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_type"><?php echo __('Podcast Type'); ?></label>
	    </div>
	    <div class="inputs five columns omega">
	        <p class="explanation">
	            <?php echo __("Choose a podcast type."); ?>
	        </p>
	        <?php echo get_view()->formSelect('podcast_type', get_option('podcast_type'), null, array(
				'' => __('Select a type'),
				'episodic' => __('Episodic'),
				'serial' => __('Serial'),
		        )); ?>
	            <p class="helper"><?php echo __('Specify episodic for stand-alone episodes or when you want your episodes presented and recommended newest-to-oldest, which is the default and most common type of podcast. Specify serial when you want your episodes presented and recommended oldest-to-newest.'); ?></p>		        
	    </div>
	</div>	
	
	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_parental_advisory"><?php echo __('Parental Advisory'); ?></label>
	    </div>
	    <div class="inputs five columns omega">
	        <p class="explanation">
	            <?php echo __('This podcast contains explicit language or adult content.'); ?>
	        </p>
	        <?php echo get_view()->formCheckbox('podcast_parental_advisory', true, 
	                array('checked'=>(boolean)get_option('podcast_parental_advisory'))); ?>
	                
	        <p class="helper"><?php echo __('If you check this box, indicating the presence of explicit content, podcast directories may display an Explicit parental advisory graphic for your podcast. Podcasts containing explicit material aren’t available in some territories.'); ?></p>		        
	    </div>
	</div>		
	
	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_category"><?php echo __('Podcast Category'); ?></label>
	    </div>
	    <div class="inputs five columns omega">
	        <p class="explanation">
	            <?php echo __("Choose an approved podcast category."); ?>
	        </p>
	        <?php echo get_view()->formSelect('podcast_category', get_option('podcast_category'), null, array(
				'' => __('Select a category'),
				'Arts' => __('Arts'),
				'Arts > Design' => __('Arts > Design'),
				'Arts > Fashion & Beauty' => __('Arts > Fashion & Beauty'),
				'Arts > Food' => __('Arts >  Food'),
				'Literature' => __('Arts >  Literature'),
				'Arts > Performing Arts' => __('Arts >  Performing Arts'),
				'Arts > Visual Arts' => __('Arts > Visual Arts'),
				'Business' => __('Business'),
				'Business > Business News' => __('Business > Business News'),
				'Business > Careers' => __('Business > Careers'),
				'Business > Investing' => __('Business > Investing'),
				'Business > Management & Marketing' => __('Business > Management & Marketing'),
				'Business > Shopping' => __('Business > Shopping'),
				'Comedy' => __('Comedy'),
				'Education' => __('Education'),
				'Education > Educational Technology' => __('Education > Educational Technology'),
				'Education > Higher Education' => __('Education > Higher Education'),
				'Education > K-12' => __('Education > K-12'),
				'Education > Language Courses' => __('Education > Language Courses'),
				'Education > Training' => __('Education > Training'),
				'Games & Hobbies' => __('Games & Hobbies'),
				'Games & Hobbies > Automotive' => __('Games & Hobbies > Automotive'),
				'Games & Hobbies > Aviation' => __('Games & Hobbies > Aviation'),
				'Games & Hobbies > Hobbies' => __('Games & Hobbies > Hobbies'),
				'Games & Hobbies > Other Games' => __('Games & Hobbies > Other Games'),
				'Games & Hobbies > Video Games' => __('Games & Hobbies > Video Games'),
				'Government & Organizations' => __('Government & Organizations'),
				'Government & Organizations > Local' => __('Government & Organizations > Local'),
				'Government & Organizations > National' => __('Government & Organizations > National'),
				'Government & Organizations > Non-Profit' => __('Government & Organizations > Non-Profit'),
				'Government & Organizations > Regional' => __('Government & Organizations > Regional'),
				'Health' => __('Health'),
				'Health > Alternative Health' => __('Health > Alternative Health'),
				'Health > Fitness & Nutrition' => __('Health > Fitness & Nutrition'),
				'Health > Self-Help' => __('Health > Self-Help'),
				'Health > Sexuality' => __('Health > Sexuality'),
				'Kids & Family' => __('Kids & Family'),
				'Music' => __('Music'),
				'News & Politics' => __('News & Politics'),
				'Religion & Spirituality' => __('Religion & Spirituality'),
				'Religion & Spirituality > Buddhism' => __('Religion & Spirituality > Buddhism'),
				'Religion & Spirituality > Christianity' => __('Religion & Spirituality > Christianity'),
				'Religion & Spirituality > Hinduism' => __('Religion & Spirituality > Hinduism'),
				'Religion & Spirituality > Islam' => __('Religion & Spirituality > Islam'),
				'Religion & Spirituality > Judaism' => __('Religion & Spirituality > Judaism'),
				'Religion & Spirituality > Other' => __('Religion & Spirituality > Other'),
				'Religion & Spirituality > Spirituality' => __('Religion & Spirituality > Spirituality'),
				'Science & Medicine' => __('Science & Medicine'),
				'Science & Medicine > Medicine' => __('Science & Medicine > Medicine'),
				'Science & Medicine > Natural Sciences' => __('Science & Medicine > Natural Sciences'),
				'Science & Medicine > Social Sciences' => __('Science & Medicine > Social Sciences'),
				'Society & Culture' => __('Society & Culture'),
				'Society & Culture > History' => __('Society & Culture > History'),
				'Society & Culture > Personal Journals' => __('Society & Culture > Personal Journals'),
				'Society & Culture > Philosophy' => __('Society & Culture > Philosophy'),
				'Society & Culture > Places & Travel' => __('Society & Culture > Places & Travel'),
				'Sports & Recreation' => __('Sports & Recreation'),
				'Sports & Recreation > Amateur' => __('Sports & Recreation > Amateur'),
				'Sports & Recreation > College & High School' => __('Sports & Recreation > College & High School'),
				'Sports & Recreation > Outdoor' => __('Sports & Recreation > Outdoor'),
				'Sports & Recreation > Professional' => __('Sports & Recreation > Professional'),
				'Technology' => __('Technology'),
				'Technology > Gadgets' => __('Technology > Gadgets'),
				'Technology > Tech News' => __('Technology > Tech News'),
				'Technology > Podcasting' => __('Technology > Podcasting'),
				'Technology > Software How-To' => __('Technology > Software How-To'),
				'TV & Film' => __('TV & Film'),
		        )); ?>
	    </div>
	</div>	

	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_image_url"><?php echo __('Podcast Image URL'); ?></label>
	    </div>

	    <div class="inputs five columns omega">
	        <p class="explanation"><?php echo __("Enter the URL for your podcast image. "); ?></p>

	        <div class="input-block">
	            <input type="text" class="textinput" name="podcast_image_url" value="<?php echo get_option('podcast_image_url'); ?>">
	            <p class="helper"><?php echo __('<strong>Requirements</strong>: minimum size of 1400 x 1400 pixels; maximum size of 3000 x 3000 pixels; 72 dpi, in JPEG or PNG format with appropriate file extensions (.jpg, .png), and in the RGB colorspace.'); ?></p>
	        </div>
	    </div>
	</div>


	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_title"><?php echo __('Podcast Title'); ?></label>
	    </div>

	    <div class="inputs five columns omega">
	        <p class="explanation"><?php echo __("Enter the title for your podcast. "); ?></p>

	        <div class="input-block">
	            <input type="text" class="textinput" name="podcast_title" value="<?php echo get_option('podcast_title'); ?>">
	            <p class="helper"><?php echo __('Make your title specific and memorable.'); ?></p>
	        </div>
	    </div>
	</div>

	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_author"><?php echo __('Podcast Author'); ?></label>
	    </div>

	    <div class="inputs five columns omega">
	        <p class="explanation"><?php echo __("Enter the author for your podcast. "); ?></p>

	        <div class="input-block">
	            <input type="text" class="textinput" name="podcast_author" value="<?php echo get_option('podcast_author'); ?>">
	            <p class="helper"><?php echo __('Enter a name for the person or organization responsible for the podcast.'); ?></p>
	        </div>
	    </div>
	</div>


	<div class="field fieldtrip child">
	    <div class="two columns alpha">
	        <label for="podcast_description"><?php echo __('Podcast Description'); ?></label>
	    </div>
	
	    <div class="inputs five columns omega">
			<p class="explanation"><?php echo __("Enter text describing your podcast."); ?></p>

	        <div class="input-block">
	            <textarea rows="5" cols="50" class="textinput" name="podcast_description"><?php echo get_option('podcast_description'); ?></textarea>
	        </div>
        
	        <p class="helper"><?php echo __('Describe your podcast, including subject matter, episode schedule, and other relevant information. Apple Podcasts removes podcasts that include irrelevant words in this field so be sure to stay on topic.'); ?></p>
	    </div>
	</div>	
	
	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_language"><?php echo __('Podcast Language'); ?></label>
	    </div>

	    <div class="inputs five columns omega">
	        <p class="explanation"><?php echo __("Enter the language for your podcast. "); ?></p>

	        <div class="input-block">
	            <input type="text" class="textinput" name="podcast_language" value="<?php echo get_option('podcast_language'); ?>">
	            <p class="helper"><?php echo __('Enter a standard two-letter language identifier ( for example: en ), with or without a hyphenated two-letter subcode ( for example: en-us ). Please refer to the %s','<a target="_blank" href="https://cyber.harvard.edu/rss/languages.html">RSS 2.0 Specification</a>'); ?></p>
	        </div>
	    </div>
	</div>	
	
	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_link"><?php echo __('Podcast Link URL'); ?></label>
	    </div>

	    <div class="inputs five columns omega">
	        <p class="explanation"><?php echo __("Enter the URL for your podcast information page. "); ?></p>

	        <div class="input-block">
	            <input type="text" class="textinput" name="podcast_link" value="<?php echo get_option('podcast_link'); ?>">
	            <p class="helper"><?php echo __('Enter the URL for a general information page where users can learn about your podcast, find episodes, etc. (for example, a collection page on this site containing your podcast items).'); ?></p>
	        </div>
	    </div>
	</div>		
	
	<div class="field">
	    <div class="two columns alpha">
	        <label for="podcast_email"><?php echo __('Podcast Email Address'); ?></label>
	    </div>

	    <div class="inputs five columns omega">
	        <p class="explanation"><?php echo __("Enter an email address for your podcast. "); ?></p>

	        <div class="input-block">
	            <input type="text" class="textinput" name="podcast_email" value="<?php echo get_option('podcast_email'); ?>">
	            <p class="helper"><?php echo __('Enter an email address to be used to verify your ownership of this podcast feed.'); ?></p>
	        </div>
	    </div>
	</div>		
	
</fieldset>

<h2><?php echo __('Usage');?></h2>

<p><?php echo __('This plugin adds a new item type called <em>Podcast Episode</em>. To add an item to the podcast feed, make sure to use the <em>Podcast Episode</em> item type, include an MP3 audio file, and enter a Title and Description using Dublin Core (HTML paragraphs, links, and lists are allowed; other tags will be removed from the feed output). ');?></p>

<p><?php echo __('After saving the plugin settings above, your feed will be available at %s','<a href="'.WEB_ROOT.'/items/browse?output=podcast'.'" target="_blank">/items/browse?output=podcast</a>.');?></p>

<?php if(
	get_option('podcast_image_url') && 
	get_option('podcast_title') && 
	get_option('podcast_author') && 
	get_option('podcast_description') && 
	get_option('podcast_language') && 
	get_option('podcast_link') && 
	get_option('podcast_email') && 
	get_option('podcast_category')):?>
	<div style="display:none">
		<a class="view-feed button blue big" href="<?php echo WEB_ROOT.'/items/browse?output=podcast';?>" target="_blank">
			<?php echo __('View Podcast Feed');?>
		</a>
	</div>
	<script>
		jQuery(document).ready(function(){
			var feedlink=jQuery('.view-feed');
			jQuery('#save.panel').append(feedlink);
		});
	</script>
<?php endif;?>

<h2><?php echo __('About Podcast Distribution');?></h2>
<p><?php echo __('Once you have added some episodes, follow the usual steps to distribute your podcast. It is strongly recommended to register your podcast with <strong>both</strong> the Apple and Google podcast directories. The Apple directory is generally considered to be the most critical.');?></p>
<ul>
	<li><a target="_blank" href="https://itunespartner.apple.com/en/podcasts/overview">Apple iTunes Connect Resources and Help: Podcasts</a></li>
	<li><a target="_blank" href="https://support.google.com/googleplay/podcasts/answer/6260341">Google Play Music Podcast RSS Feed Specifications</a></li>
</ul>
