<div id="wrapper">
  <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark " style="background-color:#00D9C6">
      <div class="container">
        <a class="navbar-brand" href="#" style="background-color: #141680; padding: 1px 20px; border-radius: 25px; color: #fff;">.BLOG IT</a>
        <button class="navbar-toggler" 
                type="button" 
                data-toggle="collapse" 
                data-target="#navbarText" 
                aria-controls="navbarText"
                aria-expanded="false" 
                aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav side-nav" >
            <li class="nav-item">
              <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/admin/home') echo 'active'; ?>" style="margin-left: 20px;" href="<?php echo Settings::PATH['base'] ?>/home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/admin/admins/showadmins') echo 'active'; ?>" href="<?php echo Settings::PATH['base']; ?>/admins/showadmins" style="margin-left: 20px;">Admins</a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/admin/admins/showusers') echo 'active'; ?>" href="<?php echo Settings::PATH['base']; ?>/admins/showusers" style="margin-left: 20px;">Users</a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/admin/categories') echo 'active'; ?>" href="<?php echo Settings::PATH['base']; ?>/categories" style="margin-left: 20px;">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/admin/posts') echo 'active'; ?>" href="<?php echo Settings::PATH['base']; ?>/posts" style="margin-left: 20px;">Posts</a>
            </li>
           <li class="nav-item">
              <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/admin/comments') echo 'active'; ?>" href="<?php echo Settings::PATH['base']; ?>/comments" style="margin-left: 20px;">Comments</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo Settings::PATH['base'] ?>/home" style="color: white" >Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" href="#" style="color: white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['username_admin'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo Settings::PATH['base'] ?>/login/logout">Logout</a>
              
          </li>
                          
          
        </ul>
      </div>
    </div>
  </nav>




