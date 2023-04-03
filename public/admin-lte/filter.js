
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

// event untuk livewire start
// @todo #12
window.addEventListener('jsShowDetail',event =>{
    $("#vert-tabs-home").hide(500)
    $("#userdetail").show(500)
})

// @todo #13
// Add active class to the current button (highlight it)
// var btnContainer = document.getElementById("myBtnContainer");
// var btns = btnContainer.getElementsByClassName("btn1");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function(){
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//   });
// }


// var header = document.getElementById("myBtnContainer");
// var btns = header.getElementsByClassName("btn1");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//   var current = document.getElementsByClassName("active");
//   if (current.length > 0) { 
//     current[0].className = current[0].className.replace(" active", "");
//   }
//   this.className += " active";
//   });
// }
// script untuk section progres pos dan tabel rekap Admin Sektor Start





  // hide and show progres pos start
  function showDetail(nrk,periode){
    //alert("Tester") console.
    //alert(Filter)
    Livewire.emit('showDetail',[nrk,periode])
  }

  function backToList(){
    $("#vert-tabs-home").show(500)
    $("#userdetail").hide(500)
  }
  // hide and show progres pos end

  // hide and show tabel rekap start
  function rekapDetail(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    Livewire.emit('rekapDetail',[Id,Filter]);
    $("#rekap-tabel").hide(500)
    $("#rekapdetail").collapse('show')
  }

  function backToRekap(){
    $("#rekap-tabel").show(500)
    $("#rekapdetail").collapse('hide')
  }

  //function untuk Progress
  function rekapProgres(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id rekap progress : "+Id)
    Livewire.emit('rekapProgres',[Id,Filter]);
    $("#rekap-progres").hide(500)
    $("#rekapprogres").collapse('show')
  }

  function backToProgres(){
    $("#rekap-progres").show(500)
    $("#rekapprogres").collapse('hide')
  }

 

  //function untuk inputan aksi sudin layout admin sudin
  window.addEventListener('tampilAksiSudin',event=>{
    //alert("Tester") console.
    //alert(Filter)
    console.log("aksi sudin triggered")
    // Livewire.emit('inputSudin',Id);
    $("#input-sudin").hide(500)
    $("#aksisudin").collapse('show')
  })

  function backToSudin(){
    $("#input-sudin").show(500)
    $("#aksisudin").collapse('hide')
  }

//function untuk Distribusi
  function rekapDistribusi(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    Livewire.emit('rekapDistribusi',[Id,Filter]);
    $("#rekap-distribusi").hide(500)
    $("#rekapdistribusi").collapse('show')
  }

  function backToDistribusi(){
    $("#rekap-distribusi").show(500)
    $("#rekapdistribusi").collapse('hide')
  }
// hide and show tabel rekap end

// @todo #11
// function onClick filter di tabel rekap start
  // function filter All
  function filterAll(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    $(".fire-jacket").show(500)
    $(".fire-troser").show(500)
    $(".fire-helmet").show(500)
    $(".fire-gloves").show(500)
    $(".rescue-gloves").show(500)
    $(".rescue-helmet").show(500)
    $(".jumsuit").show(500)
    $(".fire-boots").show(500)
    $(".rescue-boots").show(500)
    $(".respirator").show(500)
    $(".fire-goggles").show(500)
    $(".kapak").show(500)
    $(".senter").show(500)
  }
  // semua function Filter Fire Jacket
  function filterJaket(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
    $(".fire-jacket").show(500)
  }
  function filterJaketBaik(Id,Filter){

    console.log("Id",Id)
    $(".fire-jacket.baik").show(500)
    $(".fire-jacket.rusak-berat").hide(500)
    $(".fire-jacket.rusak-ringan").hide(500) 
    $(".fire-jacket.rusak-sedang").hide(500)
    $(".fire-jacket.belum-terima").hide(500)
    $(".fire-jacket.hilang").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterJaketRingan(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket.baik").hide(500)
    $(".fire-jacket.rusak-berat").hide(500)
    $(".fire-jacket.rusak-ringan").show(500) 
    $(".fire-jacket.rusak-sedang").hide(500)
    $(".fire-jacket.belum-terima").hide(500)
    $(".fire-jacket.hilang").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterJaketBerat(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket.baik").hide(500)
    $(".fire-jacket.rusak-berat").show(500)
    $(".fire-jacket.rusak-ringan").hide(500) 
    $(".fire-jacket.rusak-sedang").hide(500)
    $(".fire-jacket.belum-terima").hide(500)
    $(".fire-jacket.hilang").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterJaketSedang(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket.baik").hide(500)
    $(".fire-jacket.rusak-berat").hide(500)
    $(".fire-jacket.rusak-ringan").hide(500) 
    $(".fire-jacket.rusak-sedang").show(500)
    $(".fire-jacket.belum-terima").hide(500)
    $(".fire-jacket.hilang").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterJaketBelumTerima(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket.baik").hide(500)
    $(".fire-jacket.rusak-berat").hide(500)
    $(".fire-jacket.rusak-ringan").hide(500) 
    $(".fire-jacket.rusak-sedang").hide(500)
    $(".fire-jacket.belum-terima").show(500)
    $(".fire-jacket.hilang").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterJaketHilang(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket.hilang").show(500)
    $(".fire-jacket.baik").hide(500)
    $(".fire-jacket.rusak-berat").hide(500)
    $(".fire-jacket.rusak-ringan").hide(500) 
    $(".fire-jacket.rusak-sedang").hide(500)
    $(".fire-jacket.belum-terima").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterTroser(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket").hide(500)
    $(".fire-troser").show(500)
    $(".fire-helmet").hide(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
  function filterHelmet(Id,Filter){
    
    console.log("Id",Id)
    $(".fire-jacket").hide(500)
    $(".fire-troser").hide(500)
    $(".fire-helmet").show(500)
    $(".fire-gloves").hide(500)
    $(".rescue-gloves").hide(500)
    $(".rescue-helmet").hide(500)
    $(".jumsuit").hide(500)
    $(".fire-boots").hide(500)
    $(".rescue-boots").hide(500)
    $(".respirator").hide(500)
    $(".fire-goggles").hide(500)
    $(".kapak").hide(500)
    $(".senter").hide(500)
  }
// script untuk section progres pos dan tabel rekap Admin Sektor End

// script untuk toast notif edit data pegawai
