<?php
// Do Not Edit Below. //
if($page == '' || !ctype_digit($page)){ $page='1';}
$stcom = ($page - 1) * $perpage;
$num_sel=mysql_query($sqlq);
$num=mysql_num_rows($num_sel);
if($stcom >$num){ header("Location: $namep?page=1");}
$z = $num / $perpage;
$pg_n=(int)$z;
	if($pg_n<>$z){
	$pg_n++;
	}
if($pg_n=='0'){$pg_n='1';}
$prev=$page-1;
$nex=$page+1;

if($page=='1'){$ps="<span class='disabled_tnt_pagination'>&laquo; Prev</span>";}
else{$ps="<a href='$namep?page=$prev$q_string' title='previous'>&laquo; Prev</a>";}
if($page==$pg_n){$nx="<span class='disabled_tnt_pagination'>Next &raquo;</span>";}
else{$nx="<a href='$namep?page=$nex$q_string' title='next'>Next &raquo;</a>";}

$k='1';	$l='0';

while($k<=$pg_n){
	if($k==$page){$pgs[$l]="<span class='active_tnt_link'>$k</span>";}
	else{$pgs[$l]="<a href='$namep?page=$k$q_string'>$k</a>";}
	$k++;	$l++;
}
?>