<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>

<h3>Upcoming Matches</h3>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th width="5%">#</th>
        <th width="29%">Date &amp; Time</th>
        <th width="35%">Match</th>
        <th width="23%">Venue</th>
    </tr>
   <?php 
   $data; 
   $cnt = 1;
    $c = true;

   foreach($data as $row):   
   ?>
    <tr class="bgclr_01 <?php echo ($c = !$c)? 'odd' : 'even' ?>">
        <td><?php echo $cnt++?></td>
        <td><?php echo date('d-m-Y H:i', strtotime($row->field_date[0]['value']))?></td>
        <td><?php echo theme('node_title', $row->field_team_1[0]['nid'], false, true)?> vs <?php echo theme('node_title', $row->field_team_2[0]['nid'], false, true)?></td>
        <td><?php echo theme('node_title', $row->field_venue[0]['nid'], false, true)?></td>
    </tr>
    <?php endforeach; ?>
</table>
<!--<span class="more_link"><a href="match_info.html">more</a></span>-->
