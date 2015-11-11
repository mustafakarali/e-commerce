        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='index.php'? 'class="active' : '');?>">
                            <a href="index.php"><i class="icon-chevron-right"></i> Menu Panel</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='catalogue.php'? 'class="active' : '');?>">
                            <a href="catalogue.php"><i class="icon-chevron-right"></i> Catalogue</a>
                        </li>
                        
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='member.php'? 'class="active' : '');?>">
                            <a href="member.php"><i class="icon-chevron-right"></i> User Account Manager</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='order.php'? 'class="active' : '');?>">
                            <a href="order.php"><i class="icon-chevron-right"></i> Orders</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='content.php'? 'class="active' : '');?>">
                            <a href="content.php"> Manage Page</a>
                        </li>   
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>