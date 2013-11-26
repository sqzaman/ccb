		
<!--<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/demo_table.css" />-->

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
                  $index_counter =  substr($index, -5, 1);        

                  $run_index = "field_bating_run".$index_counter."_value";
                  $run[$player_count] = $run[$player_count] + $row[$run_index];

                  
                  
               }

            }

         }
      }
      arsort($run);
      $run_keys = array_keys($run);

   ?>
   


<div >
        	<h3 >Top 5 Batsman</h3>
        	<table  cellpadding="0" cellspacing="0" border="0">
        	<thead>
                <tr>	 	 	
                   <th >Rank</th>
                   <th >Player</th>
                   <th >Runs</th>
                </tr>
         </thead>
         <tbody>
                <?php for($count=0; $count < 5; $count++): ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	
                    <td><?php print $count+1; ?></td>
                    <td><?php print $players[$run_keys[$count]]; ?></td>
                    <td><?php print $run[$run_keys[$count]];?></td>
                </tr>
                <?php endfor; ?>
                
                </tbody>
        	</table>         
        	<span class="more_link"><a href="statistics">more</a></span>   
</div>        	


