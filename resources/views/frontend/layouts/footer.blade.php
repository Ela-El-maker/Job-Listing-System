<section class="section-box subscription_box">
    <div class="container">
        <div class="box-newsletter">
            <div class="newsletter_textarea">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="text-md-newsletter">Subscribe to our newsletter</h2>
                        <p class="text-muted">Get the latest updates and offers directly to your inbox</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="box-form-newsletter">
                            <form class="form-newsletter" method="POST">
                                @csrf
                                <input class="input-newsletter" type="text" value="" name="email"
                                    placeholder="Enter your email here">
                                <button class="btn btn-default font-heading newsletter-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php

$footerOne = \Menu::getByName('Footer Menu One');
$footerTwo = \Menu::getByName('Footer Menu Two');
$footerThree = \Menu::getByName('Footer Menu Three');
$footerFour = \Menu::getByName('Footer Menu Four');

@endphp


<footer class="footer pt-165">
    <div class="container">
        <div class="row justify-content-between">
            <div class="footer-col-1 col-md-3 col-sm-12">
                <a class="footer_logo" href="index.html">
                    <img alt="joblist" src="assets/imgs/template/logo_2.png">
                </a>
                <div class="mt-20 mb-20 font-xs color-text-paragraph-2">joblist is the heart of the design community and
                    the
                    best resource to discover and connect with designers and jobs worldwide.</div>
                <div class="footer-social">
                    <a class="icon-socials icon-facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="icon-socials icon-twitter" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="icon-socials icon-linkedin" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-col-2 col-md-2 col-xs-6">
                <h6 class="mb-20">Resources</h6>
                <ul class="menu-footer">
                    @foreach ($footerOne as $menu)
                    <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach

                </ul>
            </div>
            <div class="footer-col-3 col-md-2 col-xs-6">
                <h6 class="mb-20">Community</h6>
                <ul class="menu-footer">
                    @foreach ($footerTwo as $menu)
                    <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-col-4 col-md-2 col-xs-6">
                <h6 class="mb-20">Quick links</h6>
                <ul class="menu-footer">
                    @foreach ($footerThree as $menu)
                    <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-col-5 col-md-2 col-xs-6">
                <h6 class="mb-20">More</h6>
                <ul class="menu-footer">
                    @foreach ($footerFour as $menu)
                    <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2023. JOBLIST all
                        right
                        reserved</span></div>
                <div class="col-md-6 text-md-end text-start">
                    <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy
                            Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp;
                            Conditions</a><a class="font-xs color-text-paragraph" href="#">Security</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.form-newsletter').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                let form = $(this);
                let button = form.find('button');

                $.ajax({
                    method: 'POST',
                    url: '{{ route('newsletter.store') }}',
                    data: formData,
                    beforeSend: function() {
                        button.text('Processing...').prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            button.text('Subscribed!');
                            setTimeout(() => {
                                button.text('Subscribe');
                            }, 2000);
                            form.trigger('reset');
                            notyf.success(response.message);
                        } else {
                            notyf.error(response.message ||
                                'Subscription failed. Please try again.');
                            button.text('Subscribe');
                        }
                    },
                    error: function(xhr) {
                        let message = 'An error occurred. Please try again.';
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(index, value) {
                                    notyf.error(value[0]);
                                });
                                return;
                            }
                            if (xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                        }
                        notyf.error(message);
                    },
                    complete: function() {
                        // If not already handled in success/error
                        if (button.text() === 'Processing...') {
                            button.text('Subscribe').prop('disabled', false);
                        }
                    }
                });
            });
        });
    </script>
@endpush
