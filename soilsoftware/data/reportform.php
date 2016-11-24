<?php
class Reportform
{	
	function save($id,$generated_date,$registration_number,$name,$land_address,$ward_number,$district,$kitta_number,$khet_baari,$sand_format,$ph_value,$organic_value,$nitrogen_value,$phosphorus_value,$potas_value)
	{
		global $conn;

		$id = cleanQuery($id);
		$generated_date = cleanQuery($generated_date);
		$registration_number = cleanQuery($registration_number);
		$name = cleanQuery($name);
		$land_address = cleanQuery($land_address);
		$ward_number = cleanQuery($ward_number);
		$district = cleanQuery($district);
		$kitta_number = cleanQuery($kitta_number);
		$khet_baari = cleanQuery($khet_baari);
		$sand_format = cleanQuery($sand_format);
		$ph_value = cleanQuery($ph_value);

		$organic_value = cleanQuery($organic_value);
		$nitrogen_value = cleanQuery($nitrogen_value);
		$phosphorus_value = cleanQuery($phosphorus_value);
		$potas_value = cleanQuery($potas_value);
		
		if($id > 0)
			$sql = "UPDATE report_table
					SET
						generated_date = '$generated_date',
						registration_number = '$registration_number',
						name = '$name',
						land_address = '$land_address',
						ward_number = '$ward_number',
						district = '$district',
						kitta_number = '$kitta_number',
						khet_baari = '$khet_baari',
						sand_format = '$sand_format',
						ph_value = '$ph_value',
						organic_value = '$organic_value',
						nitrogen_value = '$nitrogen_value',
						phosphorus_value = '$phosphorus_value',
						potas_value = '$potas_value'
					WHERE
						report_id = '$id'";
		else
			$sql = "INSERT INTO report_table
					SET
						generated_date = '$generated_date',
						registration_number = '$registration_number',
						name = '$name',
						land_address = '$land_address',
						ward_number = '$ward_number',
						district = '$district',
						kitta_number = '$kitta_number',
						khet_baari = '$khet_baari',
						sand_format = '$sand_format',
						ph_value = '$ph_value',
						organic_value = '$organic_value',
						nitrogen_value = '$nitrogen_value',
						phosphorus_value = '$phosphorus_value',
						potas_value = '$potas_value'";

		$conn->exec($sql);
		if($id > 0)
			return $conn -> affRows();
		return $conn->insertId();
	}

	function getById($id)

	{
		global $conn;

		$id = cleanQuery($id);

		$sql = "SElECT * FROM report_table WHERE report_id = '$id'";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	// function getLastWeight()
	// {
	// 	global $conn;
	// 	$sql = "SElECT weight FROM report_table ORDER BY weight DESC LIMIT 1";
	// 	$result = $conn->exec($sql);
	// 	$numRows = $conn -> numRows($result);
	// 	if($numRows > 0)
	// 	{
	// 		$row = $conn->fetchArray($result);
	// 		return $row['weight'] + 10;
	// 	}
	// 	else
	// 		return 10;
	// }
}