
<!-- ====== Login Form ====== -->
<div class="user-form">
    <div class="close-form d-flex"><i class="bx bx-x"></i></div>
    <div class="form-wrapper container">

        <div class="user login">
            <div class="form-box">
                <div class="top">
                    <p>
                        Not a member?
                        <span data-id="#ff0066">Register now</span>
                    </p>
                </div>
                <form action="process_login.php" method="post">
                    <div class="form-control">
                        <h2>Hello Again!</h2>
                        <p>Welcome back you've been missed.</p>
                        <input class="form-control" id="email" required name="email" type="email" placeholder="Enter Email" />
                        <div>
                            <input class="form-control" id="password" required name="password" type="password" placeholder="Password" />
                            <div class="icon form-icon">
                                <img src="./images/eye.svg" alt="" />
                            </div>
                        </div>
                        <input type="Submit" value="Login" />
                    </div>
                </form>
            </div>
        </div>

        <!-- Register -->
        <div class="user signup">
            <div class="form-box">
                <div class="top">
                    <p>
                        Already a member?
                        <span data-id="#1a1aff">Login now</span>
                    </p>
                </div>
                <form action="process_register.php" method="post" >
                    <div class="form-control">
                        <h2>Welcome!</h2>
                        <p>It's good to have you.</p>

                        <div>
                            <input class="form-control" id="fname" required name="fname" type="text" placeholder="First Name" />
                        </div>

                        <div>
                            <input class="form-control" id="lname" required name="lname" type="text" placeholder="Last Name" />
                        </div>

                        <input class="form-control" id="email" required name="email" type="email"  placeholder="Enter Email" />

                        <div>
                            <input class="form-control" id="password" required name="password" type="password" placeholder="Password" />
                        </div>

                        <div>
                            <input class="form-control" id="confirm_password" required name="confirm_password" type="password" placeholder="Confirm Password" />
                            <div class="icon form-icon">
                                <img src="./images/eye.svg" alt="" />
                            </div>
                        </div>

                        <input type="Submit" value="Register" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
