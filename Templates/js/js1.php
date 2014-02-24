<script type="text/javascript">
var Event = YAHOO.util.Event,
    Dom   = YAHOO.util.Dom,
    lang  = YAHOO.lang;
var LocalizationStrings = {};
LocalizationStrings['timeunits'] = {};
LocalizationStrings['timeunits']['short'] = {};
LocalizationStrings['timeunits']['short']['day'] = 'ي';
LocalizationStrings['timeunits']['short']['hour'] = 'ساعة';
LocalizationStrings['timeunits']['short']['minute'] = 'د';
LocalizationStrings['timeunits']['short']['second'] = 'ث';
LocalizationStrings['language']                     = 'ae';
LocalizationStrings['decimalPoint']               = '.';
LocalizationStrings['thousandSeperator']     = ',';
LocalizationStrings['resources'] = {};
LocalizationStrings['resources']['wood'] = 'مادة صناعية';
LocalizationStrings['resources']['wine'] = 'مشروب العنب';
LocalizationStrings['resources']['marble'] = 'رخام';
LocalizationStrings['resources']['crystal'] = 'بلور';
LocalizationStrings['resources']['sulfur'] = 'كبريت';
LocalizationStrings['resources'][0] = LocalizationStrings['resources']['wood'];
LocalizationStrings['resources'][1] = LocalizationStrings['resources']['wine'];
LocalizationStrings['resources'][2] = LocalizationStrings['resources']['marble'];
LocalizationStrings['resources'][3] = LocalizationStrings['resources']['crystal'];
LocalizationStrings['resources'][4] = LocalizationStrings['resources']['sulfur'];
LocalizationStrings['warnings'] = {};
LocalizationStrings['warnings']['premiumTrader_lackingStorage'] = "Fr folgende Rohstoffe fehlt dir Speicherplatz: $res";
LocalizationStrings['warnings']['premiumTrader_negativeResource'] = "Du hast zuwenig $res fr diesen Handel";
LocalizationStrings['warnings']['tolargeText'] = 'انتباه! يشمل نصك على عدد حروف أكبر من العدد المسموح به!';
ikariam = {
	phpSet : {
		serverTime : <?php echo "\"".time()."\"";?>,
		currentView : <?php if(isset($_GET['view'])) echo "\"".$_GET['view']."\""; else echo "\"city\"";?>
	},
	currentCity : {
		resources : {
			wood: <?php echo $city->getProd('wood');?>,
			wine: <?php echo $city->getProd('wine');?>,
			marble: <?php echo $city->getProd('marble');?>,
			crystal: <?php echo $city->getProd('crystal');?>,
			sulfur: <?php echo $city->getProd('sulfur');?>
		},
		maxCapacity : {
			wood: <?php echo $city->maxstore;?>,
			wine: <?php echo $city->maxstore;?>,
			marble: <?php echo $city->maxstore;?>,
			crystal: <?php echo $city->maxstore;?>,
			sulfur: <?php echo $city->maxstore;?>                      
		}
	},
	view : {
		get : function() {
			return ikariam.phpSet.currentView;
		},
		is : function(viewName) {
			return (ikariam.phpSet.currentView == viewName)? true : false;
		}
	}
};
ikariam.time = {
	serverTimeDiff : ikariam.phpSet.serverTime*1000-(new Date()).getTime()
};
selectGroup = {
	groups:new Array(), //[groupname]=item
	getGroup:function(group) {
	if(typeof(this.groups[group]) == "undefined") {
		this.groups[group] = new Object();
		this.groups[group].activeItem = "undefined";
		this.groups[group].onActivate = function(obj) {};
		this.groups[group].onDeactivate = function(obj) {};
	}
	return this.groups[group];
	},
	activate:function(obj, group) {
	g = this.getGroup(group);
	if(typeof(g.activeItem) != "undefined") {
		g.onDeactivate(g.activeItem);
	}
	g.activeItem=obj;
	g.onActivate(obj);
	}
};
selectGroup.getGroup('cities').onActivate = function(obj) {
	YAHOO.util.Dom.addClass(obj.parentNode, "selected");
 }
selectGroup.getGroup('cities').onDeactivate = function(obj) {
	YAHOO.util.Dom.removeClass(obj.parentNode, "selected");
}
function showInContainer(source, target, exchangeClass) {
	//objects or Id-strings, i don't care
	if(typeof source == "string") { source = Dom.get(source); }
	if(typeof target == "string") {target = Dom.get(target); }
	if(typeof exchangeClass != "string") { alert("Error: ikariam.showInContainer -> Forgot to add an exchangeClass?"); }
	for(i=0; i<target.childNodes.length; i++) {
		if(typeof(target.childNodes[i].className) != "undefined" && target.childNodes[i].className==exchangeClass) {
		target.removeChild(target.childNodes[i]);
		}
	}
	for(i=0; i<source.childNodes.length; i++) {


		if(typeof(source.childNodes[i].className) != "undefined" && source.childNodes[i].className==exchangeClass) {
		clone = source.childNodes[i].cloneNode(true);
		target.insertBefore(clone, target.firstChild.nextSibling);
		}
	}
}
selectedCity = -1;
function selectCity(cityNum, cityId, viewAble) {
	if(selectedCity == cityNum) {
		if(viewAble)
		  document.location.href="?view=city&id="+cityId;
		else
		  document.location.href="#";
	} else {
		selectedCity = cityNum;
	}
	showInContainer("cityLocation"+cityNum,"information", "cityinfo");
	showInContainer("cityLocation"+cityNum,"actions", "cityactions");
	var container = document.getElementById("cities");
	var citySelectedClass = "selected";
}
function selectBarbarianVillage() {
	showInContainer("barbarianVilliage","information", "cityinfo");
	showInContainer("barbarianVilliage","actions", "cityactions");
	selectedCity = 0;
}

//IE6 CSS Background-Flicker fix
(function(){
/*Use Object Detection to detect IE6*/
var  m = document.uniqueID /*IE*/
&& document.compatMode  /*>=IE6*/
&& !window.XMLHttpRequest /*<=IE6*/
&& document.execCommand ;
try{
if(!!m){
m("BackgroundImageCache", false, true) /* = IE6 only */
}
}catch(oh){};
})();
/* ]]> */

function myConfirm(message, target) {
	bestaetigt = window.confirm (message);
	if (bestaetigt == true)
		window.location.href = target;
}
</script>
