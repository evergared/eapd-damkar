<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Home</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Admin Dinas</li>
          </ol>
        </div>
      </div>
    </div>
</section>
<section class="content">
      
    <div class="chart-dinas">
      <canvas id="chart-dinas" width="860" height="371" style="display: block; width: 660px; height: 371px;"></canvas>
    </div>
      
    <div class="row">
      
      
      {{-- <div class="col-md-6 dinas">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Kantor Dinas</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            
          </div>
          
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Tabel</h3>
                  </div>
                 
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Bidang</th>
                          <th>Inputan</th>
                          <th>Validasi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>06</td>
                          <td>Bidang Operasi</td>
                          <td class="project_progress">
                            <a href="#"><div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                </div>
                            </div></a>
                            <small>
                                57% Complete
                            </small>
                          </td>
                          <td class="project_progress">
                            <a href="#"><div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                </div>
                            </div></a>
                            <small>
                                57% Complete
                            </small>
                          </td>
                        </tr>
                        <tr>
                          <td>04</td>
                          <td>Bidang Kerjasama dan Informasi</td>
                          <td class="project_progress">
                            <a href="#"><div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                </div>
                            </div></a>
                            <small>
                                40% Complete
                            </small>
                          </td>
                          <td class="project_progress">
                            <a href="#"><div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                </div>
                            </div></a>
                            <small>
                                57% Complete
                            </small>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                  
                </div>
                
              </div>
            </div>
          </div>
          
        </div>
        
      </div> --}}

    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    $(function () {
    new Chart(document.getElementById("chart-dinas"), {
    type: 'pie',
    data: {
      labels: ["Kantor Dinas", "Pusdiklat", "Laboratorium", "Jakarta Pusat", "Jakarta Utara", "Jakarta Barat", "Jakarta Selatan", "Jakarta Timur"],
      datasets: [{
        label: "Total Inputan",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#5F9EA0","#A52A2A","#DEB887"],
        data: [1478,1267,734,784,433,533,133,333]
        }]
      },
    options: {
      title: {
        display: true,
        text: 'Chart Inputan'
        }
      }
    });
  })
</script>