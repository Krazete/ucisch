function adblock(){
	var ad=document.getElementsByTagName("div")[document.getElementsByTagName("div").length-1];
	for(i=0;i<document.getElementsByTagName("div").length;i++){
		if(ad.class=="adblockblock"){
			break;
		}
		else{
			ad.remove();
		}
	}
}
