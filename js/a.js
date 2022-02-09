function activateVar(element) {
  //   alert(element);
  $(element).attr("class", "activate");
}
function editVar(element, column, id) {
  var value = element.innerText;
  $(element).attr("class", "processing");
  $.ajax({
    url: "edit_application.php",
    type: "post",
    data: {
      value: value,
      column: column,
      id: id,
    },
    success: function (php_result) {
      console.log(php_result);
      $(element).removeAttr("class", "activate");
    },
  });
}

function editUniStat(id, uniStatId) {
  console.log("bolayo");
  var value = uniStatId;
  $(element).attr("class", "processing");
  $.ajax({
    url: "edit_application.php",
    type: "post",
    data: {
      value: value,
      column: 'uniastatus',
      id: id,
    },
    success: function (php_result) {
      console.log(php_result);
      $(element).removeAttr("class", "activate");
    },
  });
}
// $("editable_Select").editableSelect();
