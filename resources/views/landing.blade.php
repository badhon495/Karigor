@extends('layouts.app')

@section('styles')
<!-- Custom CSS for landing page already included in app.blade.php -->
@endsection

@section('content')
<!-- loader -->
<div class="loader_bg">
   <div class="loader"><img src="{{ asset('css/images/loading.gif') }}" alt="Loading" /></div>
</div>
<!-- end loader -->

<!-- banner -->
<section class="banner_main">
   <div id="banner1" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
         <li data-target="#banner1" data-slide-to="0" class="active"></li>
         <li data-target="#banner1" data-slide-to="1"></li>
         <li data-target="#banner1" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container-fluid">
               <div class="carousel-caption">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="text-bg">
                           <h1>Premium Car Workshop</h1>
                           <p>Your vehicle deserves the best care. Our certified technicians provide comprehensive repair and maintenance services using state-of-the-art equipment and genuine parts to keep your car running at peak performance.</p>
                           <a href="{{ url('/book-appointment') }}" class="btn btn-primary"> Appointment</a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="text_img">
                           <figure><img src="{{ asset('css/images/car.png') }}" alt="Car" /></figure>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <div class="container-fluid">
               <div class="carousel-caption">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="text-bg">
                           <h1>Trusted Auto Service</h1>
                           <p>From routine maintenance to complex repairs, our skilled team handles everything with precision and care. We pride ourselves on transparent pricing, quick turnaround times, and exceptional customer service.</p>
                           <a href="{{ url('/contact-admin') }}" class="btn btn-secondary">Contact Us</a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="text_img">
                           <figure><img src="{{ asset('css/images/car.png') }}" alt="Car" /></figure>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      </a>
      <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
      </a>
   </div>
</section>
<!-- end banner -->

<!-- three_box -->
<div class="three_box">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div class="box_text">
               <h3>AUTO DIAGNOSE</h3>
               <i><img src="{{ asset('css/images/thr.png') }}" alt="Auto Diagnose" /></i>
               <p>ipsum dolor sit amet, consectetur adipiscing elit, sed d veniam, adipiscing elit, sed d veniam</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="box_text">
               <h3>AUTO DIAGNOSE</h3>
               <i><img src="{{ asset('css/images/thr1.png') }}" alt="Auto Diagnose" /></i>
               <p>ipsum dolor sit amet, consectetur adipiscing elit, sed d veniam, adipiscing elit, sed d veniam</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="box_text">
               <h3>AUTO DIAGNOSE</h3>
               <i><img src="{{ asset('css/images/thr2.png') }}" alt="Auto Diagnose" /></i>
               <p>ipsum dolor sit amet, consectetur adipiscing elit, sed d veniam, adipiscing elit, sed d veniam</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- three_box -->

<!-- about -->
<div class="about">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>About Our Car Service</h2>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <div class="about_img">
                  <div class="about_box">
                     <h3>Dolor sit amet, consectetur adipiscing elit</h3>
                     <p>dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                     <a href="#" class="btn btn-primary">Read More</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end about -->

<!-- wedo section -->
<div class="wedo">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>What We Do</h2>
               <p>It is a long established fact that a reader will be distracted by the</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-10 offset-md-1">
            <div class="row">
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="{{ asset('css/images/img1.png') }}" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Quick repair<br><span class="blu">Total Service</span></h3>
                  </div>
               </div>
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="{{ asset('css/images/img2.png') }}" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Quick repair<br><span class="blu">Total Service</span></h3>
                  </div>
               </div>
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="{{ asset('css/images/img3.png') }}" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Quick repair<br><span class="blu">Total Service</span></h3>
                  </div>
               </div>
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="{{ asset('css/images/img4.png') }}" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Quick repair<br><span class="blu">Total Service</span></h3>
                  </div>
               </div>
            </div>
            <a href="#" class="btn btn-primary read_more">See More</a>
         </div>
      </div>
   </div>
</div>
<!-- end wedo section -->

<!-- testimonial -->
<div class="testimonial">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Testimonials</h2>
               <p>What our customers say about us</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div id="myCarousel" class="carousel slide testimonial_Carousel" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <div class="carousel-caption">
                           <div class="row">
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="{{ asset('css/images/tes.jpg') }}" alt="Testimonial" /></i>
                                    <h4>John Smith</h4>
                                    <span>Satisfied Customer</span>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                                 </div>
                              </div>
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="{{ asset('css/images/tes1.jpg') }}" alt="Testimonial" /></i>
                                    <h4>Rebecca Jones</h4>
                                    <span>Satisfied Customer</span>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <div class="carousel-caption">
                           <div class="row">
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="{{ asset('css/images/tes.jpg') }}" alt="Testimonial" /></i>
                                    <h4>Michael Brown</h4>
                                    <span>Satisfied Customer</span>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                                 </div>
                              </div>
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="{{ asset('css/images/tes1.jpg') }}" alt="Testimonial" /></i>
                                    <h4>Emily Davis</h4>
                                    <span>Satisfied Customer</span>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end testimonial -->

<!-- Contact Us -->
<div id="contact" class="contact-section py-5">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <h3>Contact Us</h3>
            <ul class="contact-info list-unstyled">
               <li><i class="fa fa-map-marker"></i> 123 Workshop Street, City, Country</li>
               <li><i class="fa fa-phone"></i> +1 234 567 8901</li>
               <li><i class="fa fa-envelope"></i> info@carworkshop.com</li>
            </ul>
         </div>
         <div class="col-md-6">
            <form action="{{ url('/contact-admin') }}" method="POST" class="contact-form">
               @csrf
               <div class="form-group">
                  <input type="text" name="user_name" class="form-control" placeholder="Your Name" required>
               </div>
               <div class="form-group">
                  <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
               </div>
               <div class="form-group">
                  <select name="problem_type" class="form-control" required>
                     <option value="">Select Problem Type</option>
                     <option value="Appointment Issue">Appointment Issue</option>
                     <option value="Car Service">Car Service</option>
                     <option value="Billing">Billing</option>
                     <option value="Other">Other</option>
                  </select>
               </div>
               <div class="form-group">
                  <textarea name="problem_description" class="form-control" placeholder="Problem Description" rows="3" required></textarea>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<!-- JavaScript files already included in app.blade.php -->
@endsection