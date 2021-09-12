<!DOCTYPE html>
<html lang="en">

<head>
    @include('livewire.admin.container.head')
    @include('livewire.admin.container.script')
</head>

<body id="page-top">
    <noscript>Trang web của bạn không hỗ trợ JavaScript</noscript>
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('livewire.admin.container.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('livewire.admin.container.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    {{ $slot  }}
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('livewire.admin.container.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        // Toggle the side navigation
        $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            if ($(".sidebar").hasClass("toggled")) {
                $('.sidebar .collapse').collapse('hide');
            };
        });
    </script>
</body>

</html>