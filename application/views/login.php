<?php $this->load->view('partial/header'); ?>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Welcome to IN+</h3>

            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>

            <p>Login in. To see it in action.</p>
            <div>
                <h3 style="color: red">
                <?php
                if (isset($error)) {
                    echo $error;
                }
                ?>
                </h3>
            </div>
            <form method="POST" id="login" class="m-t" role="form" action="<?php echo base_url(); ?>index.php/user/login">
                <div class="form-group">
                    <input name="email_address" id="email_address" type="email" class="form-control"
                           placeholder="E-Mail Address" required="">
                </div>
                <div class="form-group">
                    <input name="password" id="password" type="password" class="form-control" placeholder="Password"
                           required="">
                </div>
                <div class="form-control">
                    <input type="checkbox" name="remember" value="remember"/> <label for="remember"> Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#">
                    <small>Forgot password?</small>
                </a>
            </form>
            <p class="m-t">
                <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
            </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assests'); ?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url('assests'); ?>/js/bootstrap.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?php echo base_url('assests'); ?>/js/plugins/validate/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {

            $("#login").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 3
                    },
                    email_address: {
                        required: true,
                        email: true
                    }
                }
            });
        });
    </script>

</body>

</html>