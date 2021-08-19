<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary ">
            <div class="row mt-2">
                <div class="col text-center">
                    <h1 class="text-light">LOGO</h1>
                </div>
            </div>

            <!-- Sidebar - Brand -->
            <table class="m-3">
                <tr>
                    <?php
                    $page_button = 1;
                    for ($i = 1; $i <= 50; $i++) : ?>
                        <td style='text-align: center;'>
                            <button class='jump btn btn-block btn-outline-light' id='button_$page_button' name='$page_button' type='button'>
                                <?= $page_button ?>
                            </button>
                        </td>
                    <?php
                        if ($page_button % 5 == 0) {
                            echo "</tr>";
                            echo "<tr>";
                        }
                        $page_button++;
                    endfor ?>
                </tr>
            </table>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <ul class="ml-auto mr-2 mt-auto">
                        <h1>
                            10:10:10s
                        </h1>
                    </ul>

                </nav>
                <!-- End of Topbar -->