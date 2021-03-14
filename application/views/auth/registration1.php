<div class="limiter">
		<div class="container-login100">

			<div class="wrap-login100">

				<div class="login100-pic js-tilt" data-tilt>

					<img src="<?= base_url('assets/login_v1/'); ?>images/img-01.png" alt="IMG">
				</div>
					
                    <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
					<span class="login100-form-title">
						<?= $config['site_title']; ?> REGISTRATION
					</span>
					
					<?= $this->session->flashdata('message'); ?>


					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name" placeholder="fullname"<?= set_value('name'); ?>>
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email"<?= set_value('email'); ?>>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password1" placeholder="Password">
						<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>

					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password2" placeholder="Repeat Password">
						<?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Registration
						</button>
					</div>


					<div class="text-center p-t-40">
						<a class="txt2" href="<?= base_url('auth') ?>">
							Login your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>