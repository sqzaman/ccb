<style type="text/css">
p
{
   padding-top:10px;
}
</style>
<div >
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>	 	 	
                    <th >&nbsp;</th>
                </tr>
                <?php foreach ($rows as $count => $row): ?>
                <tr <?php if($count%2==0):?> class="bgclr_01" <?php endif; ?>>	 	 	
                    <td><div style="padding-right:20px;"><?php print  decode_entities($row['field_match_report_value']) ; ?></div></td>
                </tr>
                <?php endforeach ?>
        	</table>     
</div>        	

