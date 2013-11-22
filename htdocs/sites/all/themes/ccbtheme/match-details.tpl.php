<h3 class="h3_02 has-green-background">Match Details</h3>

<div class="match_details">
    <h3 class="match-title">
        <?php if (!empty($match->field_match_team1[0]['nid'])): ?>
            <?php $team1 = node_load($match->field_match_team1[0]['nid']) ?>
            <?php echo $team1->title ?>
        <?php endif ?>
        <b>V</b>
        <?php if (!empty($match->field_match_team1[0]['nid'])): ?>
            <?php $team2 = node_load($match->field_match_team2[0]['nid']) ?>
            <?php echo $team2->title ?>
        <?php endif ?>
    </h3>

    <b>Match type:</b> <?php echo $match->field_match_type[0]['value'] ?><br>
<b>Match Date:</b> <?php echo date('d-M-Y', strtotime($match->field_match_date[0]['value'])) ?><br>
    <b>Venue:</b> <?php
        $venue_node = node_load($match->field_match_venue[0]['nid']);
        echo $venue_node->title;
        ?><br>

    <?php if (!empty($match->field_match_toss[0]['nid'])): ?>
        <?php $toss_winner = node_load($match->field_match_toss[0]['nid']) ?>
        <b>Toss won by:</b> <?php echo $toss_winner->title ?><br>
    <?php endif ?>

    <?php if (!empty($match->field_match_first_bat[0]['nid'])): ?>
        <?php $bat_first = node_load($match->field_match_first_bat[0]['nid']) ?>
        <b>Batting first:</b> <?php echo $bat_first->title ?><br>
    <?php endif ?>

    <?php if (!empty($match->field_match_umpire[0]['value'])): ?>
        <b>Umpires:</b> <?php echo $match->field_match_umpire[0]['value'] ?>
        <br />
    <?php endif ?>
    
    <?php if (!empty($match->field_match_result[0]['value']) && $match->field_match_status[0]['value'] == 'Complete'): ?>
        <b>Result:</b> <em><?php echo $match->field_match_result[0]['value'] ?></em><br />
    <?php endif ?>
    
    <?php if (isset($match->field_man_of_the_match[0]['nid']) && !empty($match->field_man_of_the_match[0]['nid'])): ?>
        <b>Man of the match:</b> <em>
             <a href="<?php echo "/player/".$match->field_man_of_the_match[0]['nid']. "/statistics"?>"
    <?php 
    
    $player_id = $match->field_man_of_the_match[0]['nid'];
    $player_node = node_load($player_id); 
    //$team_node = node_load($player_node->field_players_club[0]['nid']);
    print theme('node_title', $match->field_man_of_the_match[0]['nid'] , true). "</a> [" . theme('node_title', $player_node->field_players_club[0]['nid'] , false, true) . "]"; 
    ?>
        </em>
<?php endif ?>
</div>