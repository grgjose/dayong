
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('admin_lte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin_lte/dist/js/adminlte.js')}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset('admin_lte/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{asset('admin_lte/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('admin_lte/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin_lte/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin_lte/dist/js/pages/dashboard2.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin_lte/plugins/datatables/jquery.dataTables.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/jszip/jszip.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/pdfmake/pdfmake.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/pdfmake/vfs_fonts.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.html5.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.print.min.js'); }}"></script>
    <script src="{{ asset('admin_lte/plugins/datatables-buttons/js/buttons.colVis.min.js'); }}"></script>

    <!-- Chosen (For Select Multiple UI) -->
    <script src="{{ asset('admin_lte/chosen/chosen.jquery.js'); }}"></script>
    <script src="{{ asset('admin_lte/chosen/chosen.jquery.min.js'); }}"></script>

    <!-- Toast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Custom Scripts -->
    <script src="{{asset('admin_lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script> $(function () { bsCustomFileInput.init(); }); </script>

    <script src="{{asset('js/importfiles.js')}}"></script>
    <script src="{{asset('js/excelfiles.js')}}"></script>


    <script>

      $(document).ready(function (){
      
        $(".chosen-select").chosen({
          no_results_text: "Oops, nothing found!",
          width: "100%"
        });

        $('#normalTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#normalTable .col-md-6:eq(0)');

        $('#anotherNormalTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#normalTable .col-md-6:eq(0)');



      });

      // Active Navbar UI
      $(document).ready(function(){
        var pathname = window.location.pathname;
        pathname = pathname.substring(1, pathname.length);
        
        $("a[href='/"+ pathname +"']").parent().addClass(" menu-open");
        $("a[href='/"+ pathname +"']").addClass(" active");

        switch(pathname){
          case "branch":
          case "program":
          case "user-accounts":
          case "matrix":
          case "excel-collection":
          case "excel-new-sales":
            $("a[href='/"+ pathname +"']").parent().parent().parent().addClass("menu-is-opening");
            $("a[href='/"+ pathname +"']").parent().parent().parent().addClass("menu-open");
            $("a[href='/"+ pathname +"']").attr("style", "width: 93%;")
            break;
        }



        $(".wrapper").removeAttr("style");
      });

    </script>

    <script>

      $("#store_password").on("keyup", function(){
        checkPassword();
      });

      $("#store_confirm_password").on("keyup", function(){
        checkPassword();
      });

      $("#store_password").click(function(){
        checkPassword();
      });

      $("#store_confirm_password").click(function(){
        checkPassword();
      });

      function checkPassword(){
            var x = $("#store_password").val();
            var y = $("#store_confirm_password").val();
            if(x != y){
              $("#store_btn").attr("disabled", true);
              $("#pass_ok").attr("style", "display: none; color: #90EE90;");
              $("#pass_ng").attr("style", "color: #FF474C;");
            } else {
              $("#store_btn").removeAttr("disabled");
              $("#pass_ok").attr("style", "color: #90EE90;");
              $("#pass_ng").attr("style", "display: none; color: #FF474C;");
            }
      }

      $("#edit_store_password").on("keyup", function(){
        checkPasswordEdit();
      });

      $("#edit_store_confirm_password").on("keyup", function(){
        checkPasswordEdit();
      });

      $("#edit_store_password").click(function(){
        checkPasswordEdit();
      });

      $("#edit_store_confirm_password").click(function(){
        checkPasswordEdit();
      });

      function checkPasswordEdit(){
            var x = $("#edit_store_password").val();
            var y = $("#edit_store_confirm_password").val();
            if(x != y){
              $("#edit_store_btn").attr("disabled", true);
              $("#edit_pass_ok").attr("style", "display: none; color: #90EE90;");
              $("#edit_pass_ng").attr("style", "color: #FF474C;");
            } else {
              $("#edit_store_btn").removeAttr("disabled");
              $("#edit_pass_ok").attr("style", "color: #90EE90;");
              $("#edit_pass_ng").attr("style", "display: none; color: #FF474C;");
            }
      }

    </script>

    <script>
      
      (async () => {

      const topology = await fetch(
          'https://code.highcharts.com/mapdata/countries/ph/ph-all.topo.json'
      ).then(response => response.json());

      // Prepare demo data. The data is joined to map using value of 'hc-key'
      // property by default. See API docs for 'joinBy' for more info on linking
      // data and map.
      const data = [
          ['ph-mn', 10], ['ph-4218', 11], ['ph-tt', 12], ['ph-bo', 13],
          ['ph-cb', 14], ['ph-bs', 15], ['ph-2603', 16], ['ph-su', 17],
          ['ph-aq', 18], ['ph-pl', 19], ['ph-ro', 20], ['ph-al', 21],
          ['ph-cs', 22], ['ph-6999', 23], ['ph-bn', 24], ['ph-cg', 25],
          ['ph-pn', 26], ['ph-bt', 27], ['ph-mc', 28], ['ph-qz', 29],
          ['ph-es', 30], ['ph-le', 31], ['ph-sm', 32], ['ph-ns', 33],
          ['ph-cm', 34], ['ph-di', 35], ['ph-ds', 36], ['ph-6457', 37],
          ['ph-6985', 38], ['ph-ii', 39], ['ph-7017', 40], ['ph-7021', 41],
          ['ph-lg', 42], ['ph-ri', 43], ['ph-ln', 44], ['ph-6991', 45],
          ['ph-ls', 46], ['ph-nc', 47], ['ph-mg', 48], ['ph-sk', 49],
          ['ph-sc', 50], ['ph-sg', 51], ['ph-an', 52], ['ph-ss', 53],
          ['ph-as', 54], ['ph-do', 55], ['ph-dv', 56], ['ph-bk', 57],
          ['ph-cl', 58], ['ph-6983', 59], ['ph-6984', 60], ['ph-6987', 61],
          ['ph-6986', 62], ['ph-6988', 63], ['ph-6989', 64], ['ph-6990', 65],
          ['ph-6992', 66], ['ph-6995', 67], ['ph-6996', 68], ['ph-6997', 69],
          ['ph-6998', 70], ['ph-nv', 71], ['ph-7020', 72], ['ph-7018', 73],
          ['ph-7022', 74], ['ph-1852', 75], ['ph-7000', 76], ['ph-7001', 77],
          ['ph-7002', 78], ['ph-7003', 79], ['ph-7004', 80], ['ph-7006', 81],
          ['ph-7007', 82], ['ph-7008', 83], ['ph-7009', 84], ['ph-7010', 85],
          ['ph-7011', 86], ['ph-7012', 87], ['ph-7013', 88], ['ph-7014', 89],
          ['ph-7015', 90], ['ph-7016', 91], ['ph-7019', 92], ['ph-6456', 93],
          ['ph-zs', 94], ['ph-nd', 95], ['ph-zn', 96], ['ph-md', 97],
          ['ph-ab', 98], ['ph-2658', 99], ['ph-ap', 100], ['ph-au', 101],
          ['ph-ib', 102], ['ph-if', 103], ['ph-mt', 104], ['ph-qr', 105],
          ['ph-ne', 106], ['ph-pm', 107], ['ph-ba', 108], ['ph-bg', 109],
          ['ph-zm', 110], ['ph-cv', 111], ['ph-bu', 112], ['ph-mr', 113],
          ['ph-sq', 114], ['ph-gu', 115], ['ph-ct', 116], ['ph-mb', 117],
          ['ph-mq', 118], ['ph-bi', 119], ['ph-sl', 120], ['ph-nr', 121],
          ['ph-ak', 122], ['ph-cp', 123], ['ph-cn', 124], ['ph-sr', 125],
          ['ph-in', [126]], ['ph-is', 127], ['ph-tr', 128], ['ph-lu', 129]
      ];

      // Create the chart
      Highcharts.mapChart('container3', {
          chart: {
              map: topology
          },

          title: {
              text: 'Philippine Map'
          },

          subtitle: {
              text: 'Source map: <a href="https://code.highcharts.com/mapdata/countries/ph/ph-all.topo.json">Philippines</a>'
          },

          mapNavigation: {
              enabled: true,
              buttonOptions: {
                  verticalAlign: 'bottom'
              }
          },

          colorAxis: {
              min: 0
          },

          series: [{
              data: data,
              name: 'Branches',
              states: {
                  hover: {
                      color: '#BADA55'
                  }
              },
              dataLabels: {
                  enabled: true,
                  format: '{point.name.age}'
              }
          }]
      });

      })();
    </script>

    @if(session()->has('error_msg'))
      <script>
          toastr.options.preventDuplicates = true;
          toastr.error("{{ session('error_msg') }}");
      </script>
    @endif

    @error('code')
      <script>
        toastr.options.preventDuplicates = true;
        toastr.error('Code already exists');
      </script>
    @enderror

    @if(session()->has('success_msg'))
      <script>
          toastr.options.preventDuplicates = true;
          toastr.success("{{ session('success_msg') }}");
      </script>
    @endif

    @if(session()->has('download_file'))
      <script>
          $("#download_filename").val("{{ session('download_file') }}");
          $("#downloadForm").submit();
      </script>
    @endif

    <script>
      function showErrorToast(val){
        toastr.options.preventDuplicates = true;
        toastr.error(val);
      }
    </script>

    <script>
      function toggleNewSales() {
          if ($('#add_new_sales').is(':checked')) {
              $('.newsales').slideDown();
          } else {
              $('.newsales').slideUp();
          }
      }
    </script>

    <script>
        let beneficiaryCount = 1;

        $(document).ready(function () {
            $('.beneficiaries').hide();
            beneficiaryCount = 1;
        });

        function addBeneficiary() {
            let $last = $('.beneficiaries').last();
            let $clone = $last.clone();

            beneficiaryCount++;

            // Update legend
            $clone.find('legend').text('Beneficiaries #' + (beneficiaryCount - 1));

            // Update inputs
            $clone.find('input, select').each(function () {
                let name = $(this).attr('name');
                let id = $(this).attr('id');

                if (name) {
                    $(this).attr('name', name.replace(/\d+$/, beneficiaryCount));
                }

                if (id) {
                    $(this).attr('id', id.replace(/\d+$/, beneficiaryCount));
                }

                $(this).val('');
            });

            $clone.insertAfter($last).slideDown();
            updateRemoveButtons();
        }

        function removeThisBeneficiary(btn) {
            if ($('.beneficiaries').length <= 1) {
                alert('At least one beneficiary is required.');
                return;
            }

            $(btn).closest('.beneficiaries').slideUp(function () {
                $(this).remove();
                renumberBeneficiaries();
            });
        }

        function renumberBeneficiaries() {
          beneficiaryCount = 0;

          $('.beneficiaries').each(function () {
            beneficiaryCount++;

            $(this).find('legend').text('Beneficiaries #' + (beneficiaryCount - 1));

            $(this).find('input, select').each(function () {
                let name = $(this).attr('name');
                let id = $(this).attr('id');

                if (name) {
                    $(this).attr('name', name.replace(/\d+$/, beneficiaryCount - 1));
                }

                if (id) {
                    $(this).attr('id', id.replace(/\d+$/, beneficiaryCount - 1));
                }
            });
          });

          updateRemoveButtons();
        }

        function updateRemoveButtons() {
            if ($('.beneficiaries').length <= 1) {
                $('.beneficiary-remove-btn').hide();
            } else {
                $('.beneficiary-remove-btn').show();
            }
        }
    </script>

<!-- Custom scripts -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

      const loginWrapper = document.querySelector(".login-wrapper");
      const forgotWrapper = document.querySelector(".forgot-password-wrapper");
      const registerWrapper = document.querySelector(".register-wrapper");

      function showOnly(wrapper) {
        loginWrapper.style.display = "none";
        forgotWrapper.style.display = "none";
        registerWrapper.style.display = "none";
        wrapper.style.display = "block";
      }

      // Forgot password links
      document.querySelectorAll(".forgot-password-link").forEach(link => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          showOnly(forgotWrapper);
        });
      });

      // Register links
      document.querySelectorAll(".login-wrapper-footer-text a").forEach(link => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          showOnly(registerWrapper);
        });
      });

      document.querySelectorAll(".back-to-login").forEach(link => {
          link.addEventListener("click", function (e) {
              e.preventDefault();
              showOnly(loginWrapper);
          });
      });

    });
</script>
