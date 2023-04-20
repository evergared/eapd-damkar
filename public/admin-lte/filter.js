
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

//js datepicker
$(function () {
  var bindDatePicker = function() {
   $(".date").datetimepicker({
       format:'YYYY-MM-DD',
     icons: {
       time: "fa fa-clock-o",
       date: "fa fa-calendar",
       up: "fa fa-arrow-up",
       down: "fa fa-arrow-down"
     }
   }).find('input:first').on("blur",function () {
     // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
     // update the format if it's yyyy-mm-dd
     var date = parseDate($(this).val());

     if (! isValidDate(date)) {
       //create date based on momentjs (we have that)
       date = moment().format('YYYY-MM-DD');
     }

     $(this).val(date);
   });
 }
  
  var isValidDate = function(value, format) {
   format = format || false;
   // lets parse the date to the best of our knowledge
   if (format) {
     value = parseDate(value);
   }

   var timestamp = Date.parse(value);

   return isNaN(timestamp) == false;
  }
  
  var parseDate = function(value) {
   var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
   if (m)
     value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

   return value;
  }
  
  bindDatePicker();
});

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

  //hide and show template inputan APD admin dinas
  function templateInputan(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    Livewire.emit('templateInputan',[Id,Filter]);
    $("#card-detail-periode").hide(500)
    $("#atur-template-imputan-apd").show(500)
  }

  function backToTemplateInputan(){
    $("#card-detail-periode").show(500)
    $("#atur-template-imputan-apd").hide(500)
  }

   //hide and show edit di form atur template Inputan APD
   function editTemplateInputanApd(Id,Filter){
    console.log("Id",Id)
    Livewire.emit('editTemplateInputanApd',[Id,Filter]);
    $("#atur-template-imputan-apd").hide(500)
    $("#edit-template-inputan-apd").show(500)
  }

  function backToEditTemplateInputanApd(){
    $("#atur-template-imputan-apd").show(500)
    $("#edit-template-inputan-apd").hide(500)
  }

  //hide and show tambah di form atur template Inputan APD
  function tambahTemplateInputanApd(Id,Filter){
    console.log("Id",Id)
    Livewire.emit('tambahTemplateInputanApd',[Id,Filter]);
    $("#atur-template-imputan-apd").hide(500)
    $("#tambah-template-inputan-apd").show(500)
  }

  function backToTambahTemplateInputanApd(){
    $("#atur-template-imputan-apd").show(500)
    $("#tambah-template-inputan-apd").hide(500)
  }

  //hide and show tambah jumlah besar di form atur template Inputan APD
  function tambahTemplateJumlahBesar(Id,Filter){
    console.log("Id",Id)
    Livewire.emit('tambahTemplateJumlahBesar',[Id,Filter]);
    $("#atur-template-imputan-apd").hide(500)
    $("#tambah-template-jumlah-besar").show(500)
  }

  function backToTambahTemplateJumlahBesar(){
    $("#atur-template-imputan-apd").show(500)
    $("#tambah-template-jumlah-besar").hide(500)
  }

//periode baru
  function periodeBaru(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    Livewire.emit('periodeBaru',[Id,Filter]);
    $("#form-periode-setting").hide(500)
    $("#card-detail-periode").collapse('show')
  }

  function backToPeriodeBaru(){
    $("#form-periode-setting").show(500)
    $("#card-detail-periode").collapse('hide')
  }

   //hide and show template inputan APD admin dinas
   function pengaturanBarang(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    Livewire.emit('pengaturanBarang',[Id,Filter]);
    $("#test-col").hide(500)
    $("#testcol").collapse('show')
  }

  function backToPengaturanBarang(){
    $("#test-col").show(500)
    $("#testcol").collapse('hide')
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

  //function untuk ukuran apd
  function rekapDetail1(Id,Filter){
    //alert("Tester") console.
    //alert(Filter)
    console.log("Id",Id)
    Livewire.emit('rekapDetail1',[Id,Filter]);
    $("#rekap-tabel1").hide(500)
    $("#rekapdetail1").collapse('show')
  }

  function backToRekap1(){
    $("#rekap-tabel1").show(500)
    $("#rekapdetail1").collapse('hide')
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
