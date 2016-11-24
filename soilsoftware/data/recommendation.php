<?php
class Recommendation
{	
	function save($id,$crop_name,$nitrogen_max,$nitrogen_mid,$nitrogen_min,$phosphorus_max,$phosphorus_mid,$phosphorus_min,$potas_max,$potas_mid,$potas_min,$publish,$weight)
	{
		global $conn;

		$id = cleanQuery($id);
		$crop_name = cleanQuery($crop_name);
		$nitrogen_max = cleanQuery($nitrogen_max);
		$nitrogen_mid = cleanQuery($nitrogen_mid);
		$nitrogen_min = cleanQuery($nitrogen_min);
		$phosphorus_max = cleanQuery($phosphorus_max);
		$phosphorus_mid = cleanQuery($phosphorus_mid);
		$phosphorus_min = cleanQuery($phosphorus_min);
		$potas_max = cleanQuery($potas_max);
		$potas_mid = cleanQuery($potas_mid);
		$potas_min = cleanQuery($potas_min);

		$publish = cleanQuery($publish);
		$weight = cleanQuery($weight);
		
		if($id > 0)
			$sql = "UPDATE recommendation
					SET
						crop_name = '$crop_name',
						nitrogen_max = '$nitrogen_max',
						nitrogen_mid = '$nitrogen_mid',
						nitrogen_min = '$nitrogen_min',
						phosphorus_max = '$phosphorus_max',
						phosphorus_mid = '$phosphorus_mid',
						phosphorus_min = '$phosphorus_min',
						potas_max = '$potas_max',
						potas_mid = '$potas_mid',
						potas_min = '$potas_min',
						publish = '$publish',
						weight = '$weight'
					WHERE
						rm_id = '$id'";
		else
			$sql = "INSERT INTO recommendation
					SET
						crop_name = '$crop_name',
						nitrogen_max = '$nitrogen_max',
						nitrogen_mid = '$nitrogen_mid',
						nitrogen_min = '$nitrogen_min',
						phosphorus_max = '$phosphorus_max',
						phosphorus_mid = '$phosphorus_mid',
						phosphorus_min = '$phosphorus_min',
						potas_max = '$potas_max',
						potas_mid = '$potas_mid',
						potas_min = '$potas_min',
						publish = '$publish',
						weight = '$weight'";

		$conn->exec($sql);
		if($id > 0)
			return $conn -> affRows();
		return $conn->insertId();
	}

	function getById($id)

	{
		global $conn;

		$id = cleanQuery($id);

		$sql = "SElECT * FROM recommendation WHERE id = '$id'";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function getLastWeight()
	{
		global $conn;
		$sql = "SElECT weight FROM recommendation ORDER BY weight DESC LIMIT 1";
		$result = $conn->exec($sql);
		$numRows = $conn -> numRows($result);
		if($numRows > 0)
		{
			$row = $conn->fetchArray($result);
			return $row['weight'] + 10;
		}
		else
			return 10;
	}

	function getRecommByRange($nitrogen_range,$phosphorus_range,$potas_range){
		global $conn;
		$sql="select crop_name,$nitrogen_range,$phosphorus_range,$potas_range from recommendation order by weight ASC";
		// echo $sql; die();
		$result=$conn->exec($sql);
		return $result;
	}

}