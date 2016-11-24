<div id="sidebar-left" class="sidebar cf">
	<div id="widgets-wrap-sidebar-left">
		<div id="text-2" class="widget-sidebar frontier-widget widget_text">
			<?php
		    $officer=$groups->getById(OFFICER); $officer=$conn->fetchArray($officer);
		    ?>
		    <h4 class="widget-title"><? if($lan=='en') echo $officer['nameen']; else echo $officer['name']; ?></h4>
		    <div class="textwidget" style="text-align: center;">
		    	<a href="<?=$officer['urlname']; ?>">
		    		<img src="<?=CMS_GROUPS_DIR.$officer['image'];?>" style="width:180px;height:170px;" />
		    	</a><br>
		        <? if($lan=='en') echo $officer['shortcontentsen']; else echo $officer['shortcontents'];?>
		    </div>
		    <a style="font-weight: bold;font-size: 15px;float: right;" href="<?=$officer['urlname']; ?>">read more...</a>
		</div>

		<div id="text-9" class="widget-sidebar frontier-widget widget_text">
	      <?php
	      $info_officer=$groups->getById(INFO_OFFICER); $info_officer=$conn->fetchArray($info_officer);
	      ?>
	      <h4 class="widget-title"><?php if($lan=='en') echo $info_officer['nameen']; else echo $info_officer['name'];?></h4>
	      <div class="textwidget" style="text-align: center;">
	        <a href="<?=$info_officer['urlname']; ?>">
	        <img src="<?=CMS_GROUPS_DIR.$info_officer['image'];?>" style="width:180px;height:170px;" />
	        </a><br>
	        <? if($lan=='en') echo $info_officer['shortcontentsen']; else echo $info_officer['shortcontents']; ?>
	        <br>
	        <a style="font-weight: bold;font-size: 15px;float: right;" href="<?=$info_officer['urlname']; ?>">read more...</a>
	      </div>
	    </div>
		
		<div id="notice_board_widget-2" class="widget-sidebar frontier-widget widget_notice_board_widget">
			<h4 class="widget-title">
				<? if($lan=='en') echo 'News'; else echo 'सूचना';?>
			</h4>
			<div class="msnb_notice scroll-up">
				<ul class="notice-list">
					<?php
					$news=$groups->getByParentId(NEWS);
					while($newsGet=$conn->fetchArray($news)){?>
						<li>
							<a href="<?=$newsGet['urlname'];?>">
								<? if($lan=='en') echo $newsGet['nameen']; else echo $newsGet['name']?>
							</a>
						</li>
					<?php }?>
				</ul>
			</div>
		</div>		
	</div>
</div>
<div class="dynamic">