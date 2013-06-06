<?php
//The Enlishlanguagefile for the YouTube Video Inserter
//Language after the browser language
//default.php -> Values of status und editingbuttons
$default_hl = "Deine YouTube Videos";
//Status
$draft = "Entwurf";
$public = "&Ouml;ffentlich";
//Buttons
$preview = "Vorschau";
$edit = "Bearbeiten";
$publish = "Ver%ouml;ffentliche";
$delete = "L&ouml;schen";
//Videoinfo
$from = "Von:";
$atDate = "Am";
$videoShortcode = "Nur das Video als Shortcode";

/*******************************************/

//insert.php -> Insertform for video
$insert_hl = "Video hinzuf&uuml;gen";
//Formlabels
$youtube_url_label = "YouTube URL des Videos";
$category_label = "Kategorie";
$statuslabel = "Status";
$insertbutton = "Video hinzuf&uuml;gen";

/*******************************************/

//editor.php -> Make changes at the videos
//Overviewlink
$overviewlink = "Zur&uuml;ck zur &Uuml;bersciht";
//No type
$notype_hl = "Es wurde kein Video ausgewählt";
//Type: edit
$edit_hl = "Aktuelle in bearbeitung: {$title}";
$edit_success = "<i>{$title}</i> wurde bearbeitet";
$edit_desc_button = "Bearbeite die Videobeschreibung";
//Type: publish
$publish_hl = "<i>{$title}</i> ist nun &ouml;ffentlich";
//Type: delete
$delete_hl = "<i>{$title}</i> wurde gel&ouml;scht";


/*******************************************/

//settings.php -> Tabel of description for Shortcodes and ability to creat categorys
$settings_hl = "Einstellungen";
//Creat category |  Formlabels
$creat_hl = "Erstelle eine Kategorie";
$name_of_cat_label = "Name der Kategorie";
$desc_label = "Kurze Beschreibung";
$subcat_label = "Unterkategorie von";
$new_main_cat_label = "Neue Hauptkategorie";
$creat_cat_button = "Kategorie erstellen";
//Shortcode table
//Tabelhead
$sc_hl = "Shortcodes";
$sc_name_hl = "Shortcode";
$sc_desc_hl = "Beschreibung";
//scortcode Descriptions
$sc_lastvideo_desc = nl2br("Gibt die zuletzt hinzugef&uuml;gten Videos aus. x ist die Anzahl der Videos. 
Standartwert: 10");
$sc_singlevideo_desc = nl2br("Gibt den Videoplayer des Videos ohne Beschreibung aus
Standartwert: 0 (Letzter Post (Es handelt sich nicht immer um ein Video!))
F&uuml;r ein bestimmtes Video, w&auml;hle den Shortcode von der &Uuml;bersichtsseite");
?>
Hallo