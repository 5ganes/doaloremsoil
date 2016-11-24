<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}
else if($users->getUserType($_SESSION['sessUserId'])!=1){
  header("Location: login.php");
  exit();
}

if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;
	
$weight = $recommendation -> getLastWeight();
if($_GET['type'] == "edit")
{
	//echo "dfd"; 
	$idd=$_GET['id']; //echo $idd;
	$result = mysql_fetch_assoc(mysql_query("select * from recommendation where rm_id='$idd'"));
	extract($result);
	//extract($editRow);
}
if($_POST['type'] == "Save")
{
	extract($_POST);

  if(empty($crop_name))
    $errMsg .= "<li>Please enter crop name</li>";

	if(is_nan($nitrogen_max))
		$errMsg .= "<li>Please enter nitrogen max value</li>";
	if(is_nan($nitrogen_mid))
		$errMsg .= "<li>Please enter nitrogen mid value</li>";
	if(is_nan($nitrogen_min))
		$errMsg .= "<li>Please enter nitrogen min value</li>";
  
  if(is_nan($phosphorus_max))
    $errMsg .= "<li>Please enter phosphorus max value</li>";
  if(is_nan($phosphorus_mid))
    $errMsg .= "<li>Please enter phosphorus mid value</li>";
  if(is_nan($phosphorus_min))
    $errMsg .= "<li>Please enter phosphorus min value</li>";
		
  if(is_nan($potas_max))
    $errMsg .= "<li>Please enter potas max value</li>";
  if(is_nan($potas_mid))
    $errMsg .= "<li>Please enter potas mid value</li>";
  if(is_nan($potas_min))
    $errMsg .= "<li>Please enter potas min value</li>";

	if(empty($errMsg))
	{
		$pid = $recommendation -> save($id,$crop_name,$nitrogen_max,$nitrogen_mid,$nitrogen_min,$phosphorus_max,$phosphorus_mid,$phosphorus_min,$potas_max,$potas_mid,$potas_min,$publish,$weight);
		if($id > 0)
			$pid = $id;
		if($id>0)
			header("Location: recommendation.php?type=edit&id=$id&msg=Recommendation details updated successfully");
		else
			header("Location: recommendation.php?msg=Recommendation details saved successfully");
		exit();
	}		
}

if($_GET['type'] == "tooglePublish")
{
	$id = $_GET['id'];
	$changeTo = $_GET['changeTo'];
	
	$sql = "UPDATE recommendation SET publish='$changeTo' WHERE rm_id='$id'";
	$conn->exec($sql);
	header("location: recommendation.php?&msg=Recommendation Show/Hide status toogled successfully.");
	
}

