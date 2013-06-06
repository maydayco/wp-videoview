<?php
load_plugin_textdomain('YouTubeVideoInserter');
	function statusTranslate($s)
	{
		switch($s)
		{
			case "draft":
				return "Entwurf";
			break;
			case "publish":
				return "Veröffentlicht";
			break;
			default:
				return $s;
			break;
		}
	}
	
	function statusTranslateClass($s)
	{
		switch($s)
		{
			case "draft":
				echo "draftB";
			break;
			case "publish":
				echo "publicB";
			break;
			default:
				return $s;
			break;
		}
	}
	
	function echoYTID($postid)
	{
		$keyvalues = get_post_custom_values('yt_insert_YTID', $postid);
		foreach ( $keyvalues as $key => $value ) {
			echo $value; 
		  }
	}
?>
<h2><?php _e( 'Your YouTube Videos', 'YouTubeVideoInserter' ); ?></h2>
	
	<?php
    global $post;
    $args = array('post_type' => 'ytvideo', 'numberposts' => -1, 'post_status' => 'publish,draft', 'sort_order' => 'DESC', 'sort_column' => 'ID',);
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) :	setup_postdata($post); ?>
        <div class="ytvideo">
            <img src="https://i.ytimg.com/vi/<?php echoYTID(get_the_ID());  ?>/mqdefault.jpg"/>
            <div class="banderole <?php statusTranslateClass($post->post_status); ?>"></div>
            <div class="infoArea">
            <p class="text">
            	<h3><?php the_title(); ?></h3>
                <p class="ytvideoinfos">
                	<span class="ytinfotext"><?php _e( 'From', 'YouTubeVideoInserter' ); ?>: <?php echo get_the_author(); ?><br>
                    <?php _e( 'At', 'YouTubeVideoInserter' ); ?>: <?php the_date(); ?></span>
                    <span class="ytinfotext">YouTube Link: <br><a href="http://www.youtube.com/watch?v=<?php echoYTID(get_the_ID());  ?>">http://www.youtube.com/watch?v=<?php echoYTID(get_the_ID());  ?></a><br>
                    YouTube Shortcode:<br>
                    [yt_Inserter_Single_Video id="<?php the_ID() ?>"]
                    </span>
                </p>
                </p>
                <div class="buttonrow">
                	<a href="admin.php?page=editorMenu&CID=<?php the_ID(); ?>&type=publish" class="ytbutton editbutton"><?php _e( 'Publish video', 'YouTubeVideoInserter' ); ?></a> 
                    <a href="admin.php?page=editorMenu&CID=<?php the_ID(); ?>&type=edit" class="ytbutton editbutton"><?php _e( 'Edit video description', 'YouTubeVideoInserter' ); ?></a>
                    <a href="admin.php?page=editorMenu&CID=<?php the_ID(); ?>&type=delete" class="ytbutton deletebutton"><?php _e( 'Delete video', 'YouTubeVideoInserter' ); ?></a> 
                    <a href="<?php the_permalink(); ?>" target="_blank"class="ytbutton previewbutton"><?php _e( 'Preview the video', 'YouTubeVideoInserter' ); ?></a>
               </div>
               </div>
            <p class="clear"></p>
        </div>
    <?php endforeach; ?>
	<div id="legend">
    	<span class="legend"><span class="draftLegend"></span><?php _e( 'Draft', 'YouTubeVideoInserter' ); ?></span>
        <span class="legend"><span class="publicLegend"></span><?php _e( 'Public', 'YouTubeVideoInserter' ); ?></span>
    </div>