<?php
if(isset($_GET['e']) && $_GET['e'] == 1) {
?>
<span style="color:#CC0000; font-size:20px; font-weight:bold">حدث خطأ أثناء إنشاء الملف Config.php</span><br>
<?php }?>
<form action="do.php" method="post" id="dataform">
<table align="center">
<tr>
<td><span>SERVER:</span></td><td><input name="sserver" type="text" id="sserver" value="localhost"></td></tr>
<tr>
<td><span>USER:</span></td><td><input name="suser" type="text" id="suser" value="root"></td></tr><tr>
<td><span>PASS:</span></td><td><input type="text" name="spass" id="spass"></td></tr><tr>
<td><span>DB:</span></td><td><input type="text" name="sdb" id="sdb" value="ikariam"></td></tr><tr>
<td><span>PREFIX:</span></td><td><input type="text" name="prefix" id="prefix" value="db_"></td>
</table>
<input type="submit" class="button" name="Submit" id="Submit" value="Submit">
<input type="hidden" name="config" value="1">
</form>