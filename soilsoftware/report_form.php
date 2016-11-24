<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}
if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;
	
// $weight = $report_form -> getLastWeight();
if($_GET['type'] == "edit")
{
	//echo "dfd"; 
	$idd=$_GET['id']; //echo $idd;
	$result = mysql_fetch_assoc(mysql_query("select * from report_table where report_id='$idd'"));
	extract($result);
	//extract($editRow);
}
if($_POST['type'] == "Save")
{
	extract($_POST);

  if(empty($generated_date)) $errMsg .= "<li>Please enter date</li>";
	//if(is_nan($registration_number)) $errMsg .= "<li>Please enter registration number</li>";
	if(is_nan($name)) $errMsg .= "<li>Please enter name</li>";
	if(is_nan($land_address)) $errMsg .= "<li>Please enter land address</li>";
  if(is_nan($ward_number)) $errMsg .= "<li>Please enter ward number</li>";
  if(is_nan($district)) $errMsg .= "<li>Please select district</li>";
  if(is_nan($kitta_number)) $errMsg .= "<li>Please enter kitta_number</li>";
  if(is_nan($khet_baari)) $errMsg .= "<li>Please enter kheti baari</li>";
  if(is_nan($sand_format)) $errMsg .= "<li>Please select sand format</li>";
  if(is_nan($ph_value)) $errMsg .= "<li>Please enter PH value</li>";
  if(is_nan($organic_value)) $errMsg .= "<li>Please enter Organic Value</li>";
  if(is_nan($nitrogen_value)) $errMsg .= "<li>Please enter Nitrogen value</li>";
  if(is_nan($phosphorus_value)) $errMsg .= "<li>Please enter Phosphorus value</li>";
  if(is_nan($potas_value)) $errMsg .= "<li>Please enter Potas value</li>";

	if(empty($errMsg))
	{
		$pid = $report_form -> save($id,$generated_date,$registration_number,$name,$land_address,$ward_number,$district,$kitta_number,$khet_baari,$sand_format,$ph_value,$organic_value,$nitrogen_value,$phosphorus_value,$potas_value);
		if($id > 0)
			$pid = $id;
		if($id>0)
			header("Location: report_form.php?type=edit&id=$id&msg=Report Form details updated successfully");
		else
			header("Location: report_form.php?msg=Report Form details saved successfully");
		exit();
	}		
}

// if($_GET['type'] == "tooglePublish")
// {
// 	$id = $_GET['id'];
// 	$changeTo = $_GET['changeTo'];
	
// 	$sql = "UPDATE report_table SET publish='$changeTo' WHERE rm_id='$id'";
// 	$conn->exec($sql);
// 	header("location: report_form.php?&msg=Recommendation Show/Hide status toogled successfully.");
	
// }

