<?php
	session_start();
	include "../function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>MeTube-Recommendation</title>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet">
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<script type="text/javascript">
</script>
<style>
table, th, td {
  border: 1px solid #aaaaaa;
  padding: 7px;
}
a{
  color:#1b6ca8;
}
<style>
div.gallery {
  margin: 5px;
  border: 2px solid #ccc;
  float: left;
  width: 205px;
	height:auto;
}

div.gallery:hover {
  border: 3px solid #8bcdcd;
}

div.gallery img {
  width: 200px;
  height: auto;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

figure {
    margin: 0;
}
</style>
</style>
</head>
<body>
<?php
  if(isset($_GET['id']))
  {
    $mediaid=$_GET['id'];
    $query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
    $result = mysql_query($query) or die ("Retrieving from media table failed. Could not query the database: <br/>". mysql_error());
    $result_row = mysql_fetch_row($result);

    // get the category information of the current media
    $array = explode(':',$result_row[6]);
    $category = $array[0];
    mysql_free_result($result);
    // try to search for the media that has the same category type and shuffle the returned results
    $query2 = "SELECT * FROM media WHERE category REGEXP '^$category' and mediaid != '$mediaid' ORDER BY RAND()";
    $result2 = mysql_query($query2) or die ("Retrieving from media table failed. Could not query the database: <br/>". mysql_error());
    $count = mysql_num_rows($result2);
    // The priority is the media of the same subtype of the category
    if($count!=0)
    {
      $i = 0;
      echo "<table width='100%'><tr>";
      while($line= mysql_fetch_array($result2) and $i < 3)
      {
        $filepath=$line['filepath'];
        $title=$line['title'];
        $mediaid=$line['mediaid'];
        $view_link_address="media_view.php?id=".$mediaid;
        // display the media files based on Image, Audio, Video
        if($category=="Image")
        {
					// display the images (the syntax is very important!)
?>
					<td><div class="gallery"><a target='_parent' href="<?php echo $view_link_address;?>">
						<img src="<?php echo $filepath;?>" alt="<?php echo $title;?>"/></a>
						<div class="desc" style="color:#2d6187; font-size:15px;"><?php echo $title;?><br></div></td>

<?php   }
        else if($category=="Audio")
        {
?>
					<td><a target='_parent' href="<?php echo $view_link_address;?>"><figure><figcaption style="color:#2d6187; font-size:20px"/>
						<?php echo $title;?></figcaption><audio controls controlsList="nodownload" src="<?php echo $filepath;?>">
							Your browser does not support the <code>audio</code>element.</audio></figure></a><br></td>
<?php   }
        else if($category=="Video")
        {
?>
					<td><video width="350px" oncanplay="this.muted=true" onmouseover="this.play()" onmouseout="this.pause();this.currentTime=this.currentTime;">
							<source src="<?php echo $filepath;?>">Your browser does not support the <code>video</code>tag.</video>
								<a target='_parent' href="<?php echo $view_link_address;?>"><?php echo $title;?></a><br></td>
<?php   }
        $i = $i + 1;
      }
      echo "</tr></table>";
    }
		else echo"<h4>No recommended media.</h4>";
		mysql_free_result($result2);
  }
?>
</body>
</html>
