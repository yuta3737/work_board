
var text1 = document.createElement("p");
var text3 = document.createElement("button");
var x = document.getElementById("reply_comment");

document.addEventListener('DOMContentLoaded',function(){
var btn2 = document.querySelectorAll(".btn2");


    for(var j = 0; j < btn2.length; j++){
        btn2[j].addEventListener('click',function(){
        
    var str = this.value;
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



document.addEventListener('DOMContentLoaded',function(){
var edit = document.querySelectorAll(".edit_btn");

    for(var i = 0; i < edit.length; i++){
        edit[i].addEventListener('click',function(){
            
        var NoneDisplay = document.querySelectorAll(".noneDisplay"); 
	    [].forEach.call(NoneDisplay, function(elem) {
	    elem.classList.remove('noneDisplay');
	    });
	    
        var NoneForm = document.querySelectorAll(".blockDisplay"); 
	    [].forEach.call(NoneForm, function(elem) {
	    elem.classList.remove('blockDisplay');
	    });	    
	    
        var HideComment = this.parentNode.parentNode;
        var HideForm = this.parentNode.parentNode.nextElementSibling;
        
        
        HideComment.classList.add('noneDisplay');
        HideForm.classList.add('blockDisplay');
        


        
        },false);
        
    }
},false);


