<?php  $total = count($rows); ?>
<div >
        	<h3 >Upcoming Matches </h3>
        	<table border="0" cellpadding="0" cellspacing="0">
                <tr>	 	 	
                    <th width="5%">#</th>
                    <th width="29%">Date &amp; Time</th>
                    <th width="47%">Match</th>
                    <th width="19%">Venue</th>
                </tr>
                <?php foreach ($rows as $count => $row): ?>
                <?php if($total == 1):?><tr><td colspan=4>No upcoming match available</td></tr><?php endif; ?>
                <?php if($row['title'] != 'Blank Match'):?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	
                    <td><?php print  $count+1; ?></td>
                    <td><?php print  $row['field_match_date_value'] ; ?></td>
                    <td><?php print  $row['field_match_team1_nid'] ; ?> vs <?php print  $row['field_match_team2_nid'] ; ?></td>
                    <td><?php print  $row['field_match_venue_value'] ; ?></td>
                </tr>
                <?php endif; ?>
                <?php endforeach ?>
        	</table>         
        	<span class="more_link"><a href="match_info">more</a></span>    
</div>        	


