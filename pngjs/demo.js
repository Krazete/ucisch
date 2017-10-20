var demo=document.createElement("div");
demo.setAttribute("style","position:fixed;top:0;left:0;height:100%;width:100%;background-color:rgba(0,0,0,0.75);color:white;z-index:10000;");
demo.setAttribute("onkeyup","director(event);");
var slide=1;
show(slide);

function show(){
	if(slide<1){
		slide=1;
	}
	else if(slide>12){
		slide=12;
	}
	switch(slide){
		case 1:text="Find WebReg.";break;
		case 2:text="Click WebReg.";break;
		case 3:text="Access WebReg.";break;
		case 4:text="Log in to WebReg.";break;
		case 5:text="Open your study list.";break;
		case 6:text="Select and copy your schedule.";break;
		case 7:text="You can be messy about it. I'll get rid of any extra text.";break;
		case 8:text="Just don't select anything beyond the blue lines, or you might cause an error.";break;
		case 9:text="Remember to log out.";break;
		case 10:text="Enter your information and submit.";break;
		case 11:text="Bam. It's done. And lastly...";break;
		case 12:text="To log back in, just submit the form with your UCInet ID and a blank schedule.";break;
		default:break;
	}
	demo.innerHTML="<h1>Instructions</h1><br><div style='height:462px;'><img src='Demo/"+slide+".png'/></div><br>"+slide+". "+text;
}
function done(){
	demo.remove();
	exit.remove();
	left.remove();
	right.remove();
}

var exit=document.createElement("div");
exit.setAttribute("style","position:fixed;top:5px;right:55px;height:50px;width:50px;background-color:rgba(255,255,255,0.25);color:white;z-index:20000;cursor:pointer;font-size:40px;font-family:monospace;");
exit.setAttribute("onClick","done();");
exit.innerHTML="X";
var left=document.createElement("div");
left.setAttribute("style","position:fixed;top:0;left:0;height:100%;width:50px;background-color:rgba(255,255,255,0.25);z-index:20000;cursor:pointer;");
left.setAttribute("onClick","slide--;show(slide);");
left.innerHTML="<h1><</h1>";
var right=document.createElement("div");
right.setAttribute("style","position:fixed;top:0;right:0;height:100%;width:50px;background-color:rgba(255,255,255,0.25);z-index:20000;cursor:pointer;");
right.setAttribute("onClick","slide++;show(slide);");
right.innerHTML="<h1>></h1>";

function dummy(){
	document.body.appendChild(demo);
	document.body.appendChild(exit);
	document.body.appendChild(left);
	document.body.appendChild(right);
}

function director(event) {
	if(event.keyCode==37){
		slide--;
		show(slide);
	}
	else if(event.keyCode==39){
		slide++;
		show(slide);
	}
}
