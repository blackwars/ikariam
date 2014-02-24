<?php 
include("core/CAccount.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />               
<meta name="language" content="de">
<meta name="author" content="prince 3">
<meta name="publisher" content="prince 3">
<meta name="copyright" content="prince 3">
<meta name="page-type" content="لعبة متصفح ، العاب المتصفح">
<meta name="page-topic" content="لعبة متصفح ، لعبة استراتيجية ، لعبة على الانترنت ، لعبة اونلاين">
<meta name="audience" content="all">
<meta name="Expires" content="never">
<meta name="Keywords" content="ikariama, لعبة استراتيجية , العب مجانا , لعبة على الاننرنت , لعبة حربية , ار بي جي, لعبة متصفح , لعبة على الشبكة, لعب">
<meta name="Description" content="ikariama لعبة متصفح مجانية. يتمثل التحدي للاعب في قيادة شعبه من خلال العالم القديم. لبناء المدن والتجارة والانتصار على الجزر.">  
<meta name="robots" content="index,follow">
<meta name="Revisit" content="After 14 days"> 
<title>ikariama - لعبة المتصفح المجانية</title>
<link href="css/rstyle.css" rel="stylesheet" type="text/css" media="screen">
<script src="common.js" type="text/javascript"></script>
</head>

<body>
<div id="headback">
<div id="headlogo"></div>
<!--Main div-->
<div id="main">
<div>
 <div id="links">
 <a href="index.php" title="الى تسجيل الدخول">تسجيل الدخول</a> 
 <a href="register.php" title="سجل هنا !">سجل هنا</a> 
 <a href="tour_step1.php" title="جولة بسيطة على ikariama">جولة في اللعبة</a> 
 <a href="board.php" target="_blank" title="الى المنتديات">المنتدى</a> </div>
</div>
<div id="text">
 <img class="bild1" src="img/bild1.jpg" height="85" width="173">
 <img class="bild2" src="img/bild2.jpg" height="85" width="173">
 <br><br>
 <form id="RegisterForm" name="RegisterForm" action="register.php" method="post"> 
 <table id="logindata" cellpadding="0" cellspacing="0">
 <tbody>
 <tr>
 <td><label for="welt" class="labelwelt">عَالَم</label></td>
 <td>
 <select id="universe" class="uni" size="1">
 <option selected="selected" value="#">Alpha</option>
 <option value="#">Beta</option>
 </select> </td>
 </tr>
 <tr>
 <td><label for="login" class="labellogin">اسم الاعب</label></td>
 <td><input id="login" name="name" class="login" type="text" value="<?php echo $form->getValue('name'); ?>"><span class="error"><?php echo $form->getError('name'); ?></span></td>
 </tr>
 <tr>
 <td><label for="pwd" class="labelpwd">كلمة السر</label></td>
 <td><input id="pwd" name="pw" class="pass" type="password"><span class="error"><?php echo $form->getError('pw'); ?></span></td>
 </tr>
 <tr>
 <td><label for="pwd" class="labelpwd">البريد الإلكتروني</label></td>
 <td><input id="email" name="email" class="login" type="text" value="<?php echo $form->getValue('email'); ?>" maxlength="40" />
<span class="error"><?php echo $form->getError('email'); ?></span> </td>
 </tr>
 </tbody>
 </table>
 <INPUT type="checkbox" name="agb">‫أقبل <A style="color:rgb(223, 88, 67);" target="_blank" href="index.php?lang=ae">شروط الاستخدام</A> و <A style="color:rgb(223, 88, 67);" target="_blank" href="index.php?lang=ae">بيان الخصوصية</A>.
 <span class="error">
 <?php echo $form->getError('agree');?> </span>
 <br><br>
 <input class="button" value="تسجيل" name="loginMode" type="submit"><br><br>
 <input name="ft" type="hidden" value="a1" />
 </form>
</div><br/>
</div>
<!--Main div ends-->
<div id="footer"></div>
</div>
</body>
</html>