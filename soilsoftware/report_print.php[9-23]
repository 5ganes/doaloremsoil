<?php
  include("init.php");
  if(!isset($_SESSION['sessUserId']))//User authentication
  {
   header("Location: login.php");
   exit();
  }
  if(isset($_GET['report_id'])){
    $report_id = $_GET['report_id'];
    $report = $conn->fetchArray($conn->exec("select report_table.*, district.name as district_name from report_table inner join district on report_table.district=district.id where report_id='$report_id'"));
    extract($report);
    // echo $report_id.$district_name; die();
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Soil Software - Report</title>
  <link rel="stylesheet" type="text/css" href="css/report_css.css">

  <!--printing-->
  <script>
    function printContent(el){
      //document.getElementById(e1).style="font-size:15px";
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
    }
  </script>
  <!--end printing-->

  <style type="text/css">
  .print{padding: 6px 14px;background: #006991;color: white;text-decoration: none;font-weight: bold;font-size: 14px;border-radius: 5px;}
  .print:hover{background: #0094cc; color:#f0f0f0;}
  </style>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
  <div class="container" id="print">
    
    <div class="header">
      <div class="logo left"><img src="images/logo.png"></div>
      <div class="title left">
        <h5>नेपाल सरकार</h5>
        <h5>कृषि विकास मन्त्रालय</h5>
        <h4>कृषि विभाग</h4>
        <h3>माटो व्यवस्थापन निर्देशनालाय</h3>
        <h5>हरिहरभवन, ललितपुर</h5>
      </div>
      <div class="contact right">फोन : ५५२०३१४ <br> फ्याक्स : ५५५३७९१</div>
      <div class="clear"></div>
    </div>

    <div class="subject">
      माटो स्वस्थता प्रमाणपत्र तथा मलखाद सिफारिस प्रतिवेदन
    </div>

    <div class="darta_date">
      <div class="darta left"> प्र. दर्ता नं : <?=$registration_number;?></div>
      <div class="date right">मिति : <?=$generated_date;?></div>
      <div class="clear"></div>
    </div>

    <div class="member_detail">
      <div class="shree left"> श्री <?=$name?></div>
      <div class="shree left"> जग्गाको ठेगाना : <?=$land_address;?></div>
      <div class="shree left"> वडा नं : <?=$ward_number;?></div>
      <div class="shree left"> जिल्ला : <?=$district_name;?></div>
      <div class="shree left"> कित्ता नं : <?=$kitta_number;?></div>
      <div class="shree left"> खेत / बारी : <?=$khet_baari;?></div>
      <div class="clear"></div>
    </div>

    <div class="soil_status">
      <div class=""> <u><b>माटो स्वस्थताको अवस्था</b></u> : &nbsp;&nbsp;&nbsp;माटोको बनोट : <?php if($sand_format==1) echo 'पहाड दोमट'; else 'तराइ दोमट';?></div>
    </div>

    <div class="status_values">
      <table border="1" style="width:100%">
        <tr>
          <th>पि. एच.</th>
          <th>प्राङ्गारिक पदार्थ(%)</th>
          <th>नाइट्रोजन(%)</th>
          <th>फस्फोरस(कि. ग्रा. / हे.)</th>
          <th>पोटास(कि. ग्रा. / हे.)</th>
        </tr>
        <tr style="border:none">
          <td><?=$ph_value;?></td>
          <td><?=$organic_value;?></td>
          <td><?=$nitrogen_value;?></td>
          <td><?=$phosphorus_value;?></td>
          <td><?=$potas_value;?></td>
        </tr>
      </table>
    </div>

    <div class="sipharis">
      <div class="sipharis_title">सिफारिस प्रतिवेदन</div>
      <?php
        if($sand_format==1) $format='pahad_domat'; else if($sand_format==2) $format='tarai_domat';
        $chun_value=$ph_texture->getValueByFieldAndPhValue($format,$ph_value);
      ?>
      <div style="line-height: 1.6em">(१) &nbsp;&nbsp; कृषि चुन <b><?php echo $chun_value;?></b> कि ग्रा प्रति रोपनी<br>
        (२) &nbsp;&nbsp; रासायनिक मलको साथमा गुणस्तरीय प्राङ्गारिक मल तल दिइएको मात्रामा अनिबार्य प्रयोग गर्नुहोस
        <div class="ropani_table">
          <table border="1" style="width:100%">
            <tr style="border:none">
              <td><li> १५०० कि. ग्रा. वा ६० डोको प्रति रोपनी</li></td>
              <td><li> १००० कि. ग्रा. वा ४० डोको प्रति रोपनी</li></td>
              <td><li> ५०० कि. ग्रा. वा २० डोको प्रति रोपनी</li></td>
            </tr>
          </table>
        </div>
        (३) &nbsp;&nbsp; <b>खाधतत्व सिफारिस मात्रा</b>

        <div class="crop_table">
          <table border="1" cellpadding="-10" style="width:100%">
            <tr>
              <th>वालीको नाम</th>
              <th>नाइट्रोजन कि. ग्रा. / रोपनी</th>
              <th>फस्फोरस कि. ग्रा. / रोपनी </th>
              <th>पोटास कि. ग्रा. / रोपनी </th>
            </tr>
            <?php
            if($nitrogen_value<=2) $nitrogen_range='nitrogen_min';
            else if($nitrogen_value>2 and $nitrogen_value<4) $nitrogen_range='nitrogen_mid';
            else if($nitrogen_value>=4) $nitrogen_range='nitrogen_max';

            if($phosphorus_value<=2) $phosphorus_range='phosphorus_min';
            else if($phosphorus_value>2 and $phosphorus_value<4) $phosphorus_range='phosphorus_mid';
            else if($phosphorus_value>=4) $phosphorus_range='phosphorus_max';

            if($potas_value<=2) $potas_range='potas_min';
            else if($potas_value>2 and $potas_value<4) $potas_range='potas_mid';
            else if($potas_value>=4) $potas_range='potas_max';

            $recomm=$recommendation->getRecommByRange($nitrogen_range,$phosphorus_range,$potas_range);
            while($rem_row=$conn->fetchArray($recomm)){?>  
              <tr style="border: none; font-size: 10px">
                <td><p style="margin: 0 0 0 2%;"><?php echo $rem_row['crop_name'];?></p></td>
                <td><?=$rem_row[$nitrogen_range];?></td>
                <td><?=$rem_row[$phosphorus_range];?></td>
                <td><?=$rem_row[$potas_range];?></td>
              </tr>
            <? }?>
          
          </table>
        </div>
      </div>
    </div>

    <div class="technician_verifier">
      <div class="left">
        .......................<br>
        ( प्राबिधिक )
      </div>
      <div class="right">
        .......................<br>
        ( प्रमाणित गर्ने )
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="container">
    <div style="margin: 15px 0 30px 0">
      <a href="" class="print" onclick="printContent('print')">रिपोर्ट प्रिन्ट गर्नुहोस</a>
    </div>
  </div>

</body>
</html>
