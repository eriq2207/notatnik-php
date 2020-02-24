<?php
  session_start();
  require_once(__DIR__.'/../config.php');
  require_once(__DIR__.'/../urls.php');
  if(!isset($_SESSION['notepad_user']))
    header("Location:".$login);
  else
  {
    $user = $_SESSION['notepad_user'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Twój osobisty notatnik</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <link rel="manifest" href="/manifest.json">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./notes_public.php" class="brand-link">
		<img src="./img/notepad.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Twój osobisty notatnik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	  <div class="image">
		<img src="./img/user.png" class="img-circle elevation-2" alt="User Image">
	  </div>
        <div class="info">
			<a href="./notes_public.php">
				  <span style="color:white;"><?php echo $user?></span>
             </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Twoje notatki
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./notes_new.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>Utwórz nową</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./notes_public.php" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Publiczne</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./notes_private.php" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>Prywatne</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a href="/..<?php echo $settings_url;?>" class="nav-link">
              <i class="nav-icon fa fa-fw fa-cog"></i>
              <p>
                Ustawienia
              </p>
            </a>
          </li>
		  <li class="nav-item">
             <a href="/../<?php echo $logout_req_handler_url;?>" class="nav-link">
              <i class="nav-icon fa fa-fw fa-arrow-circle-left"></i>
              <p>
                Wyloguj się
              </p>
            </a>
          </li>

          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Twoje prywatne notatki</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <?php
            $connection = @new mysqli($db_host, $db_login, $db_password, $db_name);
            if ($connection->connect_errno != 0) {
              echo "Error: ". $connection->connect_errno;
            } else {
              $user_id = $_SESSION['user_id'];
              $query = "SELECT * FROM notes WHERE user_id='$user_id' AND private='1';";
              if($res = @$connection->query($query))
              {
                 while($row = $res->fetch_assoc())
                 {
                    echo '<div class="card">
                            <div class="card-header">
                              <h3 class="card-title">'.$row['tittle'].'</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                  <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool remove_btn" data-card-widget="remove" data-toggle="tooltip" title="Remove" id='.$row['id'].'>
                                  <i class="fas fa-times"></i></button>
                              </div>
                            </div>
                            <div class="card-body">'.$row['text'].'
                            </div>
                          </div>';
                 }
              }
            }
          ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./js/demo.js"></script>
<script>
  $('.remove_btn').on('click',(e)=>{
    var id = $(e.currentTarget).attr('id');
    var ses_id = <?php echo '"'.session_id().'"';?>;
	var url = "<?php echo "/..".$remove_note_req_handler_url;?>";
    $.ajax({
      type:"POST",
      url:url,
      dataType:"json",
      data: {'id':id, 'ses_id': ses_id },
    })
  })

</script>
</body>
</html>
