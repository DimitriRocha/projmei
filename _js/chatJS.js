
function countChar(val){
     var len = val.value.length;
     console.log(len);
     if (len >= 500) {
              val.value = val.value.substring(0, 500);
     } else {
              $('#charNum').text(500 - len);
     }
};


function updateScroll() {
    var element = document.getElementById("chat-box");
    element.scrollTop = element.scrollHeight;
    //console.log('Funfou');
}

function reloadDiv(){
    $( "#control-div" ).load(window.location.href + " #control-div");

    $( "#alertUpdt" ).fadeIn(1000);

    setTimeout(function(){
      $( "#alertUpdt" ).fadeOut(1000);
    }, 2000);




}

function showAlert(){

}

function alertCharNumber(charNum){
  if (charNum < 1 || charNum > 255) {
    alert('Quantidade invalida de caracteres');
  }
}

function makeFade(){
  $('#alertUpdt').delay(2000).fadeOut(400);
  console.log('Alert will fade')
}

function mudarTextBtnCaso(value){
  console.log(value);
}
