<script type="text/javascript" language="javascript" src="/sites/all/themes/ccbtheme/jquery.js"></script>

		<script type="text/javascript" language="javascript" src="/sites/all/themes/ccbtheme/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function() {
	$('#test').dataTable( {
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	} );
} );
		</script>
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/jquery.table.css" />		
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/jquery.ui.css" />

<?php  $total = count($rows); ?>
<div class="upcoming_info">
        	<!--<h3 class="h3_01">Upcoming Matches </h3>-->
        	<table cellpadding="0" cellspacing="0" id="test">
        	       <thead>
                <tr>	 	 	
                    <th width="5%">#</th>
                    <th width="29%">Date &amp; Time</th>
                    <th width="35%">Match</th>
                    <th width="31%">Venue</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $count => $row): ?>
                <?php if($total == 1):?><tr><td colspan=4>No upcoming match available</td></tr><?php endif; ?>
                <?php if($row['title'] != 'Blank Match'):?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	
                    <td><?php print  $count; ?></td>
                    <td><?php print  $row['field_match_date_value'] ; ?></td>
                    <td><?php print  $row['field_match_team1_nid'] ; ?> vs <?php print  $row['field_match_team2_nid'] ; ?></td>
                    <td><?php print  $row['field_match_venue_value'] ; ?></td>
                </tr>
                <?php endif; ?>
                <?php endforeach ?>
                </tbody>
        	</table>         
</div>        	


