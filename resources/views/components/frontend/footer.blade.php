@php
    $footer = DB::table('footer_details')->first();

    // Prepare social icons
    $titles = explode(',', $footer->social_titles ?? '');
    $links  = explode(',', $footer->social_links ?? '');
@endphp


<footer id="footer" class="footer light-background">

    @php
        $footer = DB::table('footer_details')->first();
        $titles = explode(',', $footer->social_titles ?? '');
        $links  = explode(',', $footer->social_links ?? '');
    @endphp

    <div class="container footer-top">
        <div class="row gy-4">

            <!-- ABOUT + LOGO -->
            <div class="col-lg-4 col-md-4 footer-about">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('uploads/footer/' . $footer->logo) }}" alt="footer logo">
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ $footer->description }}</p>
                </div>

                <!-- SOCIAL ICONS -->
                <div class="social-links d-flex mt-4">
                    @foreach($titles as $i => $title)
                        @php $url = $links[$i] ?? '#'; @endphp

                        @if($title == 'facebook')
                            <a href="{{ $url }}"><i class="fa-brands fa-facebook-f"></i></a>
                        @elseif($title == 'instagram')
                            <a href="{{ $url }}"><i class="fa-brands fa-instagram"></i></a>
                        @elseif($title == 'youtube')
                            <a href="{{ $url }}"><i class="fa-brands fa-youtube"></i></a>
                        @elseif($title == 'whatsapp')
                            <a href="{{ $url }}"><i class="fa-brands fa-whatsapp"></i></a>
                        @endif

                    @endforeach
                </div>
            </div>

            <div class="col-lg-2 col-md-2"></div>

            <!-- SERVICES -->
            <div class="col-lg-3 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Membership</a></li>
                    <li><a href="#">Private Sector & Academic Specialities</a></li>
                    <li><a href="#">Compare Us</a></li>
                </ul>
            </div>

            <!-- CONTACT INFO -->
            <div class="col-lg-3 col-md-3 footer-links">
                <h4>Contact Info</h4>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="contact-info">
                        <p><a href="#">{{ $footer->address }}</a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="contact-info">
                        <p><a href="tel:{{ $footer->phone }}">{{ $footer->phone }}</a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="contact-info">
                        <p><a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a></p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="container copyright">
        <div class="row">
            <div class="col-md-6">
                <p class="copyright-para">
                    © <span>Copyright</span>
                    <span class="px-1 sitename">DDPU.CO.UK.</span>
                    <span>All Rights Reserved</span>
                </p>
            </div>
            <div class="col-md-6">
                <div class="credits">
                    Designed by <a href="https://www.matrixbricks.com/" target="_blank">Matrix Bricks</a>
                </div>
            </div>
        </div>
    </div>
</footer>
