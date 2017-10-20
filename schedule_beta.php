<!DOCTYPE html>
<html>
<head>
<title>
<?php    
    echo ucfirst($name)." [UCISch]";
?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/ico" href="pngjs/testsun2.png">
<link rel="stylesheet" type="text/css" href="beta.css">
</head>

<body>
<div class="bg"></div>

<div style="position:absolute;top:5px;right:5px;background-color:rgba(255,255,255,0.5);color:white;cursor:pointer;z-index:9999;" onClick="document.cookie='user=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';setTimeout(e=>location.reload(),10);">[Log Out]</div>

<h1 id="Mo">Monday</h1>
<h1 id="Tu">Tuesday</h1>
<h1 id="We">Wednesday</h1>
<h1 id="Th">Thursday</h1>
<h1 id="Fr">Friday</h1>
<h1 id="Sa">Sæterndæg</h1>
<h1 id="Su">Sunnandæg</h1>

<div class="container">
<!-- Schedule -->
<table class="schedule">
<tr>
<?php
    for($i=0;$i<$end;$i++){
        echo "<td id=\"$type[$i]$class[$i]\">\n";
        if($qtr=="date(\"y\")-"){
            echo "$aessubject[$i] $class[$i] $aestype[$i]<br>\n";
        }
        else{
        	if($aestype[$i]=="Discussion" || $aestype[$i]=="Laboratory"){
        		for($j=0;$j<$end;$j++){
        			if($aessubject[$j]==$aessubject[$i] && $class[$j]==$class[$i] && $aestype[$j]!="Discussion" && $aestype[$j]!="Laboratory")
        			{
        				$code[$i]=$code[$j];
        			}
        		}
        	}
            echo "<a href=\"http://eee.uci.edu/$qtr/$code[$i]/\" target=\"_blank\">$aessubject[$i] $class[$i]</a> $aestype[$i]<br>\n";
        }
        echo "$aestime[$i]<br>\n";
        if($building[$i]=="ECT"){
        	echo "<img src=\"pngjs/ECT.png\"/><br>\n";
        	echo "$aesbuilding[$i] $room[$i]\n";
        }
        else{
        	if($building[$i]=="IAB"){
	        	echo "<img src=\"http://www.classrooms.uci.edu/GAC/mapgrids/HOB2.png\"/><br>\n";
        	}
        	else{
	        	echo "<img src=\"http://www.classrooms.uci.edu/GAC/mapgrids/$building[$i].png\"/><br>\n";
        	}
        	echo "<a href=\"http://www.classrooms.uci.edu/GAC/$building[$i].html\" target=\"_blank\">$aesbuilding[$i]</a>\n";
        	echo " ";
        	echo "<a href=\"http://www.classrooms.uci.edu/GAC/$building[$i]";
        	if(is_numeric(substr($building[$i],-1))){
        		echo "-";
        	}
        	echo "$room[$i].html\" target=\"_blank\">$room[$i]</a>\n";
        }
        echo "</td>\n";
    }
?>
<td id="SAT">
It's Saturday!<br><br>
<img class="satsun" id="sat" src="http://www.brainlesstales.com/images/2011/Nov/saturnday.jpg" height="250px"/><br><br>
Get outta here! :D
</td>
<td id="SUN">
It's Sunday!<br><br>
<img class="satsun" id="sun" src="http://www.macarisrestaurant.co.uk/files/chocolate-sundae.png" height="250px"/><br><br>
Go eat a sundae! :D
</td>
</tr>
</table>
</div>

<table class="button">
<tr>
<th onClick="reset();day=1;get();">Monday</th>
<th onClick="reset();day=2;get();">Tuesday</th>
<th onClick="reset();day=3;get();">Wednesday</th>
<th onClick="reset();day=4;get();">Thursday</th>
<th onClick="reset();day=5;get();">Friday</th>
<tr>
</table>

<!-- Script -->
<script type="text/javascript">
var day=new Date().getDay();
var trueday=new Date().getDay();
<?php
    for($i=0;$i<$end;$i++){
        echo "var $type[$i]$class[$i]=document.getElementById(\"$type[$i]$class[$i]\");\n";
    }
