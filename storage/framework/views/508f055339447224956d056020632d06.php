  <!-- Footer -->

            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>
                    COPYRIGHT ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    CloudTechtiq, All rights Reserved.
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <!-- <a href="" class="footer-link me-4"
                      >License</a
                    >
                    <a href=""  class="footer-link me-4"
                      >More Themes</a
                    >

                    <a
                      href=""

                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a href=""  class="footer-link d-none d-sm-inline-block"
                      >Support</a
                    > -->
                  </div>
                </div>
              </div>
            </footer>

            <?php
      $monthlyData = DB::table('orders')->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
        ->groupBy(DB::raw('MONTH(created_at)'))->get();
$monthlySumArray = [];

foreach ($monthlyData as $key => $data) {
  $monthlySumArray[] = $data->total;
}
$stringArray = '[' . implode(', ', $monthlySumArray) . ']';




 $completeEfficiency = DB::table('goals')->where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');
        $inProgressEfficiency = DB::table('goals')->where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
$totalEfficiency = $completeEfficiency+$inProgressEfficiency;
            ?>
  <!-- / Footer -->

<!--tostr-->

<!--/tostr-->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?php echo e(url('public/assets/vendor/libs/jquery/jquery.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/node-waves/node-waves.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/hammer/hammer.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/i18n/i18n.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/typeahead-js/typeahead.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/js/menu.js')); ?>"></script>
    <!-- Vendors JS -->

    <script src="<?php echo e(url('public/assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

    <script src="<?php echo e(url('public/assets/vendor/libs/swiper/swiper.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/sweetalert2/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/block-ui/block-ui.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/quill/katex.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/quill/quill.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/autosize/autosize.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/jquery-repeater/jquery-repeater.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/bs-stepper/bs-stepper.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/fullcalendar/fullcalendar.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/pickr/pickr.js')); ?>"></script>


    <!-- Main JS -->
    <script src="<?php echo e(url('public/assets/js/main.js')); ?>"></script>
    <!-- <script src="<?php echo e(url('public/assets/js/app-ecommerce-dashboard.js')); ?>"></script> -->
    <script src="<?php echo e(url('public/assets/vendor/libs/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/select2/select2.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/cleavejs/cleave.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/cleavejs/cleave-phone.js')); ?>"></script>

    <script src="<?php echo e(url('public/assets/vendor/libs/chartjs/chartjs.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/vendor/libs/toastr/toastr.js')); ?>"></script>
    <!-- Page JS -->
    <script src="<?php echo e(url('public/assets/js/dashboards-analytics.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/app-user-list.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/forms-file-upload.js')); ?>"></script>
   
    <script src="<?php echo e(url('public/assets/js/modal-edit-user.js')); ?>"></script>
    <!-- <script src="<?php echo e(url('public/assets/js/app-user-view.js')); ?>"></script> -->
    <script src="<?php echo e(url('public/assets/js/app-user-view-account.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/app-user-view-security.js')); ?>"></script>
  
    <script src="<?php echo e(url('public/assets/js/ui-toasts.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/extended-ui-blockui.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/forms-editors.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/forms-extras.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/form-wizard-numbered.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/form-wizard-validation.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/app-email.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/forms-pickers.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/js/ui-carousel.js')); ?>"></script>

    <script src="<?php echo e(url('public/assets/js/charts-chartjs.js')); ?>"></script>
    
    <script src="<?php echo e(url('public/assets/js/employee-calendar.js')); ?>"></script>
 

    <script>
      $.fn.dataTable.ext.errMode = 'throw';
    </script>
    <script src="<?php echo e(url('public/assets/js/app-chat.js')); ?>"></script>
     <script src="<?php echo e(url('public/assets/js/wizard-ex-checkout.js')); ?>"></script>

