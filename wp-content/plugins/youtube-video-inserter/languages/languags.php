<?php
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if($lang != "de")
{
	$lang = "en";
}
$lang_output = array('en' => array(), 'de' => array());
//Languagepackages
//Englisch
//default.php -> Values of status und editingbuttons
$lang_output['en']['default_hl'] = "Your YouTube Videos";
//Status
$lang_output['en']['draft'] = "Draft";
$lang_output['en']['public'] = "Public";
//Buttons
$lang_output['en']['preview'] = "Preview";
$lang_output['en']['edit'] = "Edit";
$lang_output['en']['publish'] = "Publish";
$lang_output['en']['delete'] = "Delete";
//Videoinfo
$lang_output['en']['from'] = "From";
$lang_output['en']['atDate'] = "At";
$lang_output['en']['videoShortcode'] = "Just the Video Shortcode";

/*******************************************/

//insert.php -> Insertform for video
$lang_output['en']['insert_hl'] = "Insert video";
//Formlabels
$lang_output['en']['youtube_url_label'] = "The URL of the video";
$lang_output['en']['category_label'] = "Category";
$lang_output['en']['statuslabel'] = "Status";
$lang_output['en']['insertbutton'] = "Insert video";

/*******************************************/

//editor.php -> Make changes at the videos
//Overviewlink
$lang_output['en']['overviewlink'] = "Back to overview";
//No type
$lang_output['en']['notype_hl'] = "You do not select a video";
//Type: edit
$lang_output['en']['edit_hl'] = "Edit YouTube video";
$lang_output['en']['edit_success'] = "edited";
$lang_output['en']['edit_desc_button'] = "Edit video description";
//Type: publish
$lang_output['en']['publish_hl'] = "is now public";
//Type: delete
$lang_output['en']['delete_hl'] = "deleted";


/*******************************************/

//settings.php -> Tabel of description for Shortcodes and ability to creat categorys
$lang_output['en']['settings_hl'] = "Settings";
//Creat category |  Formlabels
$lang_output['en']['creat_hl'] = "Creat a category";
$lang_output['en']['name_of_cat_label'] = "Name of the category";
$lang_output['en']['desc_label'] = "Description";
$lang_output['en']['subcat_label'] = "Subcategory from";
$lang_output['en']['new_main_cat_label'] = "New Maincategory";
$lang_output['en']['creat_cat_button'] = "Create Category";
//Shortcode table
//Tabelhead
$lang_output['en']['sc_hl'] = "Shortcodes";
$lang_output['en']['sc_name_hl'] = "Shortcode";
$lang_output['en']['sc_desc_hl'] = "Description";
//scortcode Descriptions
$lang_output['en']['sc_lastvideo_desc'] = nl2br("Output the last videos. x is the number of them. 
Default: 10");
$lang_output['en']['sc_singlevideo_desc'] = nl2br("Output a video without title and description. 
Default: 0 (Last Post (Not only videos!))
For a special video, look in the video overview.");

/*************************************************************************************************/
/*************************************************************************************************/

//Deutsch
//default.php -> Values of status und editingbuttons
$lang_output['de']['default_hl'] = "Deine YouTube Videos";
//Status
$lang_output['de']['draft'] = "Entwurf";
$lang_output['de']['public'] = "&Ouml;ffentlich";
//Buttons
$lang_output['de']['preview'] = "Vorschau";
$lang_output['de']['edit'] = "Bearbeiten";
$lang_output['de']['publish'] = "Ver&ouml;ffentliche";
$lang_output['de']['delete'] = "L&ouml;schen";
//Videoinfo
$lang_output['de']['from'] = "Von";
$lang_output['de']['atDate'] = "Am";
$lang_output['de']['videoShortcode'] = "Nur das Video als Shortcode";

/*******************************************/

//insert.php -> Insertform for video
$lang_output['de']['insert_hl'] = "Video hinzuf&uuml;gen";
//Formlabels
$lang_output['de']['youtube_url_label'] = "YouTube URL des Videos";
$lang_output['de']['category_label'] = "Kategorie";
$lang_output['de']['statuslabel'] = "Status";
$lang_output['de']['insertbutton'] = "Video hinzuf&uuml;gen";

/*******************************************/

//editor.php -> Make changes at the videos
//Overviewlink
$lang_output['de']['overviewlink'] = "Zur&uuml;ck zur &Uuml;bersciht";
//No type
$lang_output['de']['notype_hl'] = "Es wurde kein Video ausgewählt";
//Type: edit
$lang_output['de']['edit_hl'] = "Aktuelle in bearbeitung";
$lang_output['de']['edit_success'] = "wurde bearbeitet";
$lang_output['de']['edit_desc_button'] = "Bearbeite die Videobeschreibung";
//Type: publish
$lang_output['de']['publish_hl'] = "ist nun &ouml;ffentlich";
//Type: delete
$lang_output['de']['delete_hl'] = "wurde gel&ouml;scht";


/*******************************************/

//settings.php -> Tabel of description for Shortcodes and ability to creat categorys
$lang_output['de']['settings_hl'] = "Einstellungen";
//Creat category |  Formlabels
$lang_output['de']['creat_hl'] = "Erstelle eine Kategorie";
$lang_output['de']['name_of_cat_label'] = "Name der Kategorie";
$lang_output['de']['desc_label'] = "Kurze Beschreibung";
$lang_output['de']['subcat_label'] = "Unterkategorie von";
$lang_output['de']['new_main_cat_label'] = "Neue Hauptkategorie";
$lang_output['de']['creat_cat_button'] = "Kategorie erstellen";
//Shortcode table
//Tabelhead
$lang_output['de']['sc_hl'] = "Shortcodes";
$lang_output['de']['sc_name_hl'] = "Shortcode";
$lang_output['de']['sc_desc_hl'] = "Beschreibung";
//scortcode Descriptions
$lang_output['de']['sc_lastvideo_desc'] = nl2br("Gibt die zuletzt hinzugef&uuml;gten Videos aus. x ist die Anzahl der Videos. 
Standartwert: 10");
$lang_output['de']['sc_singlevideo_desc'] = nl2br("Gibt den Videoplayer des Videos ohne Beschreibung aus
Standartwert: 0 (Letzter Post (Es handelt sich nicht immer um ein Video!))
F&uuml;r ein bestimmtes Video, w&auml;hle den Shortcode von der &Uuml;bersichtsseite");
?>