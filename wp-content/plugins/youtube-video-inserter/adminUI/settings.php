<?php
	load_plugin_textdomain('YouTubeVideoInserter');
?>
<h2><?php _e( 'Settings', 'YouTubeVideoInserter' ); ?></h2>
<h3><?php _e( 'Creat a category', 'YouTubeVideoInserter' ); ?></h3>
<?php
if(isset($_POST['insertCat']) && isset($_POST['catname']) && str_replace(" ", "", $_POST['catname']) != "" && isset($_POST['catdesc']) && str_replace(" ", "", $_POST['catdesc']) != "")
{
	if(get_cat_ID($_POST['catname']) == 0)
	{
		$my_cat = array('cat_name' => $_POST['catname'], 'category_description' => $_POST['catdesc'], 'category_nicename' => strtolower($_POST['catname']), 'category_parent' => $_POST['catparent']);
		wp_insert_category($my_cat);
		echo "<?php _e( 'Creation sucssessful', 'YouTubeVideoInserter' ); ?>";
	}
	else
	{
		echo "<?php _e( 'The category already exist', 'YouTubeVideoInserter' ); ?>";	
	}
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"/>
<?php _e( 'Name of category', 'YouTubeVideoInserter' ); ?>:
<input type="text" name="catname" class="inputText"/><br>
<?php _e( 'Description', 'YouTubeVideoInserter' ); ?>:
<input type="text" name="catdesc" class="inputText"/><br>
<p><?php _e( 'Subcategory from', 'YouTubeVideoInserter' ); ?>:
<select class="inputSelect" name="catparent">
<option value=""><?php _e( 'New main category', 'YouTubeVideoInserter' ); ?></option>
<?php
//Alle Kategorien auflisten
$catIDs = get_all_category_ids();
foreach($catIDs as $catID)
{
	$catName = get_cat_name($catID);
	echo '<option value="' .$catID .'">'.$catName .'</option>';
}
?>
</select></p>
<p><input type="submit" name="insertCat" value="   <?php _e( 'Creat Category', 'YouTubeVideoInserter' ); ?>   " class="button button-primary button-large"/></p>
</form>
<hr/>
<h2>Shortcodes</h2>
<table width="600" border="1" rules="all" cellpadding="5">
<tr><th>Shortcode</th><th><?php _e( 'Description', 'YouTubeVideoInserter' ); ?></th></tr>
<tr><td width="150">[YTLastVideos count="x"]</td><td><?php _e( 'Output the last videos. x is the number of them. <br>
Default: 10', 'YouTubeVideoInserter' ); ?></td></tr>
<tr><td width="150">[yt_Inserter_Single_Video id="x"]</td><td><?php _e('Output a video without title and description. 
<br>Default: 0 (Last Post (Not only videos!))
<br>For a special video, look in the video overview.', 'YouTubeVideoInserter' ); ?>
</td></tr>
</table>
<hr/>