<?php
/*
Plugin Name: YouTube Video Inserter
Plugin URI: http://ueberhamm-design.de/
Description: This plugin help you to insert YouTube Videos to your WordPress Blog. You just have to insert the URL and the Plugin get all necessary infos about the Video.
Author: UeberhammDesign
Version: 1.1.2
Author URI: http://ueberhamm-design.de/
*/
//Insert Languagefiles
load_plugin_textdomain('YouTubeVideoInserter', false, dirname( plugin_basename( __FILE__ ) ). '/lang' );
//load_theme_textdomain('YouTubeVideoInserter', plugins_url( '/lang', __FILE__ )); 

//Backend Menu
function YTAdminUI() 
{
  	include('adminUI/default.php');
}

function editorMenu()
{
	include('adminUI/editor.php');
}

function insertMenu() 
{
  	include('adminUI/insert.php');
}

function settingMenu() 
{
  	include('adminUI/settings.php');
}

function YTAddMenu() {
  add_menu_page('YouTube Videos', 'YouTube Videos', 10, __FILE__, 'YTAdminUI');
  add_submenu_page(__FILE__, __( 'Insert YT Video', 'YouTubeVideoInserter' ), __( 'Insert YT Video', 'YouTubeVideoInserter' ), 10, 'insertMenu', 'insertMenu');
  add_submenu_page(__FILE__, __( 'Editor', 'YouTubeVideoInserter' ), __( 'Editor', 'YouTubeVideoInserter' ), 10, 'editorMenu', 'editorMenu');
  add_submenu_page(__FILE__, __( 'Settings', 'YouTubeVideoInserter' ), __( 'Settings', 'YouTubeVideoInserter' ), 10, 'settingMenu', 'settingMenu');
}
 
add_action('admin_menu', 'YTAddMenu');

//Shotcodes
function returnYTID($postid)
{
	$keyvalues = get_post_custom_values('yt_insert_YTID', $postid);
	foreach ( $keyvalues as $value ) {
		return $value; 
	  }
}
//Output Last Videos
function YTLastFunc( $atts ){
 extract( shortcode_atts( array(
		'count' => '10',
	), $atts ) );
	
	$loop = new WP_Query( array( 'post_type' => 'ytvideo', 'posts_per_page' => $count ) ); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php $entries .='
	   <div class="entry" style="padding-bottom:10px;">
       <img style="float:left; margin-right:10px; height:110px; width:auto;" src="https://i.ytimg.com/vi/' .returnYTID(get_the_ID())  .'/mqdefault.jpg"/>
        <h3 class="blog-hl"><a href="' .get_permalink() .'">' .get_the_title() .'</a></h3>
          ' .get_the_excerpt() .'
       </div>
       <p style="clear:both"></p>';
    endwhile;
	
	return $entries;
}
add_shortcode( 'YTLastVideos', 'YTLastFunc' );

//Output Single Video without description
function YTSingleVidFunc( $atts ){
 extract( shortcode_atts( array(
		'id' => '0',
	), $atts ) ); 
	
	$post = get_post($id);
	$video = $post->post_content;
	$videoparts = explode("</div>", $video);
	return $videoparts[0] ."</div>";
	
}
add_shortcode( 'yt_Inserter_Single_Video', 'YTSingleVidFunc' );

//Custom Post Type register
add_action( 'init', 'create_post_type_ytvideo' );

function create_post_type_ytvideo() {
	register_post_type( 'ytvideo',
		array(
			'labels' => array(
				'name' => __( 'YouTube Videos' ),
				'singular_name' => __( 'YouTube Video' )
			),
		'public' => true,
		'show_ui' => true,
		'show_in_admin_bar' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'videos'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments'),
		'taxonomies' => array('category'),
		'has_archive' => true
		)
	);
}

function my_query_post_type($query) {
    if ( is_category() && false == $query->query_vars['suppress_filters'] )
        $query->set( 'post_type', array( 'post', 'ytvideo', 'attachment' ) );
    return $query;
}
add_filter('pre_get_posts', 'my_query_post_type');


//Eigenes Style einbinden
function your_css_and_js() 
{
	wp_register_style('your_css_and_js', plugins_url('adminUI/style.css',__FILE__ ));
	wp_enqueue_style('your_css_and_js');
}
add_action( 'admin_init','your_css_and_js');

