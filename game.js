

function gn() {
  var std = $('#deep').text();
$.ajax({
  url : "index.php",
  type : "POST",
  data :  { sid: std},
  success : function(data){
console.log('cat');
  } 
});
}