<script>


  (function () {

    let cardColor, labelColor, headingColor, borderColor, legendColor;

    if (isDarkStyle) {
     cardColor = config.colors_dark.cardColor;
     labelColor = config.colors_dark.textMuted;
     legendColor = config.colors_dark.bodyColor;
     headingColor = config.colors_dark.headingColor;
     borderColor = config.colors_dark.borderColor;
  } else {
     cardColor = config.colors.cardColor;
     labelColor = config.colors.textMuted;
     legendColor = config.colors.bodyColor;
     headingColor = config.colors.headingColor;
     borderColor = config.colors.borderColor;
  }

  // Donut Chart Colors
  const chartColors = {
     donut: {
      series1: config.colors.success,
      series2: '#28c76fb3',
      series3: '#28c76f80',
      series4: config.colors_label.success
   }
};

  // Profit last month Line Chart
  // --------------------------------------------------------------------
const profitLastMonthEl = document.querySelector('#profitLastMonth'),
profitLastMonthConfig = {
   chart: {
    height: 90,
    type: 'line',
    parentHeightOffset: 0,
    toolbar: {
     show: false
  }
},
grid: {
 borderColor: borderColor,
 strokeDashArray: 6,
 xaxis: {
  lines: {
   show: true,
   colors: '#000'
}
},
yaxis: {
  lines: {
   show: false
}
},
padding: {
  top: -18,
  left: -4,
  right: 7,
  bottom: -10
}
},
colors: [config.colors.info],
stroke: {
 width: 2
},
series: [
{
  data: <?php echo e($stringArray); ?>

}
],
tooltip: {
 shared: false,
 intersect: true,
 x: {
  show: false
}
},
xaxis: {
 labels: {
  show: false
},
axisTicks: {
  show: false
},
axisBorder: {
  show: false
}
},
yaxis: {
 labels: {
  show: false
}
},
tooltip: {
 enabled: false
},
markers: {
 size: 3.5,
 fillColor: config.colors.info,
 strokeColors: 'transparent',
 strokeWidth: 3.2,
 discrete: [
 {
   seriesIndex: 0,
   dataPointIndex: 5,
   fillColor: cardColor,
   strokeColor: config.colors.info,
   size: 5,
   shape: 'circle'
}
],
 hover: {
  size: 5.5
}
},
responsive: [
{
  breakpoint: 1442,
  options: {
   chart: {
    height: 100
 }
}
},
{
  breakpoint: 1025,
  options: {
   chart: {
    height: 86
 }
}
},
{
  breakpoint: 769,
  options: {
   chart: {
    height: 93
 }
}
}
]
}

if (typeof profitLastMonthEl !== undefined && profitLastMonthEl !== null) {
  const profitLastMonth = new ApexCharts(profitLastMonthEl, profitLastMonthConfig);
  profitLastMonth.render();
}
// Generated Leads Chart
  // --------------------------------------------------------------------
const generatedLeadsChartEl = document.querySelector('#generatedLeadsChart'),
generatedLeadsChartConfig = {
   chart: {
    height: 147,
    width: 130,
    parentHeightOffset: 0,
    type: 'donut'
 },
 labels: ['Completed', 'Incomplete'],
 series: [<?php echo e($completeEfficiency); ?>,<?php echo e($inProgressEfficiency); ?>],
 colors: [
    chartColors.donut.series1,
    chartColors.donut.series2,
    ],
 stroke: {
    width: 0
 },
 dataLabels: {
    enabled: false,
    formatter: function (val, opt) {
     return parseInt(val) + '%';
  }
},
legend: {
 show: false
},
tooltip: {
 theme: false
},
grid: {
 padding: {
  top: 15,
  right: -20,
  left: -20
}
},
states: {
 hover: {
  filter: {
   type: 'none'
}
}
},
plotOptions: {
 pie: {
  donut: {
   size: '70%',
   labels: {
    show: true,
    value: {
     fontSize: '1.375rem',
     fontFamily: 'Public Sans',
     color: headingColor,
     fontWeight: 500,
     offsetY: -15,
     formatter: function (val) {
      return parseInt(val) + '%';
   }
},
name: {
  offsetY: 20,
  fontFamily: 'Public Sans'
},
total: {
  show: true,
  showAlways: true,
  color: config.colors.success,
  fontSize: '.8125rem',
  label: 'Total',
  fontFamily: 'Public Sans',
  formatter: function (w) {
   return "<?php echo e($totalEfficiency); ?>";
}
}
}
}
}
},
responsive: [
{
  breakpoint: 1025,
  options: {
   chart: {
    height: 172,
    width: 160
 }
}
},
{
  breakpoint: 769,
  options: {
   chart: {
    height: 178
 }
}
},
{
  breakpoint: 426,
  options: {
   chart: {
    height: 147
 }
}
}
]
};
if (typeof generatedLeadsChartEl !== undefined && generatedLeadsChartEl !== null) {
  const generatedLeadsChart = new ApexCharts(generatedLeadsChartEl, generatedLeadsChartConfig);
  generatedLeadsChart.render();
}
})();
</script>

<script>
    $(document).ready(function() {
      $('.alert-success').fadeOut(5000);
      $('.alert-danger').fadeOut(5000);
    });
  </script>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/insighthub_db/resources/views/includes/footer.blade.php ENDPATH**/ ?>