<style>
	.helper{font-size:.95em;opacity:0.9;font-style: italic;margin-top:0;}
	#podcast-feed-settings .input-block{width:100%;float: none;}
</style>

<h2><?php echo __('Podcast Feed Settings'); ?></h2>
<p><?php echo __('* All fields are required.</p>');?>
<fieldset id="podcast-feed-settings">

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
				'Design' => __('--  Design'),
				'Fashion &amp; Beauty' => __('--  Fashion & Beauty'),
				'Food' => __('--  Food'),
				'Literature' => __('--  Literature'),
				'Performing Arts' => __('--  Performing Arts'),
				'Visual Arts' => __('--  Visual Arts'),
				'Business' => __('Business'),
				'Business News' => __('--  Business News'),
				'Careers' => __('--  Careers'),
				'Investing' => __('--  Investing'),
				'Management &amp; Marketing' => __('--  Management & Marketing'),
				'Shopping' => __('--  Shopping'),
				'Comedy' => __('Comedy'),
				'Education' => __('Education'),
				'Educational Technology' => __('--  Educational Technology'),
				'Higher Education' => __('--  Higher Education'),
				'K-12' => __('--  K-12'),
				'Language Courses' => __('--  Language Courses'),
				'Training' => __('--  Training'),
				'Games &amp; Hobbies' => __('Games & Hobbies'),
				'Automotive' => __('--  Automotive'),
				'Aviation' => __('--  Aviation'),
				'Hobbies' => __('--  Hobbies'),
				'Other Games' => __('--  Other Games'),
				'Video Games' => __('--  Video Games'),
				'Government &amp; Organizations' => __('Government & Organizations'),
				'Local' => __('--  Local'),
				'National' => __('--  National'),
				'Non-Profit' => __('--  Non-Profit'),
				'Regional' => __('--  Regional'),
				'Health' => __('Health'),
				'Alternative Health' => __('--  Alternative Health'),
				'Fitness &amp; Nutrition' => __('--  Fitness & Nutrition'),
				'Self-Help' => __('--  Self-Help'),
				'Sexuality' => __('--  Sexuality'),
				'Kids &amp; Family' => __('Kids & Family'),
				'Music' => __('Music'),
				'News &amp; Politics' => __('News & Politics'),
				'Religion &amp; Spirituality' => __('Religion & Spirituality'),
				'Buddhism' => __('--  Buddhism'),
				'Christianity' => __('--  Christianity'),
				'Hinduism' => __('--  Hinduism'),
				'Islam' => __('--  Islam'),
				'Judaism' => __('--  Judaism'),
				'Other' => __('--  Other'),
				'Spirituality' => __('--  Spirituality'),
				'Science &amp; Medicine' => __('Science & Medicine'),
				'Medicine' => __('--  Medicine'),
				'Natural Sciences' => __('--  Natural Sciences'),
				'Social Sciences' => __('--  Social Sciences'),
				'Society &amp; Culture' => __('Society & Culture'),
				'History' => __('--  History'),
				'Personal Journals' => __('--  Personal Journals'),
				'Philosophy' => __('--  Philosophy'),
				'Places &amp; Travel' => __('--  Places & Travel'),
				'Sports &amp; Recreation' => __('Sports & Recreation'),
				'Amateur' => __('--  Amateur'),
				'College &amp; High School' => __('--  College & High School'),
				'Outdoor' => __('--  Outdoor'),
				'Professional' => __('--  Professional'),
				'Technology' => __('Technology'),
				'Gadgets' => __('--  Gadgets'),
				'Tech News' => __('--  Tech News'),
				'Podcasting' => __('--  Podcasting'),
				'Software How-To' => __('--  Software How-To'),
				'TV &amp; Film' => __('TV & Film'),
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

<p><?php echo __('This plugin has added a new item type called <em>Podcast Episode</em>. To add an item to the podcast feed, make sure to use the <em>Podcast Episode</em> item type, include an MP3 audio file, and enter a title and description. After saving the settings above, you may preview your feed at %s','<a href="'.WEB_ROOT.'/items/browse?output=podcast'.'" target="_blank">/items/browse?output=podcast</a>');?>.</p>

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
