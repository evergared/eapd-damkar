
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

function showDetail(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $("#vert-tabs-home").hide(500)
  $("#userdetail").show(500)
}

function backToList(){
  $("#vert-tabs-home").show(500)
  $("#userdetail").hide(500)
}

function rekapDetail(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $("#rekap-tabel").hide(500)
  $("#rekapdetail").show(500)
}

function backToRekap(){
  $("#rekap-tabel").show(500)
  $("#rekapdetail").hide(500)
}

function filterJaket(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $("#fire-troser").hide(500)
  $("#fire-helmet").hide(500)
  $("#fire-jacket").show(500)
}
function filterTroser(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $("#fire-jacket").hide(500)
  $("#fire-troser").show(500)
  $("#fire-helmet").hide(500)
}
function filterHelmet(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $("#fire-jacket").hide(500)
  $("#fire-troser").hide(500)
  $("#fire-helmet").show(500)
}
function filterAll(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $("#fire-jacket").show(500)
  $("#fire-troser").show(500)
  $("#fire-helmet").show(500)
}
function filterBerat(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $(".rusak-berat").show(500)
  $(".baik").hide(500)
  $(".rusak-ringan").hide(500)
}
function filterJaketBaik(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $(".rusak-berat").hide(500)
  $(".baik").show(500)
  $(".rusak-ringan").hide(500)
}
function filterRingan(Id,Filter){
  //alert("Tester") console.
  //alert(Filter)
  console.log("Id",Id)
  $(".rusak-berat").hide(500)
  $(".baik").hide(500)
  $(".rusak-ringan").show(500)
}