function fire(){
    if(i==1 && /\S/.test(document.getElementById("user").value) && /\S/.test(document.getElementById("schd").value)){
        document.getElementById("send").value="SEND IT";
        setTimeout("fire()",1);
    }
    else if(i==1 && /\S/.test(document.getElementById("user").value) && !(/\S/.test(document.getElementById("schd").value))){
        document.getElementById("send").value="Log In";
        setTimeout("fire()",1);
    }
    else{
        document.getElementById("send").value="Send";
    }
}

/* Old furnace.js
function blr(eye){
	document.body.style.webkitFilter="blur("+eye+"px)";
}

function hearth(idn,tog){
	var b=parseInt(50*Math.random());
    var g=parseInt(50*Math.random());
	if(tog==1){
		document.getElementById(idn).style.backgroundColor="#ff"+b+g;
		document.getElementById(idn).style.borderColor="#752525";
	}
	else{
        document.getElementById(idn).style.backgroundColor="#ffffff";
        document.getElementById(idn).style.borderColor="#becede";
	}
}

function fire(){
    if(i>=1 && i<2000 && /\S/.test(document.getElementById("user").value) && /\S/.test(document.getElementById("schd").value)){
    	hearth("user",1);
    	hearth("schd",1);
    	hearth("send",1);
        document.getElementById("send").value="SEND IT";
        document.getElementById("grad").style.opacity=(i-250)/1000;
        document.getElementById("ient").style.opacity=i-1500;
        setTimeout("fire()",1);
        i++;
        if(i==2000){blr(1);}
        else{blr(0);}
    }
    else{
    	hearth("user",0);
    	hearth("schd",0);
    	hearth("send",0);
        document.getElementById("send").value="Send";
        document.getElementById("grad").style.opacity=0;
        document.getElementById("ient").style.opacity=0;
    }
}
*/