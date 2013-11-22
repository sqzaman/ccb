	<script type="text/javascript" charset="utf-8">
			$(document).ready( function() {
	$('#test2').dataTable( {
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	} );
} );
		</script>

<div class="upcoming_info">
<!--        	<h3 class="h3_01">Recent Match Results</h3> -->
        	<table  cellpadding="0" cellspacing="0" id="test2">
        	       <thead>        	
                <tr>	 	 	
                    <th width="5%">#</th>
                    <th width="29%">Date &amp; Time</th>
                    <th width="35%">Match</th>
                    <th width="15%">Scores</th>
                    <th width="15%">Reports</th>                    
                </tr>
        	       </thead>  
                <tbody>        	                     
                <?php foreach ($rows as $count => $row): ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	
                    <td><?php print  $count+1; ?></td>
                    <td><?php print  $row['field_match_date_value'] ; ?></td>
                    <td><?php print  $row['field_match_team1_nid'] ; ?> vs <?php print  $row['field_match_team2_nid'] ; ?></td>
                    <td class="view_link"><a href="<?php print  $row['path'] ; ?>/score">Details</a></td>
                    <td class="view_link"><a href="reports/<?php print  $row['nid'] ; ?>">Reports</a></td>                    
                </tr>
                <?php endforeach ?>
                </tbody>                
        	</table>         
</div>        	


