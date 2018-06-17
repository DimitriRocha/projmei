

$( document ).ready(function() {
  var ajaxRequest;  // The variable that makes Ajax possible!
  try{
    ajaxRequest = new XMLHttpRequest();
  }catch (e){
    try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
    }catch (e) {
      try{
          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
          alert("Your browser broke!");
          return false;
      }
    }
  }

  setInterval(function(){
    $( "#control-div" ).load(window.location.href + " #control-div");
    console.log('Atualizou');
  }, 3000);

  $("#mensagens").submit(function(e){
    e.preventDefault();
    var assId = $('#msgAssId').val();
    var txt = $('#textInput').val();
    var myData={"texto":txt, "ass_id":assId, "tipo":0};
    if(txt != null && txt != ""){
      $.ajax({
        url : "_recursos/enviarTextoChat",
        type: "GET",
        data : myData,
        success: function(data,status,xhr){
          $('#textInput').val('');
          $( "#control-div" ).load(window.location.href + " #control-div");
          // console.log(data);
          // console.log(status);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus);
            console.log("Error: " + errorThrown); 
        }      
      }); 
    }
  }); 



});

function countChar(val){
     var len = val.value.length;
     //console.log(len);
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

