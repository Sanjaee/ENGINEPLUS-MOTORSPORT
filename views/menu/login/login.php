
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login -  Service Center</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/logolite.png" type="image/x-icon" />
    <link href="<?php echo base_url();?>assets/css/lite-purple.min.css" rel="stylesheet">
</head>

<body>
    <div class="auth-layout-wrap" style="background-image: url(<?php echo base_url(); ?>assets/img/background.png)">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-12">
                    <?php if ($this->session->flashdata('pesan')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo base_url(); ?>login/loginc/cek_login" method="post" onSubmit="return validasi()">
                        <div class="p-4">
                        <img src="<?php echo base_url(); ?>assets/img/logocloud.png" />
                            <div class="auth-logo text-center mb-4" ></div>
                            <h1 class="mb-3 text-18">Sign In</h1>
                            <form>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control form-control-rounded" name="username" id="username" type="username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control form-control-rounded" name="password" id="password" type="password">
                                </div>
                                <button class="btn btn-rounded btn-primary btn-block mt-2"  id="myButton" type="submit" name="btn" value="Login">Sign In</button>
                            </form>
                            <!-- <div class="mt-3 text-center"><a class="text-muted" href="forgot.html">
                                    <u>Forgot Password?</u></a></div> -->
                        </div>
                    </div>
                    <!-- <div class="col-md-6 text-center" style="background-size: cover;background-image: url(../../dist-assets/images/photo-long-3.jpg)">
                        <div class="pr-3 auth-right"><a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="signup.html"><i class="i-Mail-with-At-Sign"></i> Sign up with Email</a><a class="btn btn-rounded btn-outline-google btn-block btn-icon-text"><i class="i-Google-Plus"></i> Sign up with Google</a><a class="btn btn-rounded btn-block btn-icon-text btn-outline-facebook"><i class="i-Facebook-2"></i> Sign up with Facebook</a></div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</body>
</html>