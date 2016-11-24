<?php
	function getDistrictList(){
		global $conn;
		$sql="select id as district_id, name as district_name from district order by weight";
		$result=$conn->exec($sql);
		return $result;
	}