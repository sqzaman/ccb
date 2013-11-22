<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>


<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
    	wrap: 'circular'
    });
});

</script>
<style type="text/css">
    
</style>

<ul id="mycarousel" class="jcarousel-skin-tango">
    <?php foreach($data as $row): ?>
    <li><a href="<?php  echo base_path()."node/". $row->nid;?>"><img src="<?php echo base_path(). $row->field_gallery_images[0]['filepath'];?>" width="205" height="155" alt="image" /></a></li>
    <?php endforeach; ?>
</ul>