?>
var rgba=["rgba(0,0,0,0)","rgba(0,100,200,","rgba(110,100,90,"];

function reloader(){
requestAnimationFrame(reloader);
if(trueday!=new Date().getDay()){
reset();
day=new Date().getDay();
trueday=new Date().getDay();
get();
}
}

function clr(o){
if(day==trueday){
return rgba[1]+o+")";
}
else{
return rgba[2]+o+")";
}
}

function lock(n){
if(n==1){
document.title=n+" minute until class.";
}
else{
document.title=n+" minutes until class.";
}
}

function alarm(sbj,key){
<?php
    for($i=1;$i<6;$i++){
        if($i!=1){
            echo "else ";
        }
        echo "if(trueday==$i){\n";
        echo "switch(sbj){\n";
        for($j=0;$j<$end;$j++){
            if($days[$j][$i-1]!="-"){
                echo "case \"$type[$j]$class[$j]\":lock(key);break;\n";
            }
        }
        echo "default:break;\n";
        echo "}\n";
        echo "}\n";
    }
?>
}

function dye(){
var hr=new Date().getHours();
var min=new Date().getMinutes();
var time=100*hr+min;

<?php
    for($i=0;$i<$end;$i++){
        echo "$type[$i]$class[$i].style.backgroundColor=rgba[0];\n";
    }
    echo "\n";
    echo "document.title=\"".ucfirst($name)." [UCISch]\";\n";
    echo "var gradient=min/60;\n";
    echo "\n";
    for($i=0;$i<$end;$i++){
        echo "if(time>=".($rtime[$i][0]-100)." && time<".$rtime[$i][0]."){\n";
        if($rtime[$i][0]%100!=0){
            echo "gradient=hr-".(floor($rtime[$i][0]/100)-1)."+min/60-".(($rtime[$i][0]%100)/60).";\n";
        }
        echo "$type[$i]$class[$i].style.backgroundColor=clr(gradient);\n";
        echo "alarm(\"$type[$i]$class[$i]\",Math.round((1-gradient)*60));\n";
        echo "}\n";
        echo "else if(time>=".$rtime[$i][0]." && time<".$rtime[$i][1]."){\n";
        echo "$type[$i]$class[$i].style.backgroundColor=clr(1);\n";
        echo "}\n";
    }
?>
setTimeout("dye()",10000);
}

function get(){
<?php
    for($i=1;$i<6;$i++){
        switch($i){
            case 1:$dah="Mo";break;
            case 2:$dah="Tu";break;
            case 3:$dah="We";break;
            case 4:$dah="Th";break;
            case 5:$dah="Fr";break;
            default:break;
        }
        if($i!=1){
            echo "else ";
        }
        echo "if(day==$i){\n";
        echo "document.getElementById(\"$dah\").style.display=\"block\";\n";
        for($j=0;$j<$end;$j++){
            if($days[$j][$i-1]!="-"){
                echo "$type[$j]$class[$j].style.display=\"table-cell\";\n";
            }
        }
        echo "}\n";
    }
?>
else if(day==6){
document.getElementById("Sa").style.display="block";
document.getElementById("SAT").style.display="table-cell";
}
else{
document.getElementById("Su").style.display="block";
document.getElementById("SUN").style.display="table-cell";
}
dye();
}

function reset(){
for(i=0;i<document.getElementsByTagName("h1").length;i++){
document.getElementsByTagName("h1")[i].style.display="none";
}
for(i=0;i<document.getElementsByTagName("td").length;i++){
document.getElementsByTagName("td")[i].style.display="none";
}
}

get();
reloader();
</script>

<!--
<form onInput="document.getElementsByClassName('bg')[0].style.opacity=parseInt(grade.value)/100;" style="position:absolute;top:525px">
<input type="range" id="grade" value="50">
</form>
-->
<script src="pngjs/sune.js" type="text/javascript"></script>
</body>
</html>
<!--
//echo "if(time==$rtime[$i][0] || time==$rtime[$i][0]-100){\n";
//echo "location.replace(location.origin+location.pathname+\"#$type[$i]$class[$i]\");\n";
//echo "}\n";

/* Needed */
Card Focus: Pound Redirection
Aesthetics: Shorten ChFunctions
-->