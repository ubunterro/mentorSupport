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
var formData = new FormData($('#searche')[0]);
$.ajax({
      type: "POST",
      processData: false,
      contentType: false,
      url: "sherch.php",
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


  function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }



$( document ).ready(function() {
  $(".likes").click(function() {
    //alert(event.target.id);
    var id = event.target.id;
    console.log(id);

    var cookie = getCookie("hackLikes");

    if (cookie == undefined || cookie == null){
      document.cookie = "hackLikes={}"
    } else {
      var result = [];

      var likes = JSON.parse(getCookie("hackLikes"));


      result = likes;
      

      if (!result.includes(id.toString())){
        $.post( "job/like.php", { id: event.target.id });
        

        var likeCount = parseInt($(event.target).text().replace(/^(\S+) /g, ''));
        $(event.target).text($(event.target).text().replace(likeCount.toString(), (likeCount + 1).toString()));
        result.push(id);
        document.cookie = "hackLikes=" + JSON.stringify(result);
      }  	
    }

   

  });
});