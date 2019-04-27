<?php
	function make_query_post_id($connect)
	{
		$query = "SELECT * FROM user_post_images where post_id =6 ";
		$result = mysqli_query($connect, $query);
		return $result;
	}
?>