//Include OutputJS
function wptuts_scripts_basic()  
{  
    // Register the script like this for a plugin:  
    wp_register_script( 'custom-script', plugins_url( '/Output/playerwidth.js', __FILE__ ), array('jquery'));  
  
    // For either a plugin or a theme, you can then enqueue the script:  
    wp_enqueue_script( 'custom-script' );  
}  
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' ); 

//Include Widget CSS
function theme_styles()  
{ 
	  // Register the style like this for a theme:  
	  // (First the unique name for the style (custom-style) then the src, 
	  // then dependencies and ver no. and media type)
	  wp_register_style( 'custom-style', 
	  	plugins_url('/Output/YT_Inserter_widget.css', __FILE__),
		array(), 
		'20120208', 
		'all' );
	
	  // enqueing:
	  wp_enqueue_style( 'custom-style' );
}
add_action('wp_enqueue_scripts', 'theme_styles');

// LastVideos Widget
if(!class_exists('Last_Videos_Widget')) {
    class Last_Videos_Widget extends WP_Widget {
        private $var_sTextdomain; 
        public function Last_Videos_Widget() {
            Last_Videos_Widget::__construct();
        } 
        public function __construct() {
            $this->var_sTextdomain = 'my-sidebar-widget';

        

            $widget_options = array(
                'classname' => 'Last_Videos_Widget',
                'description' => __('Show the last uploaded videos.' , 'YouTubeVideoInserter')
            );

            $control_options = array();

            $this->WP_Widget('Last_Videos_Widget', __('Last YouTube Videos', 'YouTubeVideoInserter'), $widget_options, $control_options);
        } 
		//Form for Widget-settings
        public function form($instance) {
            $instance = wp_parse_args((array) $instance, array(
                'my-widget-title' => '',
				'my-widget-count' => 5
            ));

            // Titel
            echo '<p style="border-bottom: 1px solid #DFDFDF;"><strong>' . __('Title', 'YouTubeVideoInserter') . '</strong></p>';
            echo '<p><input id="' . $this->get_field_id('my-widget-title') . '" name="' . $this->get_field_name('my-widget-title') . '" type="text" value="' . $instance['my-widget-title'] . '" /></p>';
            echo '<p style="clear:both;"></p>';
			//Nummer
			echo '<p style="border-bottom: 1px solid #DFDFDF;"><strong>' . __('Number of Videos', 'YouTubeVideoInserter') . '</strong></p>';
            echo '<p><input id="' . $this->get_field_id('my-widget-count') . '" name="' . $this->get_field_name('my-widget-count') . '" type="number" value="' . $instance['my-widget-count'] . '" /></p>';
            echo '<p style="clear:both;"></p>';
        }
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;

            $new_instance = wp_parse_args((array) $new_instance, array(
                'my-widget-title' => '',
                'my-widget-count' => ''
            ));

            
            $instance['my-widget-title'] = (string) strip_tags($new_instance['my-widget-title']);
            $instance['my-widget-count'] = (string) strip_tags($new_instance['my-widget-count']);

          
            return $instance;
        } 

        //Output
        public function widget($args, $instance) {
            extract($args);

            echo $before_widget;

            $title = (empty($instance['my-widget-title'])) ? '' : apply_filters('my_widget_title', $instance['my-widget-title']);

            if(!empty($title)) {
                echo $before_title . $title . $after_title;
            } 

            echo $this->my_widget_html_output($instance);
            echo $after_widget;
        } 

        private function my_widget_html_output($args = array()) {
           //HTML Output
            $var_sWidetHTML = wpautop($args['my-widget-count'], true);
			
			$var_sWidetHTML = str_replace("<p>", "" ,$var_sWidetHTML);
			$var_sWidetHTML = str_replace("</p>", "" ,$var_sWidetHTML);
			
			$loop = new WP_Query( array( 'post_type' => 'ytvideo', 'posts_per_page'=>$var_sWidetHTML ) );
			while ( $loop->have_posts() ) : $loop->the_post();
				if(get_post_type(get_the_ID()) == 'ytvideo' ){
				$title = get_the_title();
				if(strlen($title) > 45)
				{
					$title = substr($title, 0, 45) ."...";	
				}
				$entries .='
				   <div class="ytinserterWidgetEntryHolder">
				   <a href="' .get_permalink() .'"><img class="ytinsertWidgetImage" src="https://i.ytimg.com/vi/' .returnYTID(get_the_ID())  .'/mqdefault.jpg"/>
					' .$title .'</a>
					<p style="clear:both;"></p>
				   </div>
				   <p style="clear:both"></p>';
				}
			endwhile;
			
			return $entries;
        } 
    } 
    add_action('widgets_init', create_function('', 'return register_widget("Last_Videos_Widget");'));
}

