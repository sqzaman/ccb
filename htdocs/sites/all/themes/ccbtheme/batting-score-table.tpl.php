<table cellspacing="0" cellpadding="0" border="0" class="batting_scores">
    <tbody>
        <tr>
            <th align="left" colspan="2">
                <?php echo $batting_card->title ?>
            </th>
            <th width="11%">Runs</th>
            <th width="11%">Balls</th>
            <th width="6%">4s</th>
            <th width="6%">6s</th>
            <th width="7%">SR</th>
        </tr>

    <?php $extra_runs = intval($batting_card->field_bating_extra_run[0]['value']); ?>
    <?php $total_runs = $extra_runs ?>
    <?php $player_list = array() ?>
        
    <?php foreach($batting_card as $field_name => $value): ?>
        <?php $matched_player_info = array() ?>
        <?php preg_match('/^field_bating_([4s|6s|a-z|A-Z|_]+)([0-9]+)/', $field_name, $matched_player_info) ?>
        <?php if(is_array($matched_player_info) && count($matched_player_info)): ?>
            <?php if(!isset($player_list[$matched_player_info[2]])) $player_list[$matched_player_info[2]] = array(); ?>

            <?php $value = (is_array($value) && count($value)) ? $value[0] : $value; ?>
            <?php $value = (is_array($value) && count($value)) ? array_shift($value) : $value; ?>

            <?php $player_list[$matched_player_info[2]][$matched_player_info[1]] = (is_array($value) && count($value)) ? $value[0] : $value; ?>
            <?php if($matched_player_info[1] == 'run') $total_runs += $value ?>
        <?php endif ?>
    <?php endforeach ?>

    <?php $player_list_did_not_bat = array() ?>

    <?php foreach($player_list as $player): ?>
        <?php if(empty($player['player'])) continue; ?>

        <?php $dismissal = theme('dismissal', $player['dismissed'], $player['dismissed_by'], $player['bowled_by']) ?>
        <?php $player_name = theme('player_name', $player['player'], true) ?>

        <?php if($dismissal == 'did not bat'): ?>
            <?php $player_list_did_not_bat[] = $player_name ?>
            <?php continue; ?>
        <?php endif ?>
        
        <tr>
            <td align="left" width="30%"><?php echo $player_name ?></td>
            <td align="left" width="29%"><?php echo $dismissal ?></td>
            <td><b><?php echo intval($player['run']) ?></b></td>
            <td><?php echo intval($player['balls']) ?></td>
            <td><?php echo intval($player['4s']) ?></td>
            <td><?php echo intval($player['6s']) ?></td>
            <td><?php echo (intval($player['run']) && intval($player['balls'])) ? intval((intval($player['run']) * 100 / intval($player['balls']))) : 0 ?></td>
        </tr>
    <?php endforeach ?>

  <tr>
    <td align="left" width="30%">Extras</td>
    <td align="left" width="29%">&nbsp;</td>
    <td><b><?php echo $extra_runs ?></b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="30%"><b>Total</b></td>
    <td align="left" width="29%"></td>
    <td style="text-decoration:overline;"><b><?php echo $total_runs ?></b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</tbody></table>

<?php if(count($player_list_did_not_bat)): ?>
    <div class="did_not">
        <b>Did not bat:</b>
        <?php echo implode(', ', $player_list_did_not_bat) ?>
    </div>
<?php endif ?>