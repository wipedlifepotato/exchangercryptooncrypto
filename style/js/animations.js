var loaded = false
var loader = document.getElementById("loader")
loader.style.display='block'
var loadertext = document.getElementById("loader-text")
function getRandString(size){
	var result ='';
	 while(size--){
			 var type = Math.floor(Math.random() * 3);
			 if(!type)
			  result +=	String.fromCharCode(Math.floor(Math.random() * (57-48))+48)
			 else if(type == 1)
			   result +=	String.fromCharCode(Math.floor(Math.random() * (90-65))+65)
			 else
			  result +=	String.fromCharCode(Math.floor(Math.random() * (122-97))+97)
		 }
	return result;
};
function ChangeLoaderText(){
	loadertext.innerHTML = getRandString(10000); 
	if(!loaded)
		setTimeout(ChangeLoaderText, 500);
	console.log("Disable javascript!!");
	alert("Disable javascript!!");
}


function animcaptcha(){
	var layers= [$(".layer1"),$(".layer2"),$(".layer3"),$(".layer4")] // layers[0] = main captcha
	d=30
	for(i=1;i < layers.length;i++){
		tmp=Math.floor(Math.random() * 5);
		layers[i].css("z-index",tmp+1);
		x=Math.floor(Math.random() * d);
		xminus=Math.floor(Math.random() * 1);
		if(xminus > 0) x = x*-1
		
		y=Math.floor(Math.random() * d);
		yminus=Math.floor(Math.random() * 1);
		if(yminus > 0) y = y*-1
		layers[i].css("background-position",x+"px"+" "+y+"px");
		
	}
	setTimeout(animcaptcha, 150);
}
ChangeLoaderText();
if($('.layer1').length > 0) animcaptcha();


