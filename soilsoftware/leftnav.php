<ul class="menu">
  <li>
    <p>Manage Credentials</p>
  		<ul>
    		<li><a href="index.php">Home</a></li>
      		<li><a href="changepswd.php">Change Password</a></li>
      		<li><a href="logout.php">Logout</a></li>
    	</ul>
  </li>
  <li>
  	<p>Manage Software</p>
    <ul>
      <?php if($users->getUserType($_SESSION['sessUserId'])==1){?>
        <li><a href="ph_texture.php">Manage PH Texture Table</a></li>
        <li><a href="recommendation.php">Manage Recommendation</a></li>
      <? }?>
      <li><a href="report_form.php">Generate Report</a></li>
    </ul>
  </li>
</ul>