<script type="text/javascript" charset="utf-8">
   $(document).ready( function() {
      $('#test2').dataTable( {
         "aaSorting": [[5,'desc']],
         "bJQueryUI": true,
         "sPaginationType": "full_numbers"
      } );
   } );
</script>

<?php
//include_once('ccbmodule.model.php');
    $objModel = new CCB_Model();
    $statistics = $objModel->allPlayerBowlingRecord(FIRST_CLASS_MATCH);

?>

<div class="upcoming_info">
        	<!--<h3 class="h3_01">Most Runs</h3>-->
        	<table class="most_runs" cellpadding="0" cellspacing="0" id="test2">
        	<thead>
                <tr>	 	 	
                   <th width="19%">Player</th>
                   <th width="6%">Mat</th>
                   <th width="5%">Inns</th>                
                   <th width="5%">Overs</th>
                   <th width="8%">Runs</th>
                   <th width="7%">Wkts</th>
                   <th width="7%">No</th>
                   <th width="7%">Wide</th>
                   <th width="9%">Avg</th>
                   <th width="7%">Econ</th>
                   <th width="6%">SR</th>
                   <th width="6%">4W</th>
                   <th width="5%">5W</th>
                </tr>
         </thead>
         <tbody>
                <?php foreach ($statistics as $key => $value): ?>
                    <?php if(!$value['overs']) continue;  ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif;$count++; ?>>	 	 	

                    <td><?php if($value['name']){print $value['name'];} ?></td>
                    <td><?php if($value['mat']){print $value['mat'];}?></td>
                    <td><?php if($value['inns']){print $value['inns'];}?></td>
                    <td><?php if($value['overs']){print $value['overs'];}?></td>
                    <td><?php if($value['runs']){print $value['runs'];}?></td>
                    <td><?php if($value['wkts']){print $value['wkts'];}?></td>
                    <td><?php if($value['no']){print $value['no'];}?></td>
                    <td><?php if($value['wide']){print $value['wide'];}?></td>
                    <td><?php if($value['ave']){print $value['ave'];}?></td>
                    <td><?php if($value['econ']){print $value['econ'];}?></td>
                    <td><?php if($value['sr']){print $value['sr'];}?></td>
                    <td><?php if($value['4w']){print $value['4w'];}?></td>
                    <td><?php if($value['5w']){print $value['5w'];}?></td>                    
                </tr>
                <?php endforeach ?>
                
                </tbody>
        	</table>         
</div>        	