if($_GET['type']=="del")
{
		$delid=$_GET['id'];
		mysql_query("delete from recommendation where rm_id='$delid'"); //$groups -> delete($_GET['id']);
		//echo "hello";
		//header("Location : recommendation.php?&msg=product deleted successfully.");?>
    	<script> document.location='recommendation.php?&msg=Recommendation deleted successfully.' </script>    
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
.number{width:120px;}
.tahomabold11{width: 210px;}
</style>
<script type="text/javascript" src="js/cms.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                      <td class="heading2">&nbsp; खाधतत्व सिफारिस मात्रा
                        <div style="float: right;">
                     	<?
							$addNewLink = "recommendation.php";
							//if(isset($_GET['category']) && !empty($_GET['category']))
								//$addNewLink .= "?category=".$_GET['category'];
						?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a></div></td>
                    </tr>
                    <tr>
                      <td>
                      <form action="<?= $_REQUEST['uri']?>" method="post" enctype="multipart/form-data">
                      	<table width="100%" border="0" cellpadding="4" cellspacing="0">
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
                              <td class="tahomabold11"><strong> वालीको नाम : <span class="asterisk">*</span></strong></td>
                              <td><label for="crop_name"></label>
                                <input style="height:15px;" name="crop_name" type="text" class="text" value="<?=$crop_name?>" required/>			
                           	  </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> नाइट्रोजन कि ग्रा / रोपनी : <span class="asterisk">*</span></strong></td>
                              <td>
                                Max: <input name="nitrogen_max" type="text" class="number" value="<?=$nitrogen_max?>" required/>&nbsp;&nbsp;&nbsp;&nbsp;
                                Mid: <input name="nitrogen_mid" type="text" class="number" value="<?=$nitrogen_mid?>" required/>&nbsp;&nbsp;&nbsp;&nbsp;
                                Min: <input name="nitrogen_min" type="text" class="number" value="<?=$nitrogen_min?>" required/>			
                           	  </td>
                            </tr>
                            <tr><td></td></tr>

                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> फस्फोरस कि ग्रा / रोपनी : <span class="asterisk">*</span></strong></td>
                              <td>
                                Max: <input name="phosphorus_max" type="text" class="number" value="<?=$phosphorus_max?>" required/>&nbsp;&nbsp;&nbsp;&nbsp;
                                Mid: <input name="phosphorus_mid" type="text" class="number" value="<?=$phosphorus_mid?>" required/>&nbsp;&nbsp;&nbsp;&nbsp;
                                Min: <input name="phosphorus_min" type="text" class="number" value="<?=$phosphorus_min?>" required/>      
                              </td>
                            </tr>
                            <tr><td></td></tr>

                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> पोटास कि ग्रा / रोपनी : <span class="asterisk">*</span></strong></td>
                              <td>
                                Max: <input name="potas_max" type="text" class="number" value="<?=$potas_max?>" required/>&nbsp;&nbsp;&nbsp;&nbsp;
                                Mid: <input name="potas_mid" type="text" class="number" value="<?=$potas_mid?>" required/>&nbsp;&nbsp;&nbsp;&nbsp;
                                Min: <input name="potas_min" type="text" class="number" value="<?=$potas_min?>" required/>      
                              </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Publish : <span class="asterisk">*</span></strong></td>
                              <td>
                              	<input type="radio" name="publish" value="Yes" checked="checked" /> Yes
                                <input type="radio" name="publish" value="No" 
								                <? if($publish=="No"){ echo 'checked="checked"';}?> /> No		
                           	  </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Weight : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="weight" type="text" class="number" value="<?=$weight?>"/>			
                           	  </td>
                            </tr>
                            <tr><td></td></tr>
                            
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
                      <td class="heading2">&nbsp;खाधतत्व सिफारिस मात्रा</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td>सी.न.</td>
                            <td style="width:130px"> वालीको नाम </td>
                            <td style="width:130px"> नाइट्रोजन कि ग्रा/रोपनी(max/mid/min) </td>
                            <td style="width:130px"> फस्फोरस कि ग्रा/रोपनी(max/mid/min) </td>
                            <td style="width:155px"> पोटास कि ग्रा/रोपनी(max/mid/min) </td>

                            <td style="width:50px"> Publish </td>
                            <td style="width:50px"> Weight </td>
                            <td style="width:140px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "recommendation.php?";
							$sql = "SELECT * FROM recommendation";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 100;
							include("paging.php");
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?php echo ++$counter;?></td>
                                    <td valign="top"><?= $row['crop_name'] ?></td>
                                    <td valign="top">
                                      <?= $row['nitrogen_max']."/".$row['nitrogen_mid']."/".$row['nitrogen_min'] ?>
                                    </td>
                                    <td valign="top">
                                      <?= $row['phosphorus_max']."/".$row['phosphorus_mid']."/".$row['phosphorus_min'] ?>
                                    </td>
                                   	<td valign="top">
                                      <?= $row['potas_max']."/".$row['potas_mid']."/".$row['potas_min'] ?>
                                    </td>
                                    <td valign="top"><?= $row['publish'] ?></td>
                                    <td valign="top"><?= $row['weight'] ?></td>
                                   
                            		<td valign="top"> [ <a href="recommendation.php?type=edit&id=<?= $row['rm_id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this PH Texture from database. Continue?')){ document.location='recommendation.php?type=del&id=<?php echo $row['rm_id']; ?>'; }">Delete</a> ]</td>
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