<!DOCTYPE html>
<html lang="en">
  <head>
  @include('includes.head')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
      @include('includes.sidebar')
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
            @include('includes.headerlogo')
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          @include('includes.navbar')
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container" style="background-color: #29293d; min-height: 100vh; color: #fff;">
        <div class="page-inner">
            <!-- start page content wrapper-->
            <div class="page-content-wrapper">
              <!-- start page content-->
              <div class="page-content">
                @yield('content')
              </div>
              <!-- end page content-->
            </div>
        </div>


</div>
        <!-- Footer Start -->
        <footer class="footer" style="background-color: #343a40; color: #fff; padding: 5px 6;">
        @include('includes.footer')
        </footer>
        <!-- End Footer --> 
      </div>

      <!-- Submit Pertanyaan! -->
      <div class="custom-template">
        <div class="title">Submit Your Question</div>
        <div class="custom-content">
        <form action="{{ route('question.submit') }}" method="POST">
                @csrf
                
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" style="font-size: 16px;">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" style="font-size: 16px;">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <!-- Phone Number Field -->
                <div class="form-group">
                    <label for="phone" style="font-size: 16px;">Your Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

                <!-- Question Field -->
                <div class="form-group">
                    <label for="question" style="font-size: 16px;">Your Question</label>
                    <textarea id="question" name="question" class="form-control" rows="4" required></textarea>
                </div>

                <center><button type="submit" class="btn btn-primary" style="background-color: #ff8c00; padding: 12px 20px; border-radius: 5px; color: #fff;">Submit Question</button></center>
            </form>
          
          <div class="custom-toggle">
          <i class="fas fa-question-circle"></i>
          </div>
        </div>
      </div>
      <!-- End Submit Pertanyaan -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <!--<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> -->

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js')}}"></script>
    <script src="{{ asset('assets/js/demo.js')}}"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>

   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
   @stack('styles')
   @stack('scripts')
  </body>
</html>
