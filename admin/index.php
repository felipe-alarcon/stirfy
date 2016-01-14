<?php
include("../classes/Admin.php");
include("../classes/Video.php");

$admin = new Admin;
$video = new Video;

$admin->check_credentials();

$counter = $video->count_rows("English");
$counter_10 = $counter - 10;

//tables
$eng = "English";

if(isset($_POST['submit']))
{
	if(empty($_POST['video_id']) || empty($_POST['video_category']) || empty($_POST['eng_title']))
	{
		header("Location: unset.php");
		exit();
	}
	else
	{
		$video_id = $_POST['video_id'];
		$video_category = $_POST['video_category'];
		$eng_title = $_POST['eng_title'];

		$english = ucwords($eng_title);

		$admin->log_video_info($video_id, $english, $video_category, $eng);
	}

}


?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
        <title>Login to admin</title>
    </head>
    <body>
        <p>Welcome to the admin page <?php echo $_SESSION['username']?> <a href="unset.php">Logout</a></p>

        <form action"" method="post" id="main_form">
	        <table>
	        	<tr>
		        	<td><label for="video_id">Video ID:</label></td>
		        	<td><input name="video_id" type="text" id="video_id"></td>
	        	</tr>
	        	<tr>
	        		<td><label for="video_category">Video Category:</label></td>
	        		<td>
	        			<select name="video_category" id="video_category">
							  <option value="love">love</option>
							  <option value="humor">humor</option>
							  <option value="cars">cars</option>
							  <option value="puppies">puppies</option>
							  <option value="cats">cats</option>
							  <option value="birds">birds</option>
							  <option value="fights">fights</option>
							  <option value="sea">sea</option>
							  <option value="crazy">crazy</option>
							  <option value="tech">tech</option>
							  <option value="arts">arts</option>
							  <option value="music">music</option>
						</select>
	        		</td>
	        	</tr>
	        	<tr>
		        	<td><label for="eng_title">English Title:</label></td>
		        	<td><input name="eng_title" type="text" id="eng_title" size="120"></td>
	        	</tr>
		        <tr>
		        	<td><input type="submit" name="submit" value="submit"></td>
		        </tr>
	        </table>
        </form>

			<?php
			while($counter != $counter_10)
			{
				$videos = $video->fetch_data($counter, "English");
			?>

			<div style="border:1px solid black; margin: 20px">
				<img src="http://i1.ytimg.com/vi/<?php echo $videos['video_id']?>/mqdefault.jpg">
				<p style="color:blue"><?php echo $videos['video_title']?></p>
				<p>ID: <?php echo $videos['id']?></p>
				<p>Category: <?php echo $videos['video_category']?></p>
			</div>


			<?php $counter--; }?>
    </body>
</html>
