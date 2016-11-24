<?php
class Phtexture
{	
	function save($id, $ph_value, $pahad_balaute_domat, $pahad_domat, $pahad_chimtyaelo_domat, $tarai_balaute_domat, $tarai_domat, $tarai_chimtyaelo_domat, $publish, $weight)
	{
		global $conn;

		$id = cleanQuery($id);
		$ph_value = cleanQuery($ph_value);
		$pahad_balaute_domat = cleanQuery($pahad_balaute_domat);
		$pahad_domat = cleanQuery($pahad_domat);
		$pahad_chimtyaelo_domat = cleanQuery($pahad_chimtyaelo_domat);
		$tarai_balaute_domat = cleanQuery($tarai_balaute_domat);
		$tarai_domat = cleanQuery($tarai_domat);
		$tarai_chimtyaelo_domat = cleanQuery($tarai_chimtyaelo_domat);
		$publish = cleanQuery($publish);
		$weight = cleanQuery($weight);
		
		if($id > 0)
			$sql = "UPDATE ph_texture
					SET
						ph_value = '$ph_value',
						pahad_balaute_domat = '$pahad_balaute_domat',
						pahad_domat = '$pahad_domat',
						pahad_chimtyaelo_domat = '$pahad_chimtyaelo_domat',
						tarai_balaute_domat = '$tarai_balaute_domat',
						tarai_domat = '$tarai_domat',
						tarai_chimtyaelo_domat = '$tarai_chimtyaelo_domat',
						publish = '$publish',
						weight = '$weight'
					WHERE
						ph_id = '$id'";
		else
			$sql = "INSERT INTO ph_texture
					SET
						ph_value = '$ph_value',
						pahad_balaute_domat = '$pahad_balaute_domat',
						pahad_domat = '$pahad_domat',
						pahad_chimtyaelo_domat = '$pahad_chimtyaelo_domat',
						tarai_balaute_domat = '$tarai_balaute_domat',
						tarai_domat = '$tarai_domat',
						tarai_chimtyaelo_domat = '$tarai_chimtyaelo_domat',
						publish = '$publish',
						weight = '$weight'";

		$conn->exec($sql);
		if($id > 0)
			return $conn -> affRows();
		return $conn->insertId();
	}

	function getDistricts()
	{
		global $conn;

		$sql = "SElECT * FROM ph_texture order by weight";
		$result = $conn->exec($sql);
		return $result;
	}

	function getById($id)

	{
		global $conn;

		$id = cleanQuery($id);

		$sql = "SElECT * FROM ph_texture WHERE id = '$id'";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function getLastWeight()
	{
		global $conn;
		$sql = "SElECT weight FROM ph_texture ORDER BY weight DESC LIMIT 1";
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

	function getValueByFieldAndPhValue($field_name,$ph_value){
		global $conn;
		$sql="select $field_name from ph_texture where ph_value='$ph_value'";
		// echo $sql; die();
		$result=mysql_query($sql);
		$data = mysql_fetch_array($result);
		return $data['pahad_domat']; die();
	}
}