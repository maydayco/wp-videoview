<?php
load_plugin_textdomain('YouTubeVideoInserter');
if(!isset($_GET['CID']))
	{
		?>
        <p>
        <h2><?php _e( 'You do not select a video', 'YouTubeVideoInserter' ); ?></h2>
        <a href="admin.php?page=YT_Inserter/index.php"><?php _e( 'Back to overview', 'YouTubeVideoInserter' ); ?></a>
        </p>
        <?php
	}
	elseif($_GET['type'] == "edit")
	{
		$post = get_post($_GET['CID']);
		$title = $post->post_title;
		if(isset($_POST['updateDetails']))
		{
			$content = $_POST['content'];
			$post = array();
			$post['ID'] = $_GET['CID'];
			$post['post_content'] = $content;
			$post['post_category'] = array($_POST['VidCat']);
			wp_update_post( $post );
			?>
            <h2><i><?php echo $title; ?></i> <?php _e( 'edited', 'YouTubeVideoInserter' ); ?></h2>
            <a href="admin.php?page=YT_Inserter/index.php"><?php _e( 'Back to overview', 'YouTubeVideoInserter' ); ?></a><br><br>
            <?php
		}
		else
		{
			?>
            <h2><?php _e( 'Edit YouTube Video', 'YouTubeVideoInserter' ); ?>: <?php echo $title; ?></h2>
            <?php
		}
		$post2 = get_post($_GET['CID']);
		$content = $post2->post_content;
	?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=editorMenu&CID=<?php echo $_GET['CID']; ?>&type=edit" method="post">
    <div id="changeArea">
        <?php wp_editor($content,'content');?>
    </div>
    <p>
    <?php _e( 'Category', 'YouTubeVideoInserter' ); ?>: <select name="VidCat">
    	<?php
		//Alle Kategorien auflisten
		$catIDs = get_all_category_ids();
		foreach($catIDs as $catID)
		{
			$catName = get_cat_name($catID);
			if($post2->post_category[0] == $catID)
			{
				echo '<option value="' .$catID .'" selected>'.$catName .'</option>';
			}
			else
			{
				echo '<option value="' .$catID .'">'.$catName .'</option>';
			}
		}
		?>
    </select>
    </p>
    <p><input type="submit" name="updateDetails" value="   Edit video description   " class="button button-primary button-large"/></p>
    </form>
    <?php
	}
	elseif($_GET['type'] == "publish")
	{
		wp_publish_post( $_GET['CID'] );
		$post = get_post($_GET['CID']); 
		$title = $post->post_title;
		?>
        	<h2><i><?php echo $title; ?></i> <?php _e( 'is now public', 'YouTubeVideoInserter' ); ?></h2>
            <a href="admin.php?page=YT_Inserter/index.php"><?php _e( 'Back to overview', 'YouTubeVideoInserter' ); ?></a>
        <?php
	}
	elseif($_GET['type'] == "delete")
	{
		$post = get_post($_GET['CID']); 
		$title = $post->post_title;
		wp_delete_post( $_GET['CID'] );
		?>
        	<h2><i><?php echo $title; ?></i> <?php _e( 'delete', 'YouTubeVideoInserter' ); ?></h2>
            <a href="admin.php?page=YT_Inserter/index.php"><?php _e( 'Back to overview', 'YouTubeVideoInserter' ); ?></a>
        <?php
	}
	else
	{
		?>
        <p>
        <h2>You do not select a video</h2>
        <a href="admin.php?page=YT_Inserter/index.php">Back to overview</a>
        </p>
        <?php
	}
?>
