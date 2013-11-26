<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>

<h3>News</h3>
<marquee truespeed="truespeed" scrolldelay="30" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();" direction="left" behavior="scroll" align="top">
    <?php while( $dat = db_fetch_object($data)): ?>
    <a href="<?php echo base_path() . "node/".$dat->nid;?>">* <?php echo $dat->title; ?></a>
    <?php endwhile; ?>

</marquee>
