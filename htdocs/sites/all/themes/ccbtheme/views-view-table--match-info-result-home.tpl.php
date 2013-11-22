<div >
        	<h3 >Recent Match Results</h3>
        	<table border="0" cellpadding="0" cellspacing="0">
                <tr>	 	 	
                    <th width="5%">#</th>
                    <th width="29%">Date &amp; Time</th>
                    <th width="47%">Match</th>
                    <th width="19%">Scores</th>
                </tr>
                <?php foreach ($rows as $count => $row): ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	
                    <td><?php print  $count+1; ?></td>
                    <td><?php print  $row['field_match_date_value'] ; ?></td>
                    <td><?php print  $row['field_match_team1_nid'] ; ?> vs <?php print  $row['field_match_team2_nid'] ; ?></td>
                    <td class="view_link"><a href="<?php print  $row['path'] ; ?>/score">Details</a></td>
                </tr>
                <?php endforeach ?>
        	</table>     
        	<span class="more_link"><a href="match_info">more</a></span>    
</div>        	


