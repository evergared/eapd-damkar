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
      
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>

$(function () {
  new Chart(document.getElementById("chart-dinas"), {
      type: 'pie',
      data: {
        labels: [
          @php
            foreach($chart_labels as $i => $c)
            {
                echo "'" . $c . "'";
                if($i !== array_key_last($chart_labels))
                echo ',';
            }
          @endphp
        ],
        datasets: [{
          label: "Total Inputan",
          backgroundColor:[
            @php
              foreach($chart_warna as $i => $c)
              {
                  echo "'" . $c . "'";
                  if($i !== array_key_last($chart_warna))
                  echo ',';
              }
            @endphp
          ] ,
          data: [
            @php
              foreach($chart_data as $i => $c)
              {
                  echo "'" . $c . "'";
                  if($i !== array_key_last($chart_data))
                  echo ',';
              }
            @endphp
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