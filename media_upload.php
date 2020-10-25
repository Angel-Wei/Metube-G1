<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
include "media_upload_process.php";
if(!$_SESSION["username"]){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=login_register/login.php\">";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<title>MeTube: Media Upload</title>
<head>
<body>
	<img src="img/logo.png" class="center" alt="Logo of MeTube" style="width:345px;height:131px;">
  <div style="text-align:left; margin:0 auto;">
  <form method="post" action="media_upload_process.php" enctype="multipart/form-data">
    <h2 align="middle">Upload Media</h2>

    <label style="padding-left:500px;" for="file"><b>Please select a file to upload. </b></label><br><br>
    <input style="padding-left:500px;" type="file" name="file"><br><br>

    <label style="padding-left:500px;"><b>Please provide supplementary information of the file.</b></label><br><br>
    <label style="padding-left:500px;" for="title">Title:</label>
    <input type="text" name="title" placeholder="Title"; style="width:400px;"><br><br>

    <label style="padding-left:500px;" for="description">Description of the file:</label><br><br>
    <textarea style="margin-left:500px; font-family: Helvetica;" name="description" rows="4" cols="60">Please give a brief description of the file.</textarea>
    <br><br>

    <label style="padding-left:500px;" for="keyword">Keyword:</label>
    <input type="text" name="keyword" placeholder="Keyword tags:nature, news, music, anime etc."; style="width:400px;"><br><br>

    <!--Create a drop down list to list options for the category-->
    <label style="padding-left:500px;" for="category">Category: </label>
    <select name="category" id="category">
      <optgroup label="Image">
        <option value="Image: static picture">static picture</option>
        <option value="Image: dynamic picture">dynamic picture</option>
        <option value="Image: other">other</option>
      </optgroup>
      <optgroup label="Audio">
        <option value="Audio: song">song</option>
        <option value="Audio: recording file">recording file</option>
        <option value="Audio: other">other</option>
      </optgroup>
      <optgroup label="Video">
        <option value="Video: mv">mv</option>
        <option value="Video: trailer">trailer</option>
        <option value="Video: news">news</option>
        <option value="Video: movie">movie</option>
        <option value="Video: other">other</option>
      </optgroup>
      <option value="Other" selected>Other</option>
    </select><br><br>

    <!--Create a drop down list to list options for privacy-->
    <label style="padding-left:500px;" for="privacy">Privacy: </label>
    <select name="privacy">
      <option value="Public" selected>Public</option>;
      <option value="Friend">Friend</option>;
      <option value="Private">Private</option>;
    </select><br><br>

    <!--Create a drop down list to define permission settings-->
    <label style="padding-left:500px;" for="permission">Permission settings (Comments & Ratings): </label>
    <select name="permission">
      <option value="Public" selected>Allow others to comment and rate</option>;
      <option value="Friend">Only allow friends to comment and rate</option>;
      <option value="Private">No comments and ratings allowed</option>;
    </select><br><br>

    <input style="margin-left:500px; width:100px;" name="reset" class="resetbtn" type="reset" value="Reset">
    <input style="width:100px;" name="submit" class="signupbtn" type="submit" value="Submit">
	</form>
  </div>
</body>
</html>
