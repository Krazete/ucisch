var sm=document.createElement("div");
sm.setAttribute("style","position: fixed;bottom: 0;left: 0;height: 20px;width: 20px;background: black;border: 2px solid white;border-radius: 50%;font-family: monospace;font-size: 10px;font-weight: bold;line-height: 85%;color: white;text-align: center;opacity: 0.5;z-Index: 1;");
/*
sm.setAttribute("style","
	position: fixed;
	bottom: 0;
	left: 0;
	height: 20px;
	width: 20px;
	background: black;
	border: 2px solid white;
	border-radius: 50%;
	
	font-family: monospace;
	font-size: 10px;
	font-weight: bold;
	line-height: 85%;
	color: white;
	text-align: center;
	
	opacity: 0.5;
	z-Index: 1;
");
*/
document.documentElement.appendChild(sm);

function trig(){
	requestAnimationFrame(trig);
	/*var msec=(Date.now()/1000) % 60;*/
	var H=new Date().getHours();
	var M=new Date().getMinutes();
	var msec=(new Date().getDay()-1)+H/24+M/6000;
	var cosune=Math.cos(2*Math.PI*msec);
	var hex=256*(1-cosune)/2;
	/*var hue="radial-gradient(rgba("+parseInt(255*(-sune))+",0,"+parseInt(255*sune)+","+Math.abs(sune)+"),black)";*/
	var hue="rgb("+parseInt(hex)+","+parseInt(hex*15/16)+","+parseInt(hex/2+64)+")";
	sm.style.color=hue;
	sm.style.border="2px solid "+hue;
	document.body.style.background="radial-gradient("+hue+",rgb("+parseInt(hex/4)+","+parseInt(hex/8)+",0))";
	document.body.style.backgroundSize="100% 4px";
	sm.style.bottom=(1-cosune)*(innerHeight-(parseFloat(sm.style.height)+2*parseFloat(sm.style.border)))/2+"px";
	sm.style.left=(12*msec-1)*(innerWidth+(parseFloat(sm.style.width)+2*parseFloat(sm.style.border)))/60+"px";
	/*sm.style.left=(msec-1)*(innerWidth+(parseFloat(sm.style.width)+2*parseFloat(sm.style.border)))/60+"px";*/
	/*sm.style.left=(sune+1)*(innerHeight-parseFloat(sm.style.height))/2+(innerWidth-innerHeight)/2+"px";*/
	if(H==0){
		H=12;
	}
	else if(H>12){
		H-=12;
	}
	sm.innerHTML=(H<10) ? "0"+H : H;
	sm.innerHTML+="<br/>";
	sm.innerHTML+=(M<10) ? "0"+M : M;
}

trig();