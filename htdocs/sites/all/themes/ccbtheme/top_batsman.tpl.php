<h3>Top 5 Batsman</h3>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th>Rank</th>
        <th>Batsman</th>
        <th>Runs</th>
    </tr>
    <?php if (isset($data) && count($data) > 0): ?>
    <?php for($i = 0; $i < 5; $i++): ?>
    <tr <?php if($i % 2 == 0):?> class="bgclr_01" <?php endif; ?>>
        <td><?php echo $i + 1; ?></td>
        <td><a href=<?php echo CCB_Helper::getPlayerUrl($data[$i]['nid']);?>><?php echo $data[$i]['name']?></a> [<?php echo $data[$i]['team_name'] ?>]</td>
        <td><?php echo $data[$i]['runs']?></td>
    </tr>
    <?php endfor; ?>
    <?php else: ?>
     <tr><td colspan=4>No records available</td></tr>
    <?php endif; ?>
</table>
<span class="more_link"><a href="<?php echo base_path(). 'ccb/statistics'?>">more</a></span>

