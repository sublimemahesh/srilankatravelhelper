<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VISITOR = new Visitor($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Manage Questions || Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/datatables-responsive/dataTables.responsive.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="wrapper">
            <?php
            include './header.php';
            ?>
            <div class="content">
                <?php
                include './navigation.php';
                ?>
                <div class="col-md-9 col-sm-8">
                    <div class="top-bott20 m-l-25 m-r-15">
                        <?php
                        if (isset($_GET['message'])) {

                            $MESSAGE = New Message($_GET['message']);
                            ?>
                            <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                <?php echo $MESSAGE->description; ?>
                            </div>
                            <?php
                        }

                        $vali = new Validator();

                        $vali->show_message();
                        ?>
                    </div>
                    <div class="col-md-12 col-sm-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Manage Questions
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Subject</th>
                                                <th>Asked At</th>                               
                                                <th>Related Location</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Subject</th>
                                                <th>Asked At</th>                               
                                                <th>Related Location</th>
                                                <th>Option</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php
                                            $i = 0;
                                            foreach (BlogQuestion::getQuestionesByPosition('visitor', $VISITOR->id) as $key => $question) {
                                                
                                                $i++;
                                                ?>
                                                <tr id="row_<?php echo $question['id']; ?>">
                                                    <td><?php echo $i; ?></td> 
                                                    <td><?php echo $question['subject']; ?></td> 
                                                    <td><?php echo $question['askedAt']; ?></td>
                                                    <td><?php echo $question['location']; ?></td>
                                                    <td> 
                                                        <a href="edit-question.php?id=<?php echo $question['id']; ?>" class="op-link btn btn-sm btn-success" title="Edit Booking"><i class="glyphicon glyphicon-pencil"></i></a>  |  
                                                        <a href="#" class="delete-question btn btn-sm btn-danger" data-id="<?php echo $question['id']; ?>"  title="Delete Question">
                                                            <i class="waves-effect glyphicon glyphicon-trash" data-type="delete"></i>
                                                        </a>  
                                                        
                                                    </td>
                                                </tr>
                                                <?php
                                                
                                            }
                                            ?>   
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/jquery-datatable.js" type="text/javascript"></script>
        <script src="plugins/datatables-responsive/dataTables.responsive.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script src="delete/js/question.js" type="text/javascript"></script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                   var contentheight = $(window).height() + 100;
                    var navigationheight = $(window).height() + 25;

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } else {
                    var contentheight = $(window).height();
//                    $('.content').css('height', contentheight);
                }
            });
            $(document).ready(function () {
                var width = $(window).width();

                if (width < 576) {
                    setTimeout(function () {
                        $('.table').css('width', '228px');
                    }, 1000);
                }
            });
        </script>
    </body>
</html>