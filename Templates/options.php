<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/options.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("js/js1.php");?>
</head>
<body id="options" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <span class="textLabel">إعدادات</span>
   </div>
   <div class="dynamic" id="reportInboxLeft">
    <h3 class="header">دعوة الأصدقاء</h3>
    <div class="content">
     <img width="167" height="110" src="img/options/invitefriends.jpg"/>
     <p>هل ترغب في دعوة أصدقائك للعب Ikariam؟ هل ترغب في أن تكون مستوطناتهم قريبة من مستوطناتك؟ انقر هنا للحصول على رابط يمكنك إرساله لأصدقائك.</p>
     <div class="centerButton">
      <a href="?view=optionsInviteFriends" class="button">دعوة الأصدقاء</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>إعدادات</h1>
     <p>هنا يمكنك أن تغيير اسم المستخدم، كلمة السر وعنوان البريد الإلكتروني الخاص بك. ليكن بعلمك أنه يمكنك تغيير عنوان البريد الإلكتروني مرة واحدة في الأسبوع وأنه لا يسمح في اسم المستخدم وكلمة السر باستخدام رموز خاصة، بل فقط الأرقام والأحرف ورمز المساحة أو الفراغ بين الأحرف.</p>
    </div>
    <div class="contentBox01h">
     <h3 class="header">
     <span class="textLabel">إعدادات</span></h3>
     <div class="content">
      <form  action="action.php" method="POST">
       <input type="hidden" name="action" value="Options">
       <input type="hidden" name="function" value="changeAvatarValues">
       <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
       <div id="options_userData">
        <table cellpadding="0" cellspacing="0">
         <tr>
         <th>تغيير اسم اللاعب</th>
         <td><input class="textfield" type="text" name="name" size="15" value="<?php echo $session->username;?>"></td>
         </tr>
        </table>
       </div>
       <div id="options_changePass">
        <h3>تغيير الكلمة السرية</h3>
        <table cellpadding="0" cellspacing="0">
         <tr><th>كلمة السر القديمة</th>
         <td><input type="password" class="textfield" name="oldPassword" size="20"/></td>
         </tr>
         <tr><th>كلمة سرية جديدة</th>
         <td><input type="password" class="textfield" name="newPassword" size="20"/></td>
         </tr>
         <tr><th>تأكيد الكلمة السريّة الجديدة</th>
         <td><input type="password" class="textfield" name="newPasswordConfirm" size="20"/></td>
         </tr>
        </table>
       </div>
       <div>
        <h3>المزيد</h3>
        <table cellpadding="0" cellspacing="0">
         <tr><th>عرض تفاصيل المدينة المُختارة</th>
         <td>
         <select name="citySelectOptions" size="1">
          <option value="0">ليست هناك تفاصيل</option>
          <option value="1" selected="selected">إحداثيات الجزيرة</option>
          <option value="2">بضائع تجارية</option>
         </select>
         </td>
         </tr>
        </table>
       </div>
       <div id="options_debug">
        <h3>Debugdata</h3>
        <table cellpadding="0" cellspacing="0">
         <tr><th>Player-ID:</th>
         <td><?php echo  $session->uid;?></td></tr>
         <tr><th>Current City-ID: </th>
         <td><?php echo $city->cid;?></td></tr>
        </table>
       </div>
       <div class="centerButton">
        <input type="submit" class="button" value="حفظ الإعدادات!">
       </div>
      </form>
     </div>
     <div class="footer"></div>
    </div>
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">تغيير عنوان البريد الإلكتروني</span></h3>
     <div class="content">
      <form  action="action.php" method="POST">
       <input type="hidden" name="action" value="Options">
       <input type="hidden" name="function" value="changeEmail">
       <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
       <table cellpadding="0" cellspacing="0">
        <tr><th>تغيير عنوان البريد الإلكتروني</th>
        <td>
        <input class="textfield" type="text" name="email" size="30" value="<?php echo $session->usermail;?>" /></td></tr>
        <tr>
        <th>تأكيد تغيير عنوان البريد الإلكتروني بإدخال كلمة السر</th>
        <td><input type="password" class="textfield" name="emailPassword" size="20"/></td></tr>
       </table>
       <div class="centerButton">
        <input type="submit" class="button" value="تغيير عنوان البريد الإلكتروني">
       </div>
      </form>
     </div>
     <div class="footer"></div>
    </div>
    <div class="contentBox01h" id="vacationMode">
     <h3 class="header"><span class="textLabel">تشغيل نظام العطلة</span></h3>
     <div class="content">
      <p>يمكنك هنا تفعيل نظام العطلة. بتفعيله تتجنب حذف حسابك وتعرض مدنك إلى الهجوم إذا توقف نشاطك لمدة طويلة. عمالك وباحثوك سيكونون أيضاً في عطلة ولن يشتغلوا. لكي لا تتم إساءة استعمال نظام العطلة، يجب أن يدوم كأقل حد 48 ساعة. لن تتمكن من لعب Ikariam أثنائها. بعد نهاية 48 ساعة يتم إنهاء نظام العطلة بمجرد تسجيل الدخول في اللعبة.</p>
      <p class="warningFont">انتبه! سيتم إرسال الأساطيل والوحدات المقاتلة إلى المدينة، إذا قمت بتفعيل نظام العطلة! كما أن البضائع المشحونة على السفينة ستضيع منك!</p>
      <div class="centerButton">
        <a class="button" href="?view=options_umod_confirm">تفعيل نظام العطلة</a>
      </div>
     </div>
     <div class="footer"></div>
    </div>
    <div class="contentBox01h" id="deletionMode">
     <h3 class="header"><span class="textLabel">حذف اللاعب</span></h3>
      <div class="content">
       <p>إذا كنت لا تريد أن تلعب من جديد، يمكنك هنا طلب حذف حسابك. 
سيتم عندها حذف حسابك بعد مرور سبعة أيام.</p><br />
       <div class="centerButton">
        <a class="button" href="?view=options_deletion_confirm">حذف اللاعب بصفة نهائية!</a>
       </div><br />
      </div>
      <div class="footer"></div>
     </div>
   </div>
<?php include("citynavigator.php");?>
<!-- Page footer  -->
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>