
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                
                        <!-- Tu wyświetlamy wartość dla HOME -->
                        <?php if(!isset($_REQUEST['c']) || ($_SERVER['REQUEST_URI'] == '/blogit/home') || (isset($_SESSION['username']))) : ?>
                        <!-- POLE DO WYSZUKIWANIA -->
                        <div class="input-group ps-5 py-2">
                                <div id="navbar-search-autocomplete" class="w-100">
                                    <form method="POST" action="<?php echo Settings::PATH['base'] ?>/home/search">
                                        <input name="search" type="search" id="form1" class="form-control mt-3" placeholder="search" />                            
                                    </form>
                                </div>                
                        </div>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo Settings::PATH['base']?>/home">HOME</a></li>
                            
                            <!-- Jesli zalogowany -->
                            <?php if(isset($_SESSION['username'])) : ?>
                                <li class="nav-item dropdown mt-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['username']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <!-- <li><a class="dropdown-item" href="#<?php echo $_SESSION['user_id']; ?>">Profile</a></li> -->
                                    <li><a class="dropdown-item" href="<?php echo Settings::PATH['base'] ?>/login/logout">Logout</a></li>
                                
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo Settings::PATH['base'] ?>/post/create">CREATE</a></li>
                            <?php else : ?> 
                        <!-- Tu wyswietlamy dla reszty -->
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo Settings::PATH['base'] ?>/login">LOGIN</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo Settings::PATH['base'] ?>/register">REGISTER</a></li>
                        <?php endif; ?>  
                            
                        <?php else: ?>

                        <!-- POLE DO WYSZUKIWANIA -->
                        <div class="input-group ps-5 py-2">
                                <div id="navbar-search-autocomplete" class="w-100">
                                    <form method="POST" action="<?php echo Settings::PATH['base'] ?>/home/search">
                                        <input name="search" type="search" id="form1" class="form-control mt-3" placeholder="search" />                            
                                    </form>
                                </div>                
                        </div>

                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 <?php if ($_REQUEST['c'] == 'home') echo 'active'; ?>" href="<?php echo Settings::PATH['base'] ?>/home">HOME</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 <?php if ($_REQUEST['c'] == 'login') echo 'active'; ?>" href="<?php echo Settings::PATH['base'] ?>/login">LOGIN</a></li>
                            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 <?php if ($_REQUEST['c'] == 'register') echo 'active'; ?>" href="<?php echo Settings::PATH['base'] ?>/register">REGISTER</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>