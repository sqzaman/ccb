<div class="team-list">
    <?php 
    $teams = $data['teams'];
    $players =  $data['players'];
    $c = true;
    ?>
    <h2> Teams </h2>
    <ul>
        <?php foreach($teams as $team):?>
        <li <?php print (($c = !$c)?' class="odd"':' class="even"') ?>><a href=<?php print "/ccb/players/". $team->nid?>><?php print $team->title?></a></li>
        <?php endforeach?>
    </ul>
</div>
<div class="player-list-contaner">
    <div class="player_list">
         <h2> Players of <?php echo $data['team_name']?></h2>
    <?php foreach ($players as $count => $row): ?>

         <?php if(($count%3)==0 && $count > 0):?> </div> 
        <div class="player_list"> <?php endif;  ?>
         <dl>
            <dt><a href="/player/<?php print  $row->nid ; ?>/statistics"><?php print theme('imagecache', "player_thumb", $row->field_players_photo[0]['filepath']);?></a></dt>
              <dd>
                    <h4>
                        <a href="/player/<?php print  $row->nid ; ?>/statistics"><?php echo $row->field_players_nick[0]['value'] ; ?></a>
                        <?php if (isset($row->field_team_role[0]['value'])): ?><span style="font-size: 11px">[ <?php print theme('team_role', $row->field_team_role[0]['value']); ?> ]</span><?php endif;?>
                    </h4>
                  
                  <span class="txt01"><b>Age:</b> <?php print calculateAge($row->field_dob[0]['value']); ?></span>
                  <span class="txt01"><b>Playing role:</b> <?php print  $row->field_players_role[0]['value'] ; ?></span>
                  <span class="txt01"><b>Batting:</b> <?php print  $row->field_bating_style[0]['value'] ; ?></span>
                  <span class="txt01"><b>Bowling:</b>  <?php print  $row->field_bowling_style[0]['value']; ?></span>
              </dd>
          </dl>
    <?php endforeach ?>      
    </div>
</div>


