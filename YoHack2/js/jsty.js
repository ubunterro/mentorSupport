function feedbackAjax(){
var formData = new FormData($('#dob')[0]);
$.ajax({
      type: "POST",
      processData: false,
      contentType: false,
      url: "dobmentor.php",
      data: formData 
      })
      .done(function(data) {
           if(data=='добавлен'){
         alert(data);
    document.forms['dob'].reset();
    }
  else{
      alert(data);}           
      });  
  }



  function sherch(){
var formData = new FormData($('#search')[0]);
$.ajax({
      type: "POST",
      processData: false,
      contentType: false,
      url: "./job/sherch.php",
      data: formData 
      })
      .done(function(data) {
           if(data=='не найдено'){
         alert(data);
    }
  else{
      document.location.href = data;}           
      });  
  }