if($_GET['type']=="del")
{
		$delid=$_GET['id'];
		mysql_query("delete from report_table where report_id='$delid'"); //$groups -> delete($_GET['id']);
		//echo "hello";
		//header("Location : report_form.php?&msg=product deleted successfully.");?>
    	<script> document.location='report_form.php?&msg=Report Form deleted successfully.' </script>    
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title><?php echo ADMIN_TITLE; ?></title>
  <link href="css/admin.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  .number{width:120px;}
  .tahomabold11{width: 150px;}
  .text{width:200px;}
  </style>
  <script type="text/javascript" src="js/cms.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <!--for date picker-->
  <script type="text/javascript" src="datepicker/jquery.js"></script>
  <script type="text/javascript" src="datepicker/nepali.datepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="datepicker/nepali.datepicker.css" />
  <script>
    $(document).ready(function(){
      $('.nepali-calendar').nepaliDatePicker();
      $('.collectedDate').nepaliDatePicker();
    });
  </script>
  <!--end date picker-->

</head>
<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0"
	cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#fff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp; माटो स्वस्थता प्रमाणपत्र तथा मलखाद सिफारिस प्रतिवेदन
                        <!-- <div style="float: right;">
                     	    <? //$addNewLink = "report_form.php";?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a>
                        </div> -->
                      </td>
                    </tr>
                    <tr>
                      <td>
                      <form action="<?= $_REQUEST['uri']?>" method="post" enctype="multipart/form-data">
                      	<table width="100%" border="0" cellpadding="3" cellspacing="0">
                          <?php
                          if(!empty($errMsg))
						  {?>
                              <tr align="left">
                                <td colspan="3" class="err_msg"><?php echo $errMsg; ?></td>
                              </tr>
                          <? }?>
                          <tr><td></td></tr><tr><td></td></tr>

                          <tr>
                            <td>&nbsp;</td>
                            <td class="tahomabold11"><strong> मिति : <span class="asterisk">*</span></strong></td>
                            <td style="width:230px"><label for="generated_date"></label>
                              <input style="height:15px;" name="generated_date" type="text" id="nepaliDate" class="nepali-calendar text" value="<?=$generated_date?>" required/>      
                            </td>
                            <td style="width:100px" class="tahomabold11"><strong> प्र. दर्ता नं : <span class="asterisk">*</span></strong></td>
                            <td><label for="registration_number"></label>
                              <input style="height:15px;" name="registration_number" type="text" class="number" value="<?=$registration_number?>"/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>

                          <tr>
                            <td>&nbsp;</td>
                            <td class="tahomabold11"><strong> नाम : <span class="asterisk">*</span></strong></td>
                            <td style="width:230px"><label for="name"></label>
                              <input style="height:15px;" name="name" type="text" class="text" value="<?=$name?>" required/>      
                            </td>
                            <td class="tahomabold11"><strong> जग्गाको ठेगाना : <span class="asterisk">*</span></strong></td>
                            <td style="width:230px"><label for="land_address"></label>
                              <input style="height:15px;" name="land_address" type="text" class="text" value="<?=$land_address?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>

                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> वडा नं : <span class="asterisk">*</span></strong></td>
                            <td><label for="ward_number"></label>
                              <input style="height:15px;" name="ward_number" type="text" class="number" value="<?=$ward_number?>" required/>      
                            </td>
                            <td class="tahomabold11"><strong> जिल्ला : <span class="asterisk">*</span></strong></td>
                            <td style="width:230px"><label for="district"></label>
                              <select name="district" class="text" required>
                                <?php
                                $dist=getDistrictList();
                                // print_r($district); die();
                                while($distGet=$conn->fetchArray($dist)){
                                  if($distGet['district_id']==$district) $selected='selected'; else $selected='';
                                  echo '<option '.$selected.' value="'.$distGet['district_id'].'">'.$distGet['district_name'].'</option>';
                                }
                                ?>
                              </select>      
                            </td>
                          </tr>
                          <tr><td></td></tr>

                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> कित्ता नं : <span class="asterisk">*</span></strong></td>
                            <td><label for="kitta_number"></label>
                              <input style="height:15px;" name="kitta_number" type="text" class="number" value="<?=$kitta_number?>" required/>      
                            </td>
                            <td class="tahomabold11"><strong> खेत / बारी : <span class="asterisk">*</span></strong></td>
                            <td style="width:230px"><label for="khet_baari"></label>
                              <input style="height:15px;" name="khet_baari" type="text" class="text" value="<?=$khet_baari?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>
                          <tr><td></td></tr>

                          <tr>
                            <td colspan="20"><b style="font-size: 15px;"><u>माटो स्वस्थताको अवस्था</u></b></td>
                          </tr>
                          <tr><td></td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> माटोको बनोट : <span class="asterisk">*</span></strong></td>
                            <td><label for="sand_format"></label>
                              <select name="sand_format" class="text" required>
                                <option value="">माटोको बनोट छान्नुहोस्</option>
                                <option value="1" <? if($sand_format==1) echo 'selected'; ?>>पहाड दोमट</option>
                                <option value="2" <? if($sand_format==2) echo 'selected'; ?>>तराइ दोमट</option>
                              </select>      
                            </td>
                          </tr>
                          <tr><td></td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> पि. एच. : <span class="asterisk">*</span></strong></td>
                            <td><label for="ph_value"></label>
                              <input style="height:15px;" name="ph_value" type="text" class="number" value="<?=$ph_value?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> प्राङ्गारिक पदार्थ(%) : <span class="asterisk">*</span></strong></td>
                            <td><label for="organic_value"></label>
                              <input style="height:15px;" name="organic_value" type="text" class="number" value="<?=$organic_value?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> नाइट्रोजन(%) : <span class="asterisk">*</span></strong></td>
                            <td><label for="nitrogen_value"></label>
                              <input style="height:15px;" name="nitrogen_value" type="text" class="number" value="<?=$nitrogen_value?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> फस्फोरस(कि. ग्रा. / हे.) : <span class="asterisk">*</span></strong></td>
                            <td><label for="phosphorus_value"></label>
                              <input style="height:15px;" name="phosphorus_value" type="text" class="number" value="<?=$phosphorus_value?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td style="width:100px" class="tahomabold11"><strong> पोटास(कि. ग्रा. / हे.) : <span class="asterisk">*</span></strong></td>
                            <td><label for="potas_value"></label>
                              <input style="height:15px;" name="potas_value" type="text" class="number" value="<?=$potas_value?>" required/>      
                            </td>
                          </tr>
                          <tr><td></td></tr>


                          <tr><td></td></tr><tr><td></td></tr>

                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                            	<input name="type" type="submit" class="button" id="button" value="Save" />
                            	<?php if($_GET['type'] == "edit"){ ?>
                            	<input type="hidden" value="<?= $id?>" name="id" id="id" />
                              <?php }else{ ?>                                
                              <input name="reset" type="reset" class="button" id="button2" value="Clear" />
                              <?php } ?>
                              </td>
                          </tr>

                        </table>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
			
              <tr height="5"><td></td></tr>
        	<tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp;माटो स्वस्थता प्रमाणपत्र तथा मलखाद सिफारिस प्रतिवेदन</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td>सी.न.</td>
                            <td style="width:80px"> मिति </td>
                            <td style="width:50px"> प्र. दर्ता नं </td>
                            <td style="width:130px"> नाम </td>
                            <td style="width:90px"> जिल्ला </td>
                            <td style="width:80px"> माटोको बनोट </td>
                            <td style="width:40px;"> पि. एच </td>
                            <td> प्राङ्गारिक पदार्थ </td>
                            <td> नाइट्रोजन </td>
                            <td> फस्फोरस </td>
                            <td> पोटास </td>
                            <td style="width:135px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "report_form.php?";
							$sql = "SELECT report_table.*,district.name as district FROM report_table inner join district on report_table.district=district.id";
							$sql .= " ORDER BY report_id DESC";
							//echo $sql;
							$limit = 100;
							include("paging.php");
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?php echo ++$counter;?></td>
                                    <td valign="top"><?= $row['generated_date'] ?></td>
                                    <td valign="top"><?= $row['registration_number']; ?></td>
                                    <td valign="top"><?= $row['name']; ?></td>
                                    <td valign="top"><?= $row['district']; ?></td>
                                    
                                    <td valign="top">
                                      <? if($row['sand_format']=1) echo 'पहाड दोमट'; else if(['sand_format']==2) echo 'तराइ दोमट'; ?>
                                    </td>
                                    <td valign="top"><?= $row['ph_value']; ?></td>
                                    <td valign="top"><?= $row['organic_value']; ?></td>
                                    <td valign="top"><?= $row['nitrogen_value']; ?></td>
                                    <td valign="top"><?= $row['phosphorus_value']; ?></td>
                                    <td valign="top"><?= $row['potas_value']; ?></td>
                                   
                            		<td valign="top"> [ <a href="report_form.php?type=edit&id=<?= $row['report_id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this Report form entry from database. Continue?')){ document.location='report_form.php?type=del&id=<?php echo $row['report_id']; ?>'; }">Delete</a> | <a target="_blank" href="report_print.php?report_id=<?=$row['report_id']?>">Print</a> ]</td>
                          </tr>
                          <?
													}
													?>
                        </table>
                      <?php //include("paging_show.php"); ?></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>	
                
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
<!--<a href="excel.php">Export to Excel</a>-->