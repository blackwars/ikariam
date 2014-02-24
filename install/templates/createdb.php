<?php
if(isset($_GET['e']) && $_GET['e'] == 1) {
?>
<span style="color:#CC0000; font-size:20px; font-weight:bold">فشل تحديث قاعدة البيانات, تأكد من إنشاء قاعدة بيانات فارغة بالإسم <?php echo $_GET['db'];?></span><br>
<?php }?>
<form action="do.php" method="post" id="dataform">
<table><tr>
<td><span>إنشاء قاعدة البيانات:</span></td></tr>
</table>
<input type="submit" name="Submit" class="button" id="Submit" value="Submit">
<input type="hidden" name="createdb" value="1">
</form>