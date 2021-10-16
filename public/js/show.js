
var text1 = document.createElement("p");
var text3 = document.createElement("button");
var x = document.getElementById("reply_comment");


document.addEventListener('DOMContentLoaded',function(){
var btn2 = document.querySelectorAll(".btn2");


    for(var j = 0; j < btn2.length; j++){
        btn2[j].addEventListener('click',function(){
    var str =  this.value;
	document.faceForm.face.value  = str;
	
	text1.innerHTML = "返信するコメントのID : " + document.faceForm.face.value;
	text3.innerHTML = "返信を取り消す";
	text3.setAttribute('type', 'button');
	text3.setAttribute('class', 'button4');
	x.appendChild(text1);
	x.appendChild(text3);
            
        },false);
    }
},false);


text3.addEventListener("click",function loseTF()
{
    text1.innerHTML = "";
	text3.innerHTML = "";
    text1.remove();
    text3.remove();
});