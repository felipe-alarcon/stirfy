<?php
require_once('DB.php');
class Video extends DB
{


	//this constructor inherits from DB contructor
	public function __construct()
	{
		parent::__construct();
	}

	private static function select_table($table)
	{
		switch($table):
			case "English":
				$table = "English";
				break;
			default:
				return false;
		endswitch;

		return $table;

	}

	public function get_id()
	{
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			return $id;
		}
		else
		{
			header("Location: http://stirfy.com");
			exit();
		}
	}


	//this function fetches all the data available in the English table
	public function fetch_all($table)
	{
		$filtered_table = static::select_table($table);

		$sql = 'SELECT * FROM ' . $filtered_table;
		$query = $this->pdo->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	//this function only fetches the id which is not the video_id itself
	//but the primary key auto incremented id.
	public function fetch_data($id, $table)
	{
		$filtered_table = static::select_table($table);

		$sql = 'SELECT * FROM ' . $filtered_table . ' WHERE id=?';
		$query = $this->pdo->prepare($sql);
		$query->bindValue(1, $id);
		$query->execute();

		return $query->fetch();
	}


	//this function gets the number of row in my database so I can display ramdom video in that range
	public function count_rows($table)
	{
		$filtered_table = static::select_table($table);

		$sql = 'SELECT count(*) FROM ' . $filtered_table . ' WHERE id > 0';
		$query = $this->pdo->prepare($sql);
		$query->execute();

		return $query->fetchColumn();
	}

	/*this generates a random number in between 1 and the number of
	rows you currently have on any passed table!*/
	public function generate_random_numbers($rows, $delimiter)
	{
		$numbers = array();


	    if($delimiter > $rows)
	        return [];

	    $numbers = range(1, $rows);
	    shuffle($numbers);
	    return array_slice($numbers, 0, $delimiter);

	}
	//this function will get the row I pass it individually
	public function get_row($id, $table)
	{
		$filtered_table = static::select_table($table);

		$sql    = 'SELECT * FROM '. $filtered_table .' WHERE id = :id';
		$stmt   = $this->pdo->prepare($sql);
		$result = $stmt->execute(array(":id" => $id));
		$row   = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row;
	}

	//related videos
	public function related_videos($current_video_category, $table)
	{
		$filtered_table = static::select_table($table);

		$sql = 'SELECT * FROM '. $filtered_table .' WHERE video_category = :current_video_category';
		$stmt = $this->pdo->prepare($sql);
		$result = $stmt->execute(array(":current_video_category" => $current_video_category));
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function count_rows_by_category($current_video_category, $table)
	{
		$filtered_table = static::select_table($table);

		$sql = 'SELECT count(*) FROM ' . $filtered_table . ' WHERE video_category = :current_video_category';
		$query = $this->pdo->prepare($sql);
		$query->execute(array(":current_video_category" => $current_video_category));

		return $query->fetchColumn();
	}

	public function get_most_watched($table)
	{
		$filtered_table = static::select_table($table);

		$current_rows = $this->count_rows($filtered_table);

		$random = $this->generate_random_numbers($current_rows, 8);

		$videos = array();

		for($i = 0; $i < 8; $i++)
		{
			$videos[$i] = $this->get_row($random[$i], $filtered_table);
		}

		return $videos;
	}

	public function get_related($id, $table)
	{
		$filtered_table = static::select_table($table);

		// fetches data frpm database
		$data = $this->fetch_data($id, $filtered_table);

		// determines what the current video category is
	    $current_category = $data['video_category'];

	    // returns the rows that match current video category
	    $rows_category = $this->count_rows_by_category($current_category, $filtered_table);

	    // returns related videos depending on category
	    $by_category = $this->related_videos($current_category, $filtered_table);


	    $id_numbers = array();

	    for($i = 0;$i < $rows_category;$i++)
	    {
	        $id_numbers[$i] = $by_category[$i]['id'];
	    }
	    shuffle($id_numbers);
	    array_slice($id_numbers, 0, 4);

	    $related = array();

	    for($i = 0; $i < 4; $i++)
	    {
	    	$related[$i] = $this->get_row($id_numbers[$i], $filtered_table);
	    }
	    return $related;
	}
}
