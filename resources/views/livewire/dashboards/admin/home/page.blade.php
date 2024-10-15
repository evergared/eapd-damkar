<div>
  @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Dashboard','halaman'=>'admin-dashboard'])
  <livewire:komponen.marquee>
  <section class="content">
      
    

    @if ($tipe_admin == "Admin Dinas")
      <div class="chart-dinas">
        <canvas id="chart-dinas" width="860" height="371" style="display: block; width: 660px; height: 371px;"></canvas>
      </div>
    @elseif($tipe_admin == "Admin Sudin")
        
    @else
        
    @endif
  </section>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
  <script>

  $(function () {
  new Chart(document.getElementById("chart-dinas"), {
      type: 'bar',
      data: {
        labels: [
          'Jakarta Utara',
          'Jakarta Pusat',
          'Jakarta Barat',
          'Jakarta Selatan',
          'Jakarta Timur',
        ],
        datasets: [{
          label: "Total Inputan",
          backgroundColor:[
            'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)'
          ] ,
          data: [
            65, 59, 80, 81, 56
          ]
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
</div>
