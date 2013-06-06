<?php
//The Enlishlanguagefile for the YouTube Video Inserter
//Language after the browser language
//default.php -> Values of status und editingbuttons
$default_hl = "Your YouTube Videos";
//Status
$draft = "Draft";
$public = "Public";
//Buttons
$preview = "Preview";
$edit = "Edit";
$publish = "Publish";
$delete = "Delete";
//Videoinfo
$from = "From";
$atDate = "At";
$videoShortcode = "Just the Video Shortcode";

/*******************************************/

//insert.php -> Insertform for video
$insert_hl = "Insert video";
//Formlabels
$youtube_url_label = "The URL of the video";
$category_label = "Category";
$statuslabel = "Status";
$insertbutton = "Insert video";

/*******************************************/

//editor.php -> Make changes at the videos
//Overviewlink
$overviewlink = "Back to overview";
//No type
$notype_hl = "You do not select a video";
//Type: edit
$edit_hl = "Edit YouTube video: {$title}";
$edit_success = "<i>{$title}</i> edited";
$edit_desc_button = "Edit video description";
//Type: publish
$publish_hl = "<i>{$title}</i> is now public";
//Type: delete
$delete_hl = "<i>{$title}</i> deleted";


/*******************************************/

//settings.php -> Tabel of description for Shortcodes and ability to creat categorys
$settings_hl = "Settings";
//Creat category |  Formlabels
$creat_hl = "Creat a category";
$name_of_cat_label = "Name of the category";
$desc_label = "Description";
$subcat_label = "Subcategory from";
$new_main_cat_label = "New Maincategory";
$creat_cat_button = "Create Category";
//Shortcode table
//Tabelhead
$sc_hl = "Shortcodes";
$sc_name_hl = "Shortcode";
$sc_desc_hl = "Description";
//scortcode Descriptions
$sc_lastvideo_desc = nl2br("Output the last videos. x is the number of them. 
Default: 10");
$sc_singlevideo_desc = nl2br("Output a video without title and description. 
Default: 0 (Last Post (Not only videos!))
For a special video, look in the video overview.");
?>
