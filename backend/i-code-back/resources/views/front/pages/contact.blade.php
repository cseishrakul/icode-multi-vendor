@extends('front.layouts.layout')
@section('content')
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Contact Us</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="" class="">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="" class="">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Contact-Page -->
    <div class="page-contact u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="touch-wrapper">
                        <h1 class="contact-h1">Get In Touch With Us</h1>
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong> {{ Session::get('success_message') }}

                                <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                    <span aria-hidden="true"> &times; </span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                                <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                    <span aria-hidden="true"> &times; </span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ url('contact') }}" method="POST">
                            @csrf
                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="contact-name">Your Name
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="contact-name" class="text-field" name="name"
                                        placeholder="Name" required value={{old('name')}}>
                                </div>
                                <div class="group-2">
                                    <label for="contact-email">Your Email
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="email" name="email" id="contact-email" class="text-field"
                                        placeholder="Email" required value={{old('email')}} >
                                </div>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="contact-subject">Subject
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="subject" id="contact-subject" class="text-field"
                                    placeholder="Subject" required value={{old('subject')}}>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="contact-message">Message:<span class="astk">*</span>
                                </label>
                                <textarea class="text-area" id="contact-message" name="message" required>{{old('message')}}</textarea>
                            </div>
                            <div class="u-s-m-b-30">
                                <button type="submit" class="button button-outline-secondary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="information-about-wrapper">
                        <h1 class="contact-h1">Information About Us</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, tempora, voluptate.
                            Architecto aspernatur, culpa cupiditate deserunt dolore eos facere in, incidunt omnis quae quam
                            quos, similique sunt tempore vel vero.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, tempora, voluptate.
                            Architecto aspernatur, culpa cupiditate deserunt dolore eos facere in, incidunt omnis quae quam
                            quos, similique sunt tempore vel vero.
                        </p>
                    </div>
                    <div class="contact-us-wrapper">
                        <h1 class="contact-h1">Contact Us</h1>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Location</h6>
                            <span>4441 Jett Lane</span>
                            <span>Bellflower, CA 90706</span>
                        </div>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Email</h6>
                            <span>info@sitemakers.in</span>
                        </div>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Telephone</h6>
                            <span>+111-222-333</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-s-p-t-80">
            <div id="map"></div>
        </div>
    </div>
    <!-- Contact-Page /- -->
@endsection
