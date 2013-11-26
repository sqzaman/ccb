<div class="player_list">
<?php foreach ($rows as $count => $row): ?>

     <?php if(($count%3)==0 && $count > 0):?> </div> <div class="player_list"> <?php endif;  ?>
     <dl>
      	<dt><a href="player_profile.html"><?php print  $row['field_players_photo_fid'] ; ?></a></dt>
          <dd>
          	<h4><a href="/player/<?php print  $row['nid'] ; ?>/statistics"><?php print  $row['title'] ; ?></a></h4>
              <span class="txt01"><?php print  $row['field_players_club_nid'] ; ?></span>
              <span class="txt01"><b>Age:</b> <?php print  $row['field_dob_value'] ; ?></span>
              <span class="txt01"><b>Playing role:</b> <?php print  $row['field_players_role_value'] ; ?></span>
              <span class="txt01"><b>Batting:</b> <?php print  $row['field_bating_style_value'] ; ?></span>
              <span class="txt01"><b>Bowling:</b>  <?php print  $row['field_bowling_style_value'] ; ?></span>
          </dd>
      </dl>
<?php endforeach ?>      
</div>


