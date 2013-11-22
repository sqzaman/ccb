<style type="text/css">
   #node-form label{
display:none;
}
</style>


Title:
<?php print drupal_render($form['title']); ?>
Match:
<?php print drupal_render($form['field_bowling_match']); ?>
Team:
<?php print drupal_render($form['field_bowling_team']); ?>

<table width="100%" border="1">
<tr>
<td>Bowler</td>
<td>Over(s)</td>
<td>Run(s)</td>
<td>Wicket(s)</td>
<td>No Ball(s)</td>
<td>Wide</td>

</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player1']); ?></td>
<td><?php print drupal_render($form['field_bowling_over1']); ?></td>
<td><?php print drupal_render($form['field_bowling_run1']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts1']); ?></td>
<td><?php print drupal_render($form['field_bowling_no1']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide1']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player2']); ?></td>
<td><?php print drupal_render($form['field_bowling_over2']); ?></td>
<td><?php print drupal_render($form['field_bowling_run2']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts2']); ?></td>
<td><?php print drupal_render($form['field_bowling_no2']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide2']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player3']); ?></td>
<td><?php print drupal_render($form['field_bowling_over3']); ?></td>
<td><?php print drupal_render($form['field_bowling_run3']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts3']); ?></td>
<td><?php print drupal_render($form['field_bowling_no3']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide3']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player4']); ?></td>
<td><?php print drupal_render($form['field_bowling_over4']); ?></td>
<td><?php print drupal_render($form['field_bowling_run4']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts4']); ?></td>
<td><?php print drupal_render($form['field_bowling_no4']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide4']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player5']); ?></td>
<td><?php print drupal_render($form['field_bowling_over5']); ?></td>
<td><?php print drupal_render($form['field_bowling_run5']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts5']); ?></td>
<td><?php print drupal_render($form['field_bowling_no5']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide5']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player6']); ?></td>
<td><?php print drupal_render($form['field_bowling_over6']); ?></td>
<td><?php print drupal_render($form['field_bowling_run6']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts6']); ?></td>
<td><?php print drupal_render($form['field_bowling_no6']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide6']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player7']); ?></td>
<td><?php print drupal_render($form['field_bowling_over7']); ?></td>
<td><?php print drupal_render($form['field_bowling_run7']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts7']); ?></td>
<td><?php print drupal_render($form['field_bowling_no7']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide7']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player8']); ?></td>
<td><?php print drupal_render($form['field_bowling_over8']); ?></td>
<td><?php print drupal_render($form['field_bowling_run8']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts8']); ?></td>
<td><?php print drupal_render($form['field_bowling_no8']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide8']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player9']); ?></td>
<td><?php print drupal_render($form['field_bowling_over9']); ?></td>
<td><?php print drupal_render($form['field_bowling_run9']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts9']); ?></td>
<td><?php print drupal_render($form['field_bowling_no9']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide9']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player10']); ?></td>
<td><?php print drupal_render($form['field_bowling_over10']); ?></td>
<td><?php print drupal_render($form['field_bowling_run10']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts10']); ?></td>
<td><?php print drupal_render($form['field_bowling_no10']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide10']); ?></td>
</tr>
<tr>
<td><?php print drupal_render($form['field_bowling_player11']); ?></td>
<td><?php print drupal_render($form['field_bowling_over11']); ?></td>
<td><?php print drupal_render($form['field_bowling_run11']); ?></td>
<td><?php print drupal_render($form['field_bowling_wkts11']); ?></td>
<td><?php print drupal_render($form['field_bowling_no11']); ?></td>
<td><?php print drupal_render($form['field_bowling_wide11']); ?></td>
</tr>

</table>

<?php print drupal_render($form); ?>
