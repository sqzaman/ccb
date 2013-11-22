<?php $player_list = array() ?>

<?php foreach($bowling_card as $field_name => $value): ?>
    <?php $matched_player_info = array() ?>
    <?php preg_match('/^field_bowling_([a-z|A-Z]+)([0-9]+)/', $field_name, $matched_player_info) ?>
    <?php if(is_array($matched_player_info) && count($matched_player_info)): ?>
        <?php if(!isset($player_list[$matched_player_info[2]])) $player_list[$matched_player_info[2]] = array(); ?>

        <?php $value = (is_array($value) && count($value)) ? $value[0] : $value; ?>
        <?php $value = (is_array($value) && count($value)) ? array_shift($value) : $value; ?>

        <?php $player_list[$matched_player_info[2]][$matched_player_info[1]] = (is_array($value) && count($value)) ? $value[0] : $value; ?>
    <?php endif ?>
<?php endforeach ?>

<?php ksort($player_list); ?>

<table cellspacing="0" cellpadding="0" border="0" class="bowling_scores">
    <tbody>
    <tr>
        <th width="31%"><?php echo $bowling_card->title ?></th>
        <th width="9%">Over</th>
        <th width="9%">Run</th>
        <th width="9%">Wicket</th>
        <th width="9%">No</th>
        <th width="9%">Wide</th>
        <th width="14%">Econ</th>
    </tr>

    <?php foreach($player_list as $player): ?>
        <?php if(empty($player['player'])) continue; ?>
        <tr>
            <td><?php echo theme('player_name', $player['player'], true) ?></td>
            <td><?php echo $player['over'] ?></td>
            <td><?php echo $player['run'] ?></td>
            <td><?php echo $player['wkts'] ?></td>
            <td><?php echo $player['no'] ?></td>
            <td><?php echo $player['wide'] ?></td>
            <td>
                <?php if(intval($player['run']) && intval($player['run']) > 0 && floatval($player['over']) && floatval($player['over']) > 0): ?>
                    <?php $overs = floor($player['over']) ?>
                    <?php $balls = ($overs * 6) + ($player['over'] - $overs) * 10 ?>
                    <?php $economy = ($player['run'] / $balls) * 6 ?>
                    <?php echo number_format($economy, 2) ?>
                <?php else: ?>
                    0
                <?php endif ?>
            </tr>
    <?php endforeach ?>
    </tbody>
</table>