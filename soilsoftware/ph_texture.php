<?php
include("init.php");
if(!isset($_SESSION['sessUserId'])){
  //User authentication
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
	
$weight = $ph_texture -> getLastWeight();
if($_GET['type'] == "edit")
{
	//echo "dfd"; 
	$idd=$_GET['id']; //echo $idd;
	$result = mysql_fetch_assoc(mysql_query("select * from ph_texture where ph_id='$idd'"));
	extract($result);
	//extract($editRow);
}
if($_POST['type'] == "Save")
{
	extract($_POST);
	if(is_nan($pahad_balaute_domat))
		$errMsg .= "<li>Please enter numeric pahad balaute domat value</li>";
	if(is_nan($pahad_domat))
		$errMsg .= "<li>Please enter numeric pahad domat value</li>";
	if(is_nan($pahad_chimtyaelo_domat))
		$errMsg .= "<li>Please enter numeric pahad chimtyaelo domat value</li>";
  if(is_nan($tarai_balaute_domat))
    $errMsg .= "<li>Please enter numeric tarai balaute domat value</li>";
  if(is_nan($tarai_domat))
    $errMsg .= "<li>Please enter numeric tarai domat value</li>";
  if(is_nan($tarai_chimtyaelo_domat))
    $errMsg .= "<li>Please enter numeric tarai chimtyaelo domat value</li>";
		
	if(empty($errMsg))
	{
		$pid = $ph_texture -> save($id, $ph_value, $pahad_balaute_domat, $pahad_domat, $pahad_chimtyaelo_domat, $tarai_balaute_domat, $tarai_domat, $tarai_chimtyaelo_domat, $publish, $weight);
		if($id > 0)
			$pid = $id;
		if($id>0)
			header("Location: ph_texture.php?type=edit&id=$id&msg=PH Texture details updated successfully");
		else
			header("Location: ph_texture.php?msg=PH Texture details saved successfully");
		exit();
	}		
}

if($_GET['type'] == "tooglePublish")
{
	$id = $_GET['id'];
	$changeTo = $_GET['changeTo'];
	
	$sql = "UPDATE ph_texture SET publish='$changeTo' WHERE ph_id='$id'";
	$conn->exec($sql);
	header("location: ph_texture.php?&msg=PH Texture Show/Hide status toogled successfully.");
	
}

if($_GET['type']=="del")
{
		$delid=$_GET['id'];
		mysql_query("delete from ph_texture where ph_id='$delid'"); //$groups -> delete($_GET['id']);
		//echo "hello";
		//header("Location : ph_texture.php?&msg=product deleted successfully.");?>
    	<script> document.location='ph_texture.php?&msg=PH Texture deleted successfully.' </script>    
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000
}
-->
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
                      <td class="heading2">&nbsp; कृषि चुनको सिफारिस मात्रा (Kg)
                        <div style="float: right;">
                     	<?
							$addNewLink = "ph_texture.php";
							//if(isset($_GET['category']) && !empty($_GET['category']))
								//$addNewLink .= "?category=".$_GET['category'];
						?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a></div></td>
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
                            <tr><td></td></tr>                    
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> माटोको पी एच मान : <span class="asterisk">*</span></strong></td>
                              <td><label for="ph_value"></label>
                                <input name="ph_value" type="text" class="number" value="<?=$ph_value?>" required/>			
                           	  </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> पहाड बलौटे दोमट : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="pahad_balaute_domat" type="text" class="number" value="<?=$pahad_balaute_domat?>" required/>			
                           	  </td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> पहाड दोमट : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="pahad_domat" type="text" class="number" value="<?=$pahad_domat?>" required/>      
                              </td>
                            </tr>
                            <tr><td></td></tr>

                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> पहाड चिम्टाइलो दोमट : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="pahad_chimtyaelo_domat" type="text" class="number" value="<?=$pahad_chimtyaelo_domat?>" required/>      
                              </td>
                            </tr>
                            <tr><td></td></tr>

                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> तराइ बलौटे दोमट : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="tarai_balaute_domat" type="text" class="number" value="<?=$tarai_balaute_domat?>" required/>      
                              </td>
                            </tr>
                            <tr><td></td></tr>

                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> तराइ दोमट : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="tarai_domat" type="text" class="number" value="<?=$tarai_domat?>" required/>      
                              </td>
                            </tr>
                            <tr><td></td></tr>

                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> तराइ चिम्टाइलो दोमट : <span class="asterisk">*</span></strong></td>
                              <td>
                                <input name="tarai_chimtyaelo_domat" type="text" class="number" value="<?=$tarai_chimtyaelo_domat?>" required/>      
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
                      <td class="heading2">&nbsp;कृषि चुनको सिफारिस मात्रा (Kg)</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td>सी.न.</td>
                            <td style="width:130px"> पी एच मान </td>
                            <td style="width:130px"> पहाड बलौटे दोमट </td>
                            <td style="width:130px"> पहाड दोमट </td>
                            <td style="width:155px"> पहाड चिम्टाइलो दोमट </td>

                            <td style="width:130px"> तराइ बलौटे दोमट </td>
                            <td style="width:130px"> तराइ दोमट </td>
                            <td style="width:130px"> तराइ चिम्टाइलो दोमट </td>

                            <td style="width:50px"> Publish </td>
                            <td style="width:50px"> Weight </td>
                            <td style="width:140px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "ph_texture.php?";
							$sql = "SELECT * FROM ph_texture";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 100;
							include("paging.php");
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?php echo ++$counter;?></td>
                                    <td valign="top"><?= $row['ph_value'] ?></td>
                                    <td valign="top"><?= $row['pahad_balaute_domat'] ?></td>
                                    <td valign="top"><?=$row['pahad_domat'];?></td>
                                   	<td valign="top"><?=$row['pahad_chimtyaelo_domat'];?></td>
                                    <td valign="top"><?= $row['tarai_balaute_domat'] ?></td>
                                    <td valign="top"><?=$row['tarai_domat'];?></td>
                                    <td valign="top"><?=$row['tarai_chimtyaelo_domat'];?></td>
                                    <td valign="top"><?= $row['publish'] ?></td>
                                    <td valign="top"><?= $row['weight'] ?></td>
                                   
                            		<td valign="top"> [ <a href="ph_texture.php?type=edit&id=<?= $row['ph_id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this PH Texture from database. Continue?')){ document.location='ph_texture.php?type=del&id=<?php echo $row['ph_id']; ?>'; }">Delete</a> ]</td>
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