<?php
require_once("DB.php");

class Admin extends DB
{
	private static $data = array(
		"username" => "",
		"password" => ""
	);


	public function __construct()
	{
		session_start();
		parent::__construct();
	}

	// this function will process input from login.php to validate admin credentials
	public function login_action()
	{
		if(isset($_POST['submit']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            header("Location: index.php");
            exit();

        }
	}

	// this function would go in index.php and redirects to login.php if session variables don't match
	public function check_credentials()
	{
		if($_SESSION['username'] != static::$data['username'])
		{
			header("Location: login.php");
			exit();
		}
		elseif ($_SESSION['password'] != static::$data['password'])
		{
			header("Location: login.php");
			exit();
		}
		else
		{
			return true;
		}
	}

	/**********************************************************/



	public function log_video_info($video_id, $video_title, $video_category, $table)
	{
		$sql = 'INSERT INTO ' . $table . ' (video_id, video_title, video_category) VALUES (:video_id, :video_title, :video_category)';

		$query = $this->pdo->prepare($sql);

		$query->execute(array(
			":video_id" => $video_id,
			":video_title" => $video_title,
			":video_category" => $video_category
		));
	}


}
