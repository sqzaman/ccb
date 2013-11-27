<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>

<script type="text/javascript" language="javascript" src="/sites/all/themes/ccbtheme/jquery.dataTables.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/jquery.table.css" />
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/ccbtheme/jquery.ui.css" />
<style type="text/css">
    #batting-tabs{
        margin-bottom: 50px;
}
.ui-corner-tr  {
-moz-border-radius-topright:0px;
}

.ui-corner-tl {
-moz-border-radius-topleft:0px;
}

.ui-corner-br  {
-moz-border-radius-bottomright:0px;
}

.ui-corner-bl {
-moz-border-radius-bottomleft:0px;
}
.ui-tabs .ui-tabs-panel {
    padding: 0px;
}
</style>
<script type="text/javascript">
    $(function() {
        $("#batting-tabs").tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
        $("#bowlling-tabs").tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });

        	$('#tab-first-class-batting, #tab-odi-batting').dataTable( {
		"aaSorting": [[4,'desc']],
		"bJQueryUI": true,
                "iDisplayLength": 50,
		"sPaginationType": "full_numbers"
	} );


        $('#tab-first-class-bowlling, #tab-odi-bowlling').dataTable( {
		"aaSorting": [[5,'desc']],
		"bJQueryUI": true,
                "iDisplayLength": 50,
		"sPaginationType": "full_numbers"
	} );


    });
</script>

<div id="batting-tabs">
    <div style="float: right; line-height: 40px; margin-right: 20px;">
        <label>Season: </label>
        <select id="season" style="border-radius: 0;" onChange='window.location="<?php global $base_url; echo $base_url ?>/ccb/statistics/" + this.value;'>
            <option value="all" <?php if (arg(2) == "all"): ?> selected="selected" <?php endif; ?>>All</option>
            <?php while( $season = db_fetch_object($data->seasons)): ?>
                <option value="<?php echo $season->nid; ?>" <?php if (arg(2) == $season->nid): ?> selected="selected" <?php endif; ?>><?php echo $season->title; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <h3 class="h3_01" style=" height: 40px;ine-height: 40px;">Batting Statistics</h3>
    <ul>
        <li><a href="#tabs-1">T20</a></li>
    </ul>
    <div id="tabs-1" class="upcoming_info">
        
        <table class="most_runs" cellpadding="0" cellspacing="0" id="tab-first-class-batting">
            <thead>
                <tr>
                    <th width="25%">Player</th>
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
                <?php $i = 0;
                foreach ($data->bating_statistics_t20 as $row): ?>
                    <tr <?php if($i%2==0):?> class="bgclr_01" <?php endif; ?>>
                        <td><a href="<?php echo base_path(). 'player/'. $row['nid']. '/statistics';?>"><?php echo $row['name']; ?></a> <?php echo "[". $row['team_name'] . "]";?></td>
                        <td><?php  echo $row['mat'];?></td>
                        <td><?php  echo $row['inns']; ?></td>
                        <td><?php echo $row['not_out'];?></td>
                        <td><?php echo $row['runs'];?></td>
                        <td><?php echo $row['highest_scores'];?></td>
                       <td><?php echo $row['ave'];?></td>
                        <td><?php echo $row['balls_faced'];?></td>
                        <td><?php echo $row['strike_rate'];?></td>
                       <td><?php echo $row['hundreads'];?></td>
                       <td><?php echo $row['fifties'];?></td>
                       <td><?php echo $row['fours'];?></td>
                       <td><?php echo $row['sixes'];?></td>

                    </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
 

</div>


<div id="bowlling-tabs">
    <h3 class="h3_01">Bowling Statistics</h3>
    <ul>
        <li><a href="#tabs-bowlling-1">T20</a></li>
    </ul>
    <div id="tabs-bowlling-1" class="upcoming_info">
        <div class="upcoming_info">
        	<!--<h3 class="h3_01">Most Runs</h3>-->
        	<table class="most_runs" cellpadding="0" cellspacing="0" id="tab-first-class-bowlling">
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
                <?php foreach ($data->bowlling_statistics_t20 as $key => $value): ?>
                    <?php if(!$value['overs']) continue;  ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif;$count++; ?>>

                    <td><a href="<?php echo CCB_Helper::getPlayerUrl($value['nid']);?>"><?php if($value['name']){print $value['name'];} ?></a> <?php echo "[". $value['team_name'] . "]";?></td>
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

    </div>

</div>