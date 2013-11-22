<script type="text/javascript" language="javascript" src="/sites/all/themes/ccbtheme/jquery.js"></script>

		<script type="text/javascript" language="javascript" src="/sites/all/themes/ccbtheme/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function() {
	$('#test').dataTable( {
		"aaSorting": [[4,'desc']],
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	} );
} );
		</script>
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/jquery.table.css" />		
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/jquery.ui.css" />

   <?php 
      echo "<pre>";
      //print_r($rows);
      echo "</pre>";
      foreach ($rows as $count => $row){
         if($row['type'] == 'Players')
           $players[] = $row['title'];
      }


      foreach ($players as $player_count => $player){

         foreach ($rows as $count => $row){


            if($row['type'] == 'Bating Scorecard'){
               $index = array_search($player,$row);

               
               if($index){
                  $exploded_index = explode("_",$index);

                  
                  $index_counter =  substr($exploded_index[2],6);

                  $match[$player_count]++;
                  $innings[$player_count]++;
                  

                  $run_index = "field_bating_run".$index_counter."_value";
                  $run[$player_count] = $run[$player_count] + $row[$run_index];

                  if( $row[$run_index] > $high_score[$player_count])
                  {
                     $high_score[$player_count] = $row[$run_index];
                  }
                  if($row[$run_index] >= 50)
                  {
                     $run_50s[$player_count]++;
                  }
                  if($row[$run_index] >= 100)
                  {
                     $run_100s[$player_count]++;
                  }

                  $bf_index = "field_bating_balls".$index_counter."_value";
                  $balls_faced[$player_count] = $balls_faced[$player_count] + $row[$bf_index];
                  
                  $run_4s_index = "field_bating_4s".$index_counter."_value";
                  $run_4s[$player_count] = $run_4s[$player_count] + $row[$run_4s_index];

                  $run_6s_index = "field_bating_6s".$index_counter."_value";
                  $run_6s[$player_count] = $run_6s[$player_count] + $row[$run_6s_index];

                  $not_out_index = "field_bating_dismissed".$index_counter."_nid";
                  if($row[$not_out_index] == 'Not Out')
                  {
                     $not_out[$player_count]++;
                  }
                  
                  if($row[$not_out_index] == 'Not Batted')
                  {
                     $innings[$player_count]--;
                  }

                  
                  
               }

            }

         }
      }
    
   ?>
   


<div class="upcoming_info">
        	<!--<h3 class="h3_01">Most Runs</h3>-->
        	<table class="most_runs" cellpadding="0" cellspacing="0" id="test">
        	<thead>
                <tr>	 	 	
                   <th width="19%">Player</th>
                   <th width="6%">Mat</th>
                   <th width="5%">Inns</th>
                   <th width="5%">NO</th>
                   <th width="8%">Runs</th>
                   <th width="7%">HS</th>
                   <th width="9%">Ave</th>
                   <th width="8%">BF</th>
                   <th width="9%">SR</th>
                   <th width="7%">100</th>
                   <th width="6%">50</th>
                   <th width="6%">4s</th>
                   <th width="5%">6s</th>
                </tr>
         </thead>
         <tbody>
                <?php foreach ($players as $count => $player): ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	

                    <td><?php print $players[$count]; ?></td>
                    <td><?php print $match[$count];?></td>
                    <td><?php print $innings[$count];?></td>
                    <td><?php print $not_out[$count];?></td>
                    <td><?php print $run[$count];?></td>
                    <td><?php print $high_score[$count];?></td>
                    <td>
                    <?php 
                    if($run[$count])
                    {
                    
                       $divider = $innings[$count] - $not_out[$count];
                       if($divider < 1)
                       $divider = 1;
                    
                       $average_run = $run[$count] / $divider ;
                       print number_format($average_run,2,'.','');
                    } 
                    ?>
                    </td>
                    <td><?php print $balls_faced[$count];?></td>
                    <td>
                    <?php 
                       if($run[$count])
                       {
                          $strike_rate = (($run[$count]/$balls_faced[$count])*100);print number_format($strike_rate,2,'.','');
                       }
                    ?>
                    </td> 
                    <td><?php print $run_100s[$count]; ?></td> 
                    <td><?php print $run_50s[$count]; ?></td>
                    <td><?php if($run_4s[$count]){print $run_4s[$count];} ?></td>                      
                    <td><?php if($run_6s[$count]){print $run_6s[$count];} ?></td>  
                </tr>
                <?php endforeach ?>
                
                </tbody>
        	</table>         
</div>        	


