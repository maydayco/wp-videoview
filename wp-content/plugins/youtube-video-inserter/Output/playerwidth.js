jQuery(document).ready(function() {
	calcPlayerHeight();
});

jQuery(window).resize(function() 
{
    calcPlayerHeight();
});

function calcPlayerHeight()
{
	try
	{
		var WidthHeightRelation = 5624/9999;
		var videoPlayer = document.getElementById("ytInserterVideo");
		var playerWidth = videoPlayer.offsetWidth;
		//Set height
		var newHeight = playerWidth * WidthHeightRelation + "px";
		videoPlayer.style.height = newHeight;
	}
	catch(error){}
}