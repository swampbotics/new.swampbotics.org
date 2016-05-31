$(document).ready(function(){
  /*------------------ Variables ------------------*/
  var parts = document.URL.split("/")
  var page = parts[3]
  /*------------------ Functions ------------------*/
  $('img').on('dragstart', function(e){
    e.preventDefault()
  })


})
