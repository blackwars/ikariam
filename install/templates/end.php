<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
copy("inc/Config.php","../core/Config.php");
unlink("inc/Config.php");
$rand = md5(rand(1,10));
rename("index.php","$rand");
?>
<div class="headline"><span>تم تثبيت إيكارياما على جهازك...</span></div>
<span>يستحسن أن تقوم بحذف مجلد التثبيت install.</span>
<form action="../" method="get">
<input value="Play" type="submit" class="button" value="Submit">
</form>
