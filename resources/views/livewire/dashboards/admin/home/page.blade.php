 <div>
  @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Dashboard','halaman'=>'admin-dashboard'])
  <livewire:komponen.marquee>
  <section class="content">
    <div class="container-fluid">

      <div wire:loading='fetchJumlahInputan'>
        <div class="spinner-border spinner-border-sm text-info" role="status"></div>
        <small class="text-info"> Memuat data rangkuman dari server . . .</small>
      </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Progress Inputan Saat Ini</h3>
                </div>
                <div class="card-body">
                  <div class="position-relative">
                    <div id="spinner-chart" style="display: none">
                      <div class="spinner-border spinner-border-lg text-info" role="status"></div>
                      <span class="text-info"> Menyiapkan chart . . .</span>
                    </div>
                    @if ($tipe_admin == "Admin Dinas")
                      <canvas id="chart-dinas" style="display: none" style=" max-width: 1200px; height: 371px;"></canvas>
                    @elseif($tipe_admin == "Admin Sudin")
                    @else
                    @endif
                  </div>
                  <ul id="chart-load-list">
                  </ul>
                  <ul id="chart-error-list">
                  </ul>
                </div>
              </div>
            </div>
          </div>
            
            
        
    </div>

  </section>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
  <script>

    let tipe_admin = null

    window.addEventListener('load', function(){
      Livewire.emit('mulaiKalkulasi')
    })

    window.addEventListener('JSWorkerCall-dashboard', e=>{
      let data = e.detail.data.original
      if(data.status)
      {
        tipe_admin = e.detail.tipe
        switch(tipe_admin)
        {
          case 'Admin Dinas': prepareKalkulasiDinas(data); break;
          default : break;
        }
      }
    })

   function isiVariable(target_variable, value)
   {
      switch(target_variable)
      {
        case 'dinas_kantor': dinas_kantor = value; break;
        case 'dinas_pusdik': dinas_pusdik = value; break;
        case 'dinas_lab': dinas_lab = value; break;
        case 'dinas_ju': dinas_ju = value; break;
        case 'dinas_jp': dinas_jp = value; break;
        case 'dinas_jb': dinas_jb = value; break;
        case 'dinas_js': dinas_js = value; break;
        case 'dinas_jt': dinas_jt = value; break;
        default : break;
      }
   }

    function mulaiKalkulasi(worker, target_variable, id_elemen, text, e, parameter, target)
    {
      if(typeof(worker) !== "undefined")
      {
        if(typeof(worker) != "undefined")
        {
          worker.postMessage({'data' : e, 'parameter' : parameter, 'target' : target})

          let li = document.createElement('li')
          li.setAttribute('id',id_elemen+'-loading')
          li.innerHTML = '<small class="text-info">Kalkulasi capaian <strong id="'+id_elemen+'-loading-text">'+text+'</strong><span id="'+id_elemen+'-loading-status"></span></small>'
          document.getElementById('chart-load-list').appendChild(li)
          document.getElementById('spinner-chart').display = ''

          worker.addEventListener('message',e=>{
            switch(e.data.status){
                            case 'process' : prosesKalkulasi(id_elemen,e);break;
                            case 'fail' : gagalkanKalkulasi(id_elemen, worker,text);break;
                            case 'success' : terimaKalkulasi(e, id_elemen, target_variable, worker);break;
                            default : break;
                        }
          })

        }
      }
      else
      {
        alert('Gagal dalam menampilkan chart! Silahkan update browser anda ke versi terbaru')
      }
    }

    function stopKalkulasi(worker)
    {
      worker.terminate();
      worker = undefined;
    }

    function prosesKalkulasi(id_elemen, e)
    {
      document.getElementById(id_elemen+'-loading-status').innerHTML = e.data.message
    }

    function gagalkanKalkulasi(id_elemen, worker, text)
    {
      let p1 = document.getElementById('chart-load-list')
      let p2 = document.getElementById('chart-error-list')
      let li1 = document.getElementById(id_elemen+'-loading')
      let li2 = document.createElement('li')

      li2.setAttribute('id',id_elemen+'-error')
      li2.innerHTML = '<small class="text-danger">Terjadi kesalahan saat kalkulasi capaian <strong>'+text+'</strong></small>'
      p1.removeChild(li1)
      p2.appendChild(li2)

      stopKalkulasi(worker)
    }

    function terimaKalkulasi(e, id_elemen, target_variable, worker)
    {
      let p1 = document.getElementById('chart-load-list')
      let li1 = document.getElementById(id_elemen+'-loading')
      p1.removeChild(li1)
      stopKalkulasi(worker)
      isiVariable(target_variable, e.data)
      kalkulasiSelesai()
    }

    function kalkulasiSelesai()
    {
      switch(tipe_admin)
        {
          case 'Admin Dinas': cekChartDinas(); break;
          default : break;
        }
    }

    let dinas_kantor = null
    let dinas_pusdik = null
    let dinas_lab = null
    let dinas_ju = null
    let dinas_jp = null
    let dinas_jb = null
    let dinas_js = null
    let dinas_jt = null

    let worker_dinas_kantor
    let worker_dinas_pusdik
    let worker_dinas_lab
    let worker_dinas_ju
    let worker_dinas_jp
    let worker_dinas_jb
    let worker_dinas_js
    let worker_dinas_jt

    function cekChartDinas(){
      if(
        dinas_kantor !== null &&
        dinas_pusdik !== null &&
        dinas_lab !== null &&
        dinas_ju !== null &&
        dinas_jp !== null &&
        dinas_jb !== null &&
        dinas_js !== null &&
        dinas_jt !== null
      )
      inisiasiChartDinas()
    }

    function prepareKalkulasiDinas(e){

      worker_dinas_kantor = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_pusdik = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_lab = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_ju = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_jp = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_jb = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_js = new Worker("{{asset('worker/progress-home.js')}}")
      worker_dinas_jt = new Worker("{{asset('worker/progress-home.js')}}")

      mulaiKalkulasi(worker_dinas_kantor, 'dinas_kantor','list-dinas-kantor', 'Kantor Dinas',e,'wilayah','0')
      mulaiKalkulasi(worker_dinas_pusdik, 'dinas_pusdik','list-dinas-pusdik', 'Pusdiklatkar',e,'wilayah','7')
      mulaiKalkulasi(worker_dinas_lab, 'dinas_lab','list-dinas-lab', 'Laboratorium',e,'wilayah','8')
      mulaiKalkulasi(worker_dinas_ju, 'dinas_ju','list-dinas-ju', 'Wilayah Jakarta Utara',e,'wilayah','2')
      mulaiKalkulasi(worker_dinas_jp, 'dinas_jp','list-dinas-jp', 'Wilayah Jakarta Pusat',e,'wilayah','1')
      mulaiKalkulasi(worker_dinas_jb, 'dinas_jb','list-dinas-jb', 'Wilayah Jakarta Barat',e,'wilayah','3')
      mulaiKalkulasi(worker_dinas_js, 'dinas_js','list-dinas-js', 'Wilayah Jakarta Selatan',e,'wilayah','4')
      mulaiKalkulasi(worker_dinas_jt, 'dinas_jt','list-dinas-jt', 'Wilayah Jakarta Timur',e,'wilayah','5')

    }

    function inisiasiChartDinas(){
      document.getElementById('spinner-chart').style.display = 'none'
      document.getElementById('chart-dinas').style.display = ''
      const chart = new Chart(document.getElementById("chart-dinas"), {
      type: 'bar',
      data: {
        labels: [
          'Kantor Dinas',
          'Pusdiklatkar',
          'Laboratorium',
          'Jakarta Utara',
          'Jakarta Pusat',
          'Jakarta Barat',
          'Jakarta Selatan',
          'Jakarta Timur',
        ],
        datasets: [{
          label: "Terinput",
          backgroundColor:
            'rgba(75, 192, 192)',
          data: [
            dinas_kantor.inputan,
            dinas_pusdik.inputan,
            dinas_lab.inputan,
            dinas_ju.inputan,
            dinas_jp.inputan,
            dinas_jb.inputan,
            dinas_js.inputan,
            dinas_jt.inputan
          ]
          },
          {
          label: "Tervalidasi",
          backgroundColor:
            'rgba(54, 162, 235)',
          data: [
            dinas_kantor.validasi,
            dinas_pusdik.validasi,
            dinas_lab.validasi,
            dinas_ju.validasi,
            dinas_jp.validasi,
            dinas_jb.validasi,
            dinas_js.validasi,
            dinas_jt.validasi
          ]
          }]
        },
      options: {
        title: {
          display: true,
          text: 'Capaian Persentase Input dan Validasi Data APD Pemadam DKI Jakarta'
          },
          scales : {
            yAxis : {
              ticks : {
                callback : function(value){
                  return value + '%';
                }
              }
            }
          }
        }
      });

      
    }
  

  </script>
</div>
