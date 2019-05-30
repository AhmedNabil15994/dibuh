    <!-- Start NavBar -->
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="color: #58a899">DiBUH</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav">
                <li><a href="#">home</a></li>
                <li><a href="#">services</a></li>
                <li><a href="#">locations</a></li>
                <li><a href="#">industries</a></li>
                <li><a href="#">careers</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="{{route('login')}}">Log in</a></li>
                <li><a href="{{route('register.index')}}">Register</a></li>                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

 