<!DOCTYPE html>
<html lang="en-US">


<head>

	<!-- Meta
	============================================= -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1, max-scale=1">

	<!-- Stylesheets
	============================================= -->
	<link href="{{asset('lead_assets/css/css-assets.css')}}" rel="stylesheet">
	<link href="{{asset('lead_assets/css/style.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:500,500i,600,600i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

	<!-- Favicon
	============================================= -->
	<link rel="shortcut icon" href="{{asset('lead_assets/images/general-elements/favicon/favicon.png')}}">
	<link rel="shortcut icon" href="{{asset('lead_assets/images/general-elements/favicon/apple-touch-icon.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('lead_assets/images/general-elements/favicon/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('lead_assets/images/general-elements/favicon/apple-touch-icon-114x114.png')}}">

	<!-- Title
	============================================= -->
	<title>WDPF ROUND-46</title>

</head>

<body>

	<div id="scroll-progress"><div class="scroll-progress"><span class="scroll-percent"></span></div></div>

	<!-- Document Full Container
	============================================= -->
	<div id="full-container">

		<!-- Banner
		============================================= -->
		<section id="banner">

			<div class="banner-parallax" data-banner-height="700">
				<img src="{{asset('lead_assets/images/files/parallax-bg/img-1.jpg')}}" alt="">
				<div class="overlay-colored color-bg-theme opacity-80"></div><!-- .overlay-colored end -->
				<div class="slide-content">

					<div class="container">
						<div class="row">
							<div class="col-md-7 pr-40">

								<div class="banner-center-box text-white padding:100px">
									<img class="logo-banner" src="images/files/logo-banner.png" alt="">
									<h1>We are passionate to enrich people’s lives</h1>
									<div class="description">
										Whatever the level of support you require, we are sure that we will have a package that meets your needs.
									</div>
								</div><!-- .banner-center-box end -->

							</div><!-- .col-md-7 end -->
							<div class="col-md-5">

								<div class="banner-center-box">
									<div class="cta-subscribe cta-subscribe-2 box-form">
										<i class="cs-arrow fa fa-angle-down"></i>
										<div class="box-content">
											<form action="{{route('store.lead')}}" method="post">
                                                @csrf
												<div class="cs-notifications">
													<div class="cs-notifications-content"></div>
												</div><!-- .cs-notifications end -->

                                                <div class="form-group">
													<input type="text" name="name" id="cs2Name" class="form-control" placeholder="Your Name">
													@if($errors->has('name'))
														<div style="color: red; font-size:10px">{{ $errors->first('name') }}</div>
													@endif
												</div><!-- .form-group end -->
												<div class="form-group">
													<input type="text" name="email" id="cs2Email" class="form-control" placeholder="Your Email">
													@if($errors->has('email'))
														<div style="color: red;font-size:10px">{{ $errors->first('email') }}</div>
													@endif
												</div><!-- .form-group end -->
												<div class="form-group">
													<input type="text" name="phone" id="cs2PhoneNum" class="form-control" placeholder="Phone Number">
													@if($errors->has('phone'))
														<div style="color: red;font-size:10px">{{ $errors->first('phone') }}</div>
													@endif
												</div>
												<!-- .form-group end -->
												<div class="form-group">
													<textarea style="height:50px"	id="addr" class="form-control" name="address" value=""  placeholder="Address"></textarea>
													@if($errors->has('address'))
														<div style="color: red;font-size:10px">{{ $errors->first('address') }}</div>
													@endif
												</div><!-- .form-group end -->
												<div class="form-group">
													<textarea style="height:50px" id="interest" class="form-control" name="service_interest" value=""  placeholder="Interest"></textarea>
													@if($errors->has('service_interest'))
														<div style="color: red;font-size:10px">{{ $errors->first('service_interest') }}</div>
													@endif
												</div><!-- .form-group end -->

												<!-- .form-group end -->
												<div class="form-group">
													<input type="submit" class="form-control" value="SUBMIT">
												</div><!-- .form-group end -->
												<div class="form-group">
													<a href="{{route('login')}}" class="btn btn-block btn-info" style="width: 100%">Login</a>
												</div><!-- .form-group end -->


												@if(session('leadSuccess'))
												  <div class="alert alert-warning alert-dismissible fade show" role="alert">
													<strong>{{session('leadSuccess')}}</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
												  </div>
												@endif
											</form><!-- #form-cta-subscribe-2 end -->
										</div><!-- .box-content end -->
									</div><!-- .box-form end -->
								</div><!-- .banner-center-box end -->

							</div><!-- .col-md-5 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .slide-content end -->
			</div><!-- .banner-parallax end -->

		</section><!-- #banner end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div id="content-wrap">

				<!-- === Intro Features =========== -->
				<div id="intro-features" class="flat-section">

					<div class="section-content">

						<div class="container">
							<div class="row">
								<div class="col-md-6">

									<div class="box-info mb-md-50">
										<div class="box-icon icon x2 colorful-icon mr-20"><i class="fa fa-commenting-o"></i></div>
										<div class="box-content">
											<h4>Get a Better Overview</h4>
											<p>
												There is nothing more to spend. Today, you can have a landing page and connect with customers.
											</p>
										</div><!-- .box-content end -->
									</div><!-- .box-info end -->

								</div><!-- .col-md-6 end -->
								<div class="col-md-6">

									<div class="box-info">
										<div class="box-icon icon x2 colorful-icon mr-20"><i class="fa fa-cogs"></i></div>
										<div class="box-content">
											<h4>Get a Better Design</h4>
											<p>
												There is nothing more to spend. Today, you can have a landing page and connect with customers.
											</p>
										</div><!-- .box-content end -->
									</div><!-- .box-info end -->

								</div><!-- .col-md-6 end -->
								<div class="divider-70"></div>
								<div class="col-md-6">

									<div class="box-info mb-md-50">
										<div class="box-icon icon x2 colorful-icon mr-20"><i class="fa fa-line-chart"></i></div>
										<div class="box-content">
											<h4>Get a Better Analytics</h4>
											<p>
												There is nothing more to spend. Today, you can have a landing page and connect with customers.
											</p>
										</div><!-- .box-content end -->
									</div><!-- .box-info end -->

								</div><!-- .col-md-6 end -->
								<div class="col-md-6">

									<div class="box-info">
										<div class="box-icon icon x2 colorful-icon mr-20"><i class="fa fa-file-text-o"></i></div>
										<div class="box-content">
											<h4>Get a Better Results</h4>
											<p>
												There is nothing more to spend. Today, you can have a landing page and connect with customers.
											</p>
										</div><!-- .box-content end -->
									</div><!-- .box-info end -->

								</div><!-- .col-md-6 end -->
							</div><!-- .row end -->
						</div><!-- .container end -->

					</div><!-- .section-content end -->

				</div><!-- .flat-section end -->

				<!-- === Watch Video =========== -->
				<div id="watch-video" class="flat-section center-vertical" data-scroll-index="2">

					<div class="section-content">

						<div class="container">
							<div class="row">
								<div class="col-md-6">

									<div class="box-center">
										<div class="video-preview">
											<iframe src="https://www.youtube.com/watch?v=c738kBfZKeA" allowfullscreen></iframe>
										</div><!-- .video-preview end -->
									</div><!-- .box-center end -->

								</div><!-- .col-md-6 end -->
								<div class="col-md-6 pl-50">

									<div class="box-center">
										<h3>Watch the great video</h3>
										<p>
											There is nothing more to spend. Today, you can have a landing page and connect with customers.
										</p>
		                                <ul class="list check">
		                                    <li>This is the first feature that stands out</li>
		                                    <li>This is the second feature that stands out</li>
		                                </ul><!-- .list.angle-right end -->
									</div><!-- .box-center end -->

								</div><!-- .col-md-6 end -->
							</div><!-- .row end -->
						</div><!-- .container end -->

					</div><!-- .section-content end -->

				</div><!-- .flat-section end -->

				<!-- === Clients Testimonials =========== -->
				<div id="clients-testimonials" class="flat-section">

					<div class="section-content">

						<div class="container">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">

									<div class="slider-testimonials">
										<ul class="owl-carousel">
											<li>
												<div class="slide">
													<div class="testimonial-single-1">
														<div class="ts-content">
															As a professional, you want to show the world you have arrived and are going places. You need your web presence to be reliable and easy to create.
														</div><!-- .ts-content end -->
														<div class="ts-person">
															<div class="ts-img">
																<img src="{{asset('lead_assets/images/files/sliders/clients-testimonials/img-1.jpg')}}" alt="">
															</div><!-- .ts-img end -->
															<h4>John Hancock</h4>
															<span>Creative Team</span>
														</div><!-- .ts-person end -->
													</div><!-- .testimonial-single-1 -->
												</div><!-- .slide end -->
											</li>
											<li>
												<div class="slide">
													<div class="testimonial-single-1">
														<div class="ts-content">
															As a professional, you want to show the world you have arrived and are going places. You need your web presence to be reliable and easy to create.
														</div><!-- .ts-content end -->
														<div class="ts-person">
															<div class="ts-img">
																<img src="{{asset('lead_assets/images/files/sliders/clients-testimonials/img-2.jpg')}}" alt="">
															</div><!-- .ts-img end -->
															<h4>Jolya Smith</h4>
															<span>PayPal Inc</span>
														</div><!-- .ts-person end -->
													</div><!-- .testimonial-single-1 -->
												</div><!-- .slide end -->
											</li>
										</ul>
									</div><!-- .slider-testimonials end -->

								</div><!-- .col-md-10 end -->
							</div><!-- .row end -->
						</div><!-- .container end -->

					</div><!-- .section-content end -->

				</div><!-- .flat-section end -->

				<!-- === CTA Title 1 =========== -->
				<div id="cta-title-1" class="parallax-section text-white" data-parallax-bg-img="img-2.jpg" data-stellar-background-ratio="0.2">

					<div class="overlay-colored" data-bg-color="#000" data-bg-color-opacity="0.5"></div><!-- .overlay-colored end -->
					<div class="section-content">

						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center">

									<h1>What are you waiting for?</h1>
									<p>
										Whatever the level of support you require, we are sure that we will have a package that meets your needs.
									</p>
									<a class="scroll-top btn xx-large colorful hover-dark mt-10" href="#our-services">Call to Action</a>

								</div><!-- .col-md-8 end -->
							</div><!-- .row end -->
						</div><!-- .container end -->

					</div><!-- .section-content end -->

				</div><!-- .parallax-section end -->

			</div><!-- #content-wrap -->

		</section><!-- #content end -->

		<!-- Footer Mini
		============================================= -->
		<footer id="footer-mini">

			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<div class="copyrights-message">2021 - 2023 © <span class="colored">CRM PROJECT ROUND-46</span>. All rights reserved.</div>

					</div><!-- .col-md-12 end -->
				</div><!-- .row end -->
			</div><!-- .container end -->

		</footer><!-- #footer-mini end -->

	</div><!-- #full-container end -->

	<a class="scroll-top-icon scroll-top" href="#"><i class="fa fa-angle-up"></i></a>

	<!-- External JavaScripts
	============================================= -->
	<script src="{{asset('lead_assets/js/jquery.js')}}"></script>
	<script src="{{asset('lead_assets/js/jRespond.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.easing.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.fitvids.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.stellar.js')}}"></script>
	<script src="{{asset('lead_assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.mb.YTPlayer.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.validate.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/simple-scrollbar.min.js')}}"></script>
	<script src="{{asset('lead_assets/js/functions.js')}}"></script>


</body>


</html>
