<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<?php
function play_media($title, $filepath, $description, $type){
	if(substr($type,0,5)=="image") //view image
	{
		echo "<h3>".$title."</h3>";
		echo '<img src="'.$filepath.'"'.' style="width: 75%; border:5px solid #8bcdcd; margin:10px; float:up"/>';
    echo "<h4>".$description."</h4>";
	}

	else if(substr($type,0,5)=='audio') //view audio
	{
		echo "<h3>".$title."</h3>";
		echo '<figure><figcaption style="color:#2d6187; font-size:20px">'
		.$title.'</figcaption><audio controls controlsList="nodownload" src="'.$filepath.'"'.
		'">Your browser does not support the <code>audio</code>element.</audio></figure><br>';
    echo "<h4>".$description."</h4>";
	}

	else if(substr($type,0,5)=='video') // view video
	{
		echo "<h3>".$title."</h3>";
		// if video is in wmv format, it has to be embedded into an object
		if(preg_match('/.wmv$/', $type))
		{
?>
			<object id="MediaPlayer" width="75%" classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">
				<param name="filename" value="<?php echo $filepath;?>">
				<param name="Showcontrols" value="True">
				<param name="autoStart" value="True">
				<param name="Loop" value="1">
				<embed type="application/x-mplayer2" src="<?php echo $filepath; ?>" name="MediaPlayer" autostart="1" showstatusbar="1" showdisplay="1" showcontrols="1" loop="0" videoborder3d="0" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" width=836 height=600></embed>
			</object>
<?php
		}
		// autoplay the video using the <video> tag
		else
		{
			echo '<video width="75%" controls autoplay controlsList="nodownload"><source src="'.$filepath.'"'.
			'">Your browser does not support the <code>video</code>tag.</video>';
		}
    echo "<h4>".$description."</h4>";
	}
 else{
   echo '<meta http-equiv="refresh" content="0;url=../browse.php">';
 }
}
?>
</body>
</html>
