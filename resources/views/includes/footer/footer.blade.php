<div class="footer-grey">
    <div class="desktop-wide-wrap">
        <div class="row-1">
            <div class="col col-1">
                <a href="/" title="Boston firearms" class="logo-03"></a>
                <div class="text">
                    The training staff at office Boston Firearms has been serving gun-enthusiasts for years, and we plan to continue serving more the best way we can.
                </div>
                <div class="link">
                    <a href="{{ route('classes') }}">Book Your Class Now</a>
                </div>

            </div>
            <div class="col col-2">
                <p>Important Links</p>
                <div class="links">
                    <p>
                        <a href="{{ route('about-us') }}">
                            About Us
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('classes') }}">
                            Classes
                        </a>
                    </p>

                    <p>
                        <a href="{{ route('class.page', ['mass-basic-firearm-safety-course']) }}">
                            MA LTC
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('class.page', ['non-resident-multi-state-license']) }}">
                            38 State License
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('contact-us') }}">
                            Contact Us
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('privacy') }}">
                            Privacy Policy
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('terms') }}">
                            Terms & Conditions
                        </a>
                    </p>

                </div>
            </div>
            <div class="col col-3">
                <p>Contact Us</p>
                <div class="contact-block">
                    <a href="#" class="pin">
                        <div class="ico pin-footer-blue"></div>
                        151 Bow Street, Everett MA 02143
                    </a>
                    <span>
                        (Accessible by public transportation, FREE parking available at location)
                    </span>

                    <a href="tel:(617) 944-0985" class="phone">
                        <div class="ico phone-footer-blue"></div>
                        (617) 944-0985
                    </a>
                    <span>
                        If you have any questions please call us
                    </span>

                </div>
                <div class="social-footer">
                    <a href="https://www.facebook.com/bostonfirearms" class="" target="_blank">
                        <div class="ico ico-fb--footer-blue"></div>
                    </a>
                    <a href="https://twitter.com/bostonfight" target="_blank" class="">
                        <div class="ico ico-tw--footer-blue"></div>
                    </a>

                    {{--<a href="#" class="" target="_blank">
                        <div class="ico ico-in--footer-blue"></div>
                    </a>--}}
                </div>
            </div>
        </div>
        <div class="row-2">
            Copyright (c) {{now()->format('Y')}} Boston Firearms | All Rights Reserved. | Boston Firearms Training Center a subsidiary of Boston Fight Center LLC
        </div>
    </div>
</div>
