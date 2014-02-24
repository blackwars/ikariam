<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<!--<link href="css/island.css" rel="stylesheet" type="text/css" media="screen">-->
<?php include("js/js1.php");?>
</head>
<body id="resource" dir="rtl">
<div id="container">
 <div id="container2">
  <div id="header">
   <h1>إيكارياما ikariam</h1>
   <h2>عش في العصور القديمة!</h2>
  </div>
  <div id="avatarNotes"></div>
  <div id="breadcrumbs">
   <h3>أنت هنا:</h3>
   <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" class="world" title="عودة إلى خارطة العالم">عالم
   </a>
   <span>&nbsp;&gt;&nbsp;</span>
   <a href="?view=island&amp;id=<?php echo $island->iid;?>" class="island" title="عودة إلى الجزيرة"><?php echo $island->name;?>[<?php echo $city->y;?>:<?php echo $city->x;?>]
   </a>
   <span>&nbsp;&gt;&nbsp;</span>
   <span class="building">منشرة</span>
  </div>
<!------dynamic side-boxes.-->
<div id="resUpgrade" class="dynamic">
 <h3 class="header">منشرة
 <a class="help" href="#" title="مساعدة"
 <span class="textLabel">هل تحتاج لمساعدة؟</span>
 </a>
 </h3>
 <div class="content">
  <img src="img/resource/img_wood.jpg" alt="" />
  <div class="buildingLevel">
   <span class="textLabel">مستوى: </span><?php echo $island->woodlevel;?>
  </div>
  <h4>يلزمك من أجل المستوى التالي:</h4>
  <ul class="resources">
  <li class="wood">
   <span class="textLabel">مواد البناء: </span><?php echo $island->woodlevel*1000;?>
  </li>
  </ul>
  <h4>متوفر:</h4>
  <div>
  <ul class="resources">
  <li class="wood">
   <span class="textLabel">مواد البناء: </span><?php echo $island->wooddonations;?>
  </li>
  </ul>
  </div>
  <form id="donateForm" action="action.php"  method="POST">
   <div id="donate">
  <label for="donateWood">تبرع:</label>
  <input type="hidden" name="id" value="<?php echo $island->iid;?>">
  <input type="hidden" name="type" value="resource">
  <input type="hidden" name="action" value="IslandScreen">
  <input type="hidden" name="function" value="donate">
  <input id="donateWood" name="donation" type="text" autocomplete="off" class="textfield" />
  <a href="#setmax" title="تبرُّع بأكبر كمية ممكنة" onClick="Dom.get('donateWood').value=<?php echo $city->awood;?>;">max</a>
  <div class="centerButton">
  <input type="submit" class="button" value="تبرُّع لإكمال إنشاء" />
  </div>
  </div>
  </form>
 </div>
 <div class="footer"></div>
</div>
<!--------------------------->
<!---the main view-->
<div id="mainview">
 <div class="buildingDescription">
  <h1>منشرة</h1>
  <p>في المنشرة يتم تقطيع الخشب من الغابة القريبة إلى ألواح تشكل مادة  بناء أساسية تستخدم في بناء المباني والكثير من الأشياء الأخرى.

يتم إنشاء المنشرة بمشاركة جميع سكان الجزيرة.كلما زاد حجم المنشرة كلما تمكنت من تشغيل عدد أكبر من العمال فيها.</p>
 </div>
 <form id="setWorkers" action="action.php"  method="POST">
  <div id="setWorkersBox" class="contentBox">
  <h3 class="header">
  <span class="textLabel">تعيين عمال</span>
  </h3>
  <div class="content">
   <ul>
  <li class="citizens">
   <span class="textLabel">مواطنون: </span>
   <span class="value" id="valueCitizens">
   <?php echo $city->citizens?>
   </span>
  </li>
  <li class="workers">
   <span class="textLabel">عمّال: </span>
   <span class="value" id="valueWorkers">
   <?php echo $city->woodworkers?>
   </span>
  </li>
  <li class="gain" title="إنتاج العمال:<?php echo $city->woodp?>" alt="إنتاج العمال:<?php echo $city->woodp?>">
   <span class="textLabel">إنجاز الترفيع: </span>
   <div id="gainPoints">
    <div id="resiconcontainer">
    <img id="resicon" src="img/resource/icon_wood.gif" width="25" height="20" />
   </div>
   </div>
   <div class="gainPerHour">
    <span id="valueResource" class="overcharged">+<?php echo $city->woodp?></span>
    <span class="timeUnit">في الساعة</span>
   </div>
  </li>
  <li class="costs">
   <span class="textLabel">مداخيل المدينة: </span>
   <span id="valueWorkCosts" class="negative"><?php echo $city->goldp?></span>
   <img src="img/resource/icon_gold.gif" title="ذهب" alt="ذهب" />
   <span class="timeUnit"> في الساعة</span>
  </li>
  </ul>
  <div id="overchargeMsg" class="status nooc ocready oced">محمّل زيادةً!
  </div>
  <div class="slider" id="sliderbg">
   <div class="actualValue" id="actualValue"></div>
   <!--<div class="overcharge" id="overcharge"></div>-->
   <div id="sliderthumb"></div>
  </div>
   <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="لا يوجد عمّال">
   <span class="textLabel">أدنى</span>
   </a>
   <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?php echo $city->maxWoodWorkers?>); return false;" title="أقصى عدد من العمال">
   <span class="textLabel">أقصى</span>
   </a>
   <input type="hidden" name="action" value="IslandScreen">
   <input type="hidden" name="function" value="workerPlan">
   <input type="hidden" name="view" value="resource">
   <input type="hidden" name="type" value="resource">
   <input type="hidden" name="id" value="<?php echo $island->iid?>">
   <input type="hidden" name="cityId" value="<?php echo $city->cid?>">
   <input class="textfield" id="inputWorkers" type="text" name="rw" maxlength="4" autocomplete="off" />
   <input class="button" id="inputWorkersSubmit" type="submit" value="تأكيد" \>
  </div>
  <div class="footer"></div>
  </div>
 </form>
 <div id="resourceUsers" class="contentBox">
  <h3 class="header">
  <span class="textLabel">لاعب آخر على هذه الجزيرة</span></h3>
  <div class="content">
   <table cellpadding="0" cellspacing="0">
    <thead>
     <tr>
     <th>لاعب 
    <a href="?view=resource&type=resource&id=1575&sortBy=name&order=asc" class="unicode">&uArr;</a>
    <a href="?view=resource&type=resource&id=1575&sortBy=name&order=desc" class="unicode">&dArr;</a>
    </th>
     <th>مدينة                    </th>
     <th>مستوى                    </th>
     <th>عمّال                    </th>
     <th>متبرَّع                     
    <a href="?view=resource&type=resource&id=1575&sortBy=donation&order=asc" class="unicode">&uArr;</a>
    <a href="?view=resource&type=resource&id=1575&sortBy=donation&order=desc" class="unicode">&dArr;</a>
    </th>
     <th>تحركات</th>
    </tr>
    </thead>
    <tbody>
