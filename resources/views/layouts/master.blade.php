<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
<div id="sb-site">
    <div id="loading">
        <div class="svg-icon-loader"><img src="{{URL::to('assets/images/svg-loaders/bars.svg')}}" width="40" alt=""></div>
    </div>
    <div id="page-wrapper">
        <div id="mobile-navigation">
            <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span>
            </button>
        </div>

        @include('partials.sidebar')

        <div id="page-content-wrapper">
            <div id="page-content">
                @include('partials.navbar')
                @yield('content')
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::to('assets/widgets/parsley/parsley.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/dropdown/dropdown.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/tooltip/tooltip.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/popover/popover.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/progressbar/progressbar.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/button/button.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/collapse/collapse.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/superclick/superclick.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/input-switch/inputswitch-alt.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/slimscroll/slimscroll.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/slidebars/slidebars.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/slidebars/slidebars-demo.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/charts/piegage/piegage.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/charts/piegage/piegage-demo.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/screenfull/screenfull.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/content-box/contentbox.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/material/material.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/material/ripples.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/overlay/overlay.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/js-init/widgets-init.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/themes/admin/layout.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/datatable/datatable.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/datatable/datatable-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/widgets/datatable/datatable-tabletools.js')}}"></script>
    <script type="text/javascript">/* Datatables basic */

        $(document).ready(function () {
            $('#datatable-example').dataTable();
        });

        /* Datatables hide columns */

        $(document).ready(function () {
            var table = $('#datatable-hide-columns').DataTable({
                "scrollY": "300px",
                "paging": false
            });

            $('#datatable-hide-columns_filter').hide();

            $('a.toggle-vis').on('click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
            });
        });

        /* Datatable row highlight */

        $(document).ready(function () {
            var table = $('#datatable-row-highlight').DataTable();

            $('#datatable-row-highlight tbody').on('click', 'tr', function () {
                $(this).toggleClass('tr-selected');
            });
        });


        $(document).ready(function () {
            $('.dataTables_filter input').attr("placeholder", "Search...");
        });</script>
</div>
</body>
</html>
