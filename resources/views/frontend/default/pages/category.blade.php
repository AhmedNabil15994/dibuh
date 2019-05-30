@extends(app('FrontEndTheme').'.layouts.default')


@section('title')
- {{$page_title}}
@endsection


@section('content')
@include(app('FrontEndTheme').'.shared.breadcrumb')
<!-- Start Section Main Content -->
<div class="main_contant">
            <!-- Start Section Main Section -->
            <section class="category_page sec">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8">
                            <!-- Start Our Carousel-->
                            <div id="cat_slide" class="carousel slide  " data-ride="carousel" >
                                <!-- Indicators -->
                                <ol class="carousel-indicators ">
                                    <li data-target="#cat_slide" data-slide-to="0" class="active"></li>
                                    <li data-target="#cat_slide" data-slide-to="1"></li>
                                    <li data-target="#cat_slide" data-slide-to="2"></li>
                                    <li data-target="#cat_slide" data-slide-to="3"></li>    
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="images/slide1.jpg" alt="slide 1">
                                        <div class="carousel-caption ">
 
                                            <p class="lead">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="images/slide2.jpg" alt="slide 2">
                                        <div class="carousel-caption  ">
 
                                            <p class="lead">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.  
                                            </p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="images/slide3.jpg" alt="slide 3">
                                        <div class="carousel-caption  ">
 
                                            <p class="lead">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="images/slide4.jpg" alt="slide 4">
                                        <div class="carousel-caption  ">
 
                                            <p class="lead">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.  
                                            </p>
                                        </div>
                                    </div>        

                                </div>
                            </div>
                            <!-- End Our Carousel--> 	
	<?php 
/*	foreach ($nodes as  $value) {
		echo $value->name.'-';
		# code...
	}*/
	 print_r($nodes)
	?>
                            <div class="block_default">

								<div class="title_default">
									<h3><a href="#" class="active" > <?php echo $title ?></a></h3>
									<a href="#" class="view_all"  > View all  <i class="fa fa-list-ul" aria-hidden="true"></i></a>
								</div>	<!--Title Default--> 

								<div class="row">
										<div class="col-md-6">
											<div class="block_article block_other_article">
												<div class="media">
													<a class="pull-left flip" href="#">
														<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
													</a>
													<div class="media-body">
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. 

													</div>
												</div>

												<div class="media">
													<a class="pull-left flip" href="#">
														<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
													</a>
													<div class="media-body">

														Lorem Ipsum is simply dummy text of the printing and typesetting industry. 

													</div>
												</div>

												<div class="media">
													<a class="pull-left flip" href="#">
														<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
													</a>
													<div class="media-body">

														Lorem Ipsum is simply dummy text of the printing and typesetting industry. 

													</div>
												</div>


											</div>
										</div>

										<div class="col-md-6">
											<div class="block_article block_first_article">
												<a href="#"><img src="images/articles/home/childern1.jpg" class="img-responsive" alt="first_article" ></a>
												<h4><a href="#">The animated ‘Unfairy Tales’ about Syrian refugee children.The animated ‘Unfairy Tales’ about Syrian refugee children</a></h4>


											</div>
										</div>
								</div><!--End Row-->

								<hr>

							<div class="category_items">
									<div class="media">
										<a class="pull-left flip" href="#">
											<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
										</a>
										<div class="media-body">

											<h4>
											<a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry</a>
											</h4>
											<div class="article_statics visible-lg visible-md">
												<ul class="list_unstyled">
													<li><i class="fa fa-calendar"></i>14th January 2013</li>
													<li><i class="fa fa-user"></i>14th January 2013	</li>
													<li><i class="fa fa-eye"></i>875</li>									
												</ul>														
											</div>
											<p class="visible-lg visible-md">											
											Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. 	
											</p>									
										</div>
									</div>
									<div class="media">
										<a class="pull-left flip" href="#">
											<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
										</a>
										<div class="media-body">

											<h4>
											<a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry</a>
											</h4>
											<div class="article_statics visible-lg visible-md">
												<ul class="list_unstyled">
													<li><i class="fa fa-calendar"></i>14th January 2013</li>
													<li><i class="fa fa-user"></i>14th January 2013	</li>
													<li><i class="fa fa-eye"></i>875</li>									
												</ul>														
											</div>
											<p class="visible-lg visible-md">											
											Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. 	
											</p>									
										</div>
									</div>
									<div class="media">
										<a class="pull-left flip" href="#">
											<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
										</a>
										<div class="media-body">

											<h4>
											<a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry</a>
											</h4>
											<div class="article_statics visible-lg visible-md">
												<ul class="list_unstyled">
													<li><i class="fa fa-calendar"></i>14th January 2013</li>
													<li><i class="fa fa-user"></i>14th January 2013	</li>
													<li><i class="fa fa-eye"></i>875</li>									
												</ul>														
											</div>
											<p class="visible-lg visible-md">											
											Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. 	
											</p>									
										</div>
									</div>
																											<div class="media">
										<a class="pull-left flip" href="#">
											<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
										</a>
										<div class="media-body">

											<h4>
											<a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry</a>
											</h4>
											<div class="article_statics visible-lg visible-md">
												<ul class="list_unstyled">
													<li><i class="fa fa-calendar"></i>14th January 2013</li>
													<li><i class="fa fa-user"></i>14th January 2013	</li>
													<li><i class="fa fa-eye"></i>875</li>									
												</ul>														
											</div>
											<p class="visible-lg visible-md">											
											Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. 	
											</p>									
										</div>
									</div>
									<div class="media">
										<a class="pull-left flip" href="#">
											<img alt="image 01" class="media-object" src="images/articles/img1.jpg">
										</a>
										<div class="media-body">

											<h4>
											<a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting industry</a>
											</h4>
											<div class="article_statics visible-lg visible-md">
												<ul class="list_unstyled">
													<li><i class="fa fa-calendar"></i>14th January 2013</li>
													<li><i class="fa fa-user"></i>14th January 2013	</li>
													<li><i class="fa fa-eye"></i>875</li>									
												</ul>														
											</div>
											<p class="visible-lg visible-md">											
											Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry. 	
											</p>									
										</div>
									</div>									
							<!--### Pagination-->																		
							<nav>
							  <ul class="pagination">
							    <li >
							      <a href="#" aria-label="Previous">
							        <span aria-hidden="true">&laquo;</span>
							      </a>
							    </li>
							    <li class="active"><a href="#">1</a></li>
							    <li><a href="#">2</a></li>
							    <li><a href="#">3</a></li>
							    <li><a href="#">4</a></li>
							    <li><a href="#">5</a></li>
							    <li>
							      <a href="#" aria-label="Next">
							        <span aria-hidden="true">&raquo;</span>
							      </a>
							    </li>
							  </ul>
							</nav><!--End Pagination-->																									
							</div><!-- End Category items-->								
                            </div><!-- End Block Defaul-->

                        </div><!-- col-lg-8-->

                        <div class="col-lg-4">
 							@include(app('FrontEndTheme').'.shared.sidebar')
                        </div><!-- End col-lg-4-->

					</div><!--End Row-->
             
                </div><!--End Container-->

            </section>

</div>
<!-- End Section Main Content -->	
@endsection