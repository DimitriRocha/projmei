$(function () {
  	$('.navbar-toggle-sidebar').click(function () {
  		$('.navbar-nav').toggleClass('slide-in');
  		$('.side-body').toggleClass('body-slide-in');
  		$('#search').removeClass('in').addClass('collapse').slideUp(200);
  	});

  	$('#search-trigger').click(function () {
  		$('.navbar-nav').removeClass('slide-in');
  		$('.side-body').removeClass('body-slide-in');
  		$('.search-input').focus();
  	});
  });

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

    $('.contentWrapper').hide();
    $('#inicialContent').show();

    $('#geral-btn').on('click', function (){
      $('.contentWrapper').hide();
      $('.btn-selector').removeClass("active");

      $('#inicialContent').show();
      $(this).addClass("active");
    });

    $('#meus-casos-btn').on('click', function (){
      $('.contentWrapper').hide();
      $('.btn-selector').removeClass("active");

      $('#meusCasos').show();
      $(this).addClass("active");
    });

    $('#perfil-btn').on('click', function (){
      $('.contentWrapper').hide();
      $('.btn-selector').removeClass("active");

      $('#perfil').show();
      $(this).addClass("active");
    });


///////////////////////////////////////////////////
  $(".atribuirConsultor").click(function(){
    var assId = parseInt($(this).attr("ass-id"));
   // alert(postData);
   var myData={"con_id":consultorId, "ass_id":assId};
   $.ajax({
      url : "_recursos/atribuirCaso.php",
      type: "POST",
      data : myData,
      success: function(data,status,xhr){
        console.log(data);
        console.log(status);
        console.log(xhr);
       }   
      }); 
  }); 

  $(".fecharCaso").click(function(){
    var assId = parseInt($(this).attr("ass-id"));
    var myData={ "con_id" :consultorId, "ass_id" : assId};
    $.ajax({
      url : "_recursos/fecharCaso.php",
      type: "POST",
      data : myData,
      success: function(data,status,xhr){
        console.log(data);
        console.log(status);
        console.log(xhr);
      }   
      }); 
  });

});