<?php for($i=0;$i<16;$i++){?>
<?php  if($island->IsCityOccupied($i)){?>
	 <?php if($island->IsMyCity($i)){?>
     <tr class="alt own avatar ">
     <?php }else{?> 
     <tr class="avatar ">
     <?php }?> 
     <td class="ownerName"><?php echo $island->GetCityOwnerName($i);?></td>
     <td class="cityName"><?php echo $island->GetCityName($i);?></td>
     <td class="cityLevel">مستوى <?php echo $island->GetCityLevel($i);?></td>
     <td class="cityWorkers"><?php echo $island->GetCityOwnerWorkers($i,"woodworkers");?> عمّال</td>
     <td class="ownerDonation"><?php echo $island->GetCityOwnerDonation($i,"wooddonations");?>
      <img src="img/resource/icon_wood.gif" width="25" height="20" alt="مادة صناعية" />
     </td>
     <?php if($island->IsMyCity($i)){?>
     <td class="actions">&nbsp;</td>
     <?php }else{?> 
     <td class="actions">
      <a href="/action.php?view=sendIKMessage&receiverId=<?php echo $island->GetCityOwnerID($i);?>"><img src="img/icon_message_write.gif" alt="كتابة رسالة" />
      </a>
     </td>
     <?php }?>
    </tr>
<?php }}?>
    </tbody>
   </table>        
  </div>
  <div class="footer"></div>
 </div>
</div>
<!-- END mainview -->
  <?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>
<script type="text/javascript">

        create_slider({

            dir : 'rtl',

            id : "default",

            maxValue : <?php echo $city->maxWoodWorkers?>,

            overcharge : 0,

            iniValue : <?php echo $city->woodworkers?>,

            bg : "sliderbg",

            thumb : "sliderthumb",

            topConstraint: -10,

            bottomConstraint: 344,

            bg_value : "actualValue",

            bg_overcharge : "",//overcharge

            textfield:"inputWorkers"

        });

    Event.onDOMReady(function() {

    var slider = sliders["default"];

        var res = new resourceStack({

            container : "resiconcontainer",

            resourceicon : "resicon",

            width : 140

            });

        res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));

        slider.subscribe("valueChange", function() {

                res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));

                });

        var startSlider = slider.actualValue;

        var valueWorkers = Dom.get("valueWorkers");

        var valueCitizens = Dom.get("valueCitizens");

        var valueResource = Dom.get("valueResource");

        var valueWorkCosts = Dom.get("valueWorkCosts");

        var inputWorkersSubmit = Dom.get("inputWorkersSubmit");

        

        slider.flagSliderMoved =0;

        slider.subscribe("valueChange", function() {

                var startCitizens = <?php echo $city->citizens?>;

                var startResourceWorkers = <?php echo $city->woodworkers?>;

                var startIncomePerTimeUnit = <?php echo $city->goldp?>;

                this.flagSliderMoved = 1;

                //res.setIcons(Math.round(slider.actualValue/(1+0.05*slider.actualValue)));

                valueWorkers.innerHTML = locaNumberFormat(slider.actualValue);

                valueCitizens.innerHTML = locaNumberFormat(startCitizens+startResourceWorkers - slider.actualValue);

                var valRes = 1 * 1 * (Math.min(<?php echo $city->maxWoodWorkers?>, slider.actualValue) + Math.max(0, 0.25 * (slider.actualValue-<?php echo $city->maxWoodWorkers?>)));

                valueResource.innerHTML = '+' + Math.floor(valRes);

                valueWorkCosts.innerHTML = startIncomePerTimeUnit  - 3*(slider.actualValue-startSlider);

            });

        slider.subscribe("slideEnd", function() {

                if (this.flagSliderMoved) {

                        inputWorkersSubmit.className = 'buttonChanged';

                }

         });

    });

</script>