//Widget Random Videos
if(!class_exists('Random_Videos_Widget')) {
    class Random_Videos_Widget extends WP_Widget {
        private $var_sTextdomain; 
        public function Random_Videos_Widget() {
            Random_Videos_Widget::__construct();
        } 
        public function __construct() {
            $this->var_sTextdomain = 'random-video-widget';

          

            $widget_options = array(
                'classname' => 'Random_Videos_Widget',
                'description' => __('Show random videos ', 'YouTubeVideoInserter')
            );

            $control_options = array();

            $this->WP_Widget('Random_Videos_Widget', __('Random YouTube Videos', 'YouTubeVideoInserter'), $widget_options, $control_options);
        } 
		//Form for Widget-settings
        public function form($instance) {
            $instance = wp_parse_args((array) $instance, array(
                'my-widget-title' => '',
				'my-widget-count' => 5
            ));

            // Titel
            echo '<p style="border-bottom: 1px solid #DFDFDF;"><strong>' . __('Title', 'YouTubeVideoInserter') . '</strong></p>';
            echo '<p><input id="' . $this->get_field_id('my-widget-title') . '" name="' . $this->get_field_name('my-widget-title') . '" type="text" value="' . $instance['my-widget-title'] . '" /></p>';
            echo '<p style="clear:both;"></p>';
			//Nummer
			echo '<p style="border-bottom: 1px solid #DFDFDF;"><strong>' . __('Number of Videos', 'YouTubeVideoInserter') . '</strong></p>';
            echo '<p><input id="' . $this->get_field_id('my-widget-count') . '" name="' . $this->get_field_name('my-widget-count') . '" type="number" value="' . $instance['my-widget-count'] . '" /></p>';
            echo '<p style="clear:both;"></p>';
        }
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;

            $new_instance = wp_parse_args((array) $new_instance, array(
                'my-widget-title' => '',
                'my-widget-count' => ''
            ));

            
            $instance['my-widget-title'] = (string) strip_tags($new_instance['my-widget-title']);
            $instance['my-widget-count'] = (string) strip_tags($new_instance['my-widget-count']);

          
            return $instance;
        } 

        //Output
        public function widget($args, $instance) {
            extract($args);

            echo $before_widget;

            $title = (empty($instance['my-widget-title'])) ? '' : apply_filters('my_widget_title', $instance['my-widget-title']);

            if(!empty($title)) {
                echo $before_title . $title . $after_title;
            } 

            echo $this->my_widget_html_output($instance);
            echo $after_widget;
        } 

        private function my_widget_html_output($args = array()) {
           //HTML Output
            $var_sWidetHTML = wpautop($args['my-widget-count'], true);
			
			$var_sWidetHTML = str_replace("<p>", "" ,$var_sWidetHTML);
			$var_sWidetHTML = str_replace("</p>", "" ,$var_sWidetHTML);
			
			$loop = new WP_Query( array( 'post_type' => 'ytvideo', 'posts_per_page'=> $var_sWidetHTML, 'orderby' => 'rand' ) );
			$ytids = array();
			while ( $loop->have_posts() ) : $loop->the_post();
				if(get_post_type(get_the_ID()) == 'ytvideo' ){
				$title = get_the_title();
				if(strlen($title) > 45)
				{
					$title = substr($title, 0, 45) ."...";	
				}
				$entries .='
				   <div class="ytinserterWidgetEntryHolder">
				   <a href="' .get_permalink() .'"><img class="ytinsertWidgetImage" src="https://i.ytimg.com/vi/' .returnYTID(get_the_ID())  .'/mqdefault.jpg"/>
					' .$title .'</a>
					<p style="clear:both;"></p>
				   </div>
				   <p style="clear:both"></p>';
				}
			endwhile;
			
			return $entries;
        } 
    } 
    add_action('widgets_init', create_function('', 'return register_widget("Random_Videos_Widget");'));
}
?>