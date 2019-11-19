<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/dashboard.css" />
    <link rel="stylesheet" href="../../resources/css/apply-for-certificate.css" />
    <script src="../../resources/js/scrollreveal.js"></script>
  </head>
  <body>
    <section class="navigation-bar">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="brand navbar-brand">
                    <img src="../../resources/images/icons/registration.png" alt="..." width="50">
                    <a href="#" class="h3">Registration</a>
                </div>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Admin <span class="sr-only">(current)</span></a></li>
                    <li><a href="#" class="logout">Log out</a></li>
                    <li><a href="../Home/admin-dashboard.php" class="logout">Dashboard</a></li>
                </ul>
                </div>
            </div>
        </nav>
    </section>


    <section id="apply-certificate">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-div">
                                <form>
                                    <div class="form">
                                        <p class="color-1 text-uppercase p">* Edit Courses *</p>
                                        <div class="form-group">
                                                <label for="project-name">Project/Thesis Title</label>
                                                <input type="text" class="form-control" id="project-name" placeholder="Enter project/thesis title">
                                        </div>
                                        <div class="form-group">
                                                <label for="supervisor-name">Supervisor</label>
                                                <input type="text" class="form-control" id="supervisor-name" placeholder="Enter your project supervisor name">
                                        </div>
                                        <div class="form-group">
                                                <label for="supervisor-mobile">Mobile</label>
                                                <input type="number" class="form-control" id="supervisor-mobile" placeholder="Enter your project supervisor mobile no">
                                        </div>
                                    </div>
                                    <div class="table-responsive inside-table">
                                        <p class="p color-1 text-uppercase">* Important Documents *</p>
                                        <table class="table table-condensed table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <th>Documents</th>
                                            </tr>
                                            <tr>
                                                <td>S.S.C</td>
                                                <td>
                                                    <input type="file" name="S.S.C certificate">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>H.S.C</td>
                                                <td>
                                                    <input type="file" name="H.S.C certificate">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>B.S.C</td>
                                                <td>
                                                    <input type="file" name="B.S.C certificate">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NID / Birth Certificate</td>
                                                <td>
                                                    <input type="file" name="NID / Birth Certificate">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-success">NEXT</button>
                                    
                                </form>
                            </div>
                </div>
            </div>
        </div>
    </section>

    
    <script src="../../resources/js/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
  </body>
</html>
