<!doctype html>
<html>

<head>
    <title>Course select</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css">
    <link href="/css/full-height.css" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="page page-main">
        <div class="section">
            <div class="desktop-wide-wrap">
                <div class="action-row">
                    <a href="/" title="Boston firearms" class="logo-03"></a>
                </div>
            </div>
        </div>
        <div class="hero">
            <div class="title"> <strong class=""> <span> Want your license to carry?</span> </strong> </div>
            <div class="subtitle"> We can help. </div>
            <img class="img-mobile" src="/images/hero3.png" alt=""> <img class="img-desktop" src="/images/hero3-desktop.png" alt="">
        </div>
        <div class="main-content">
            <div class="section">
                <div class="desktop-wide-wrap">
                    <div class="steps-section">
                        <div class="title"> How it works </div>
                        <div class="steps">
                            <div class="step">
                                <div class="step-title "> STEP 01 </div>
                                <div class="step-content"> Select the Massachusetts LTC or 39 State Multi License Course below. </div>
                                <div class="step-divider"></div>
                            </div>
                            <div class="step">
                                <div class="step-title "> STEP 02 </div>
                                <div class="step-content"> Schedule and attend your course at 151 Bow street in Everett, MA. We have courses 7 days a week AM/PM. </div>
                                <div class="step-divider"></div>
                            </div>
                            <div class="step">
                                <div class="step-title "> STEP 03 </div>
                                <div class="step-content"> We reward your certificate of completion and help you apply in the states you wish to carry. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="desktop-wide-wrap">
                    <div class="important">
                        <div class="text"> Important </div>
                        <div class="description"> Live fire training is required by most states and cities. You will practice in our indoor range the same day of your course. </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="desktop-wide-wrap">
                    <div class="course-info-section">
                        <div class="info-subtitle"> Which states do you want to carry in? </div>
                        <div class="info-switcher">
                            <div class="info-section-switch <?php echo $session['multiState'] == false ? 'active' : '' ?>" target="switch-1"> I Want<br> To Carry In<br> Massachusetts </div>
                            <div class="info-section-switch <?php echo $session['multiState'] == true ? 'active' : '' ?>" target="switch-2"> I Want<br> To Carry In<br> 39 States </div>
                        </div>
                        <div class="info-section switch-1" style="<?php echo $session['multiState'] == true ? 'display:none' : '' ?>">
                            <div class="info-block price">
                                <div class="cost"> $140 </div>
                                <div> One Time Course </div>
                            </div>
                            <div class="info-block description">
                                <div class=""> <br> Whether you want to carry for self defense, sport or to unlock a new career this course is the first step required to qualify in Massachusetts. <br> <br> </div>
                                <div class="title"> 3 hours or less </div>
                                <div class="title"> One-time course, no ongoing classes required </div>
                                <div class="title"> Dates and times of course available on the calender </div>
                                <div class="button-row"> <a class="button" href="#" style="display: block"> Book Now </a> </div>
                            </div>
                        </div>
                        <div class="info-section switch-2" style="<?php echo $session['multiState'] == false ? 'display:none' : '' ?>">
                            <div class="info-block price">
                                <div class="cost"> $300 </div>
                                <div> One Time Course </div>
                            </div>
                            <div class="info-block description">
                                <div class=""> <br> This course combines 6 state licenses into one class. You will be able to carry in a combined 39 states through license reciprocity.
                                    <!-- <br><br> -->
                                    <!-- This class is for non-residents of states where you'd like to carry, frequent traveller, or current MA license holder who want to expand their carry potential to more states. --> <br> <br>
                                </div>
                                <div class="title"> 3 hours or less </div>
                                <div class="title"> One-time class, no ongoing classes required </div>
                                <div class="title"> Dates and times of course available on the calendar </div>
                                <div class="button-row"> <a class="button" href="#" style="display: block"> Book Now </a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Map section Start -->
            <div class="map-section map-section--select-cource">
                <div class="desktop-wide-wrap">
                    <div class="heading-section">
                        <div class="title"> <strong class=""> What are the 39 states I can carry in? </strong> </div>
                    </div> <!-- <img class="img--mobile" src="<?php // echo APP_ROOT_URL
                                                                ?>images/page-39/map.svg" alt=""> -->
                    <!-- <img class="img--desktop" src="<?php // echo APP_ROOT_URL
                                                        ?>images/page-39/map--desktop.svg" alt=""> -->
                    <img class="img--mobile" src="/images/page-39/map-2.svg" alt="">
                    <img class="img--desktop" src="/images/page-39/map-2.svg" alt="">
                    <div class="map-legends">
                        <div class="desktop-wide-wrap">
                            <div class="legend--one">
                                <div class="legend">
                                    <div class="ico blue"></div>
                                    <div class="title"> Permits issued in these states </div>
                                </div>
                                <div class="legend">
                                    <div class="ico transparent"></div>
                                    <div class="title"> Permit(s) honored in: </div>
                                </div>
                                <div class="legend clear-mobile">
                                    <div class="ico red"></div>
                                    <div class="title"> You can NOT carry </div>
                                </div>
                            </div>
                            <div class="legend--two">
                                <div class="legend">
                                    <div class="title">
                                        <div class="ico transparent"></div> Permit(s) Honored In:
                                    </div>
                                    <div class="description"> Alabama, Alaska, Arizona, Arkansas, Delaware, Georgia, Idaho, Indiana, Iowa, Kansas, Kentucky, Louisiana, Michigan, Mississippi, Missouri, Montana, Nebraska, Nevada, New Mexico, North Carolina, North Dakota, Ohio, Oklahoma, South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia, Wisconsin, Wyoming </div>
                                </div>
                                <div class="legend">
                                    <div class="title">
                                        <div class="ico red"></div> Permit(s) Not Honored In:
                                    </div>
                                    <div class="description"> California, Colorado, District of Columbia, Guam, Hawaii, Illinois, Maryland, Minnesota, New Jersey, New York, Oregon, Puerto Rico, Rhode Island, South Carolina, Virgin Islands, American Samoa, N. Mariana Islands </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Map section End -->
            </div>
            <div class="testimonial-section">
                <div class="testimonial">
                    <div class="desktop-wide-wrap">
                        <div class="testimonial-title"> Over 2000+ Google Reviews </div>
                    </div>
                    <div class="gr-carousel">
                        <div class="gr-item">
                            <div class="testimonial-ico"></div>
                            <div class="testimonial-date"> 01/04 </div>
                            <div class="testimonial-text"> This is by far one of the best classes in the area and we walked out with a lot of knowledge. They also have other classes that we are looking forward to taking. Check them out, you won't be disappointed! </div>
                            <div class="testimonial-image-row">
                                <div class="testimonial-image"> <img src="/images/user1.png" alt=""> </div>
                            </div>
                        </div>
                        <div class="gr-item">
                            <div class="testimonial-ico"></div>
                            <div class="testimonial-date"> 02/04 </div>
                            <div class="testimonial-text"> I took the basic training course here and the instructor was great. He was very helpful for the entire class even for those who had never held a firearm in their life before. </div>
                            <div class="testimonial-image-row">
                                <div class="testimonial-image"> <img src="/images/user2.png" alt=""> </div>
                            </div>
                        </div>
                        <div class="gr-item">
                            <div class="testimonial-ico"></div>
                            <div class="testimonial-date"> 03/04 </div>
                            <div class="testimonial-text"> My basic firearm safety training at Boston firearms was the best relaxing experience ever. My instructor Thomas is a great teacher. He's very thorough, methodological, patient and funny. Once he walks in the classroom all your anxieties are gone. </div>
                            <div class="testimonial-image-row">
                                <div class="testimonial-image"> <img src="/images/user3.png" alt=""> </div>
                            </div>
                        </div>
                        <div class="gr-item">
                            <div class="testimonial-ico"></div>
                            <div class="testimonial-date"> 04/04 </div>
                            <div class="testimonial-text"> Excellent instructor who was very observant as to how we were progressing through the material. He had a good sense of when to stop and re-emphasize a point. </div>
                            <div class="testimonial-image-row">
                                <div class="testimonial-image"> <img src="/images/user4.png" alt=""> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- FAQ Start -->
            <div class="faq-section--responsive">
                <div class="desktop-wide-wrap">
                    <div class="faq-section">
                        <div class="faq-section-title"> FAQs </div>
                        <div class="faq-list">
                            <div class="faq">
                                <div class="title"> What if I already have my Massachusetts LTC? <br> </div>
                                <div class="description"> No worries, you can still take this class. If you took your MA LTC course with us we will give you a discount on the 39 State Multi License Course. </div>
                            </div>
                            <div class="faq">
                                <div class="title"> Do I need to take the Massachusetts course first? <br> </div>
                                <div class="description"> No you only need to apply to 6 states which will grant you 39 state reciprocity. The 6 states are MA,UT,FL,ME,NH,CT. </div>
                            </div>
                            <div class="faq">
                                <div class="title"> What are the 39 states I can carry in? <br> </div>
                                <div class="description"> You will apply for 6 state licenses after completing the course. Massachusetts, Connecticut, Utah, Florida, Maine, New Hamphire and Connecticut. Which will allow reciprocity in these states. Alabama, Alaska, Arizona, Arkansas, Delaware, Georgia, Idaho, Indiana, Iowa, Kansas, Kentucky, Louisiana, Michigan, Mississippi, Missouri, Montana, Nebraska, Nevada, New Mexico, North Carolina, North Dakota, Ohio, Oklahoma, South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia, Wisconsin, Wyoming. </div>
                            </div>
                            <div class="faq">
                                <div class="title"> What about constitutional carry states? <br> </div>
                                <div class="description"> For states like New Hampshire which allow constitutional carry you do not need to apply. These states are already included in the 39 states of reciprocity. </div>
                            </div>
                            <div class="faq">
                                <div class="title"> Does my city allow me to get a license? <br> </div>
                                <div class="description"> Most cities will give you your license to carry. Some cities are a bit more strict and may give you a restricted LTC. You will learn how to prevent this from happening in our course. </div>
                            </div>
                            <div class="faq">
                                <div class="title"> Do I need to own a firearm to attend class? <br> </div>
                                <div class="description"> No, we will provide you with the required equipment to practice in our indoor range the day of your class. </div>
                            </div>
                            <div class="faq">
                                <div class="title"> How many times do I need to take the class? <br> </div>
                                <div class="description"> One time, but we do reccommend you continue to practice your shooting skills. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- FAQ End -->
            <a style="margin-bottom:25px;" class="button" href="#" style="display: block"> Book Now </a>
        </div>
        <!-- Location Start -->
        <div class="location-section ">
            <div class="desktop-wide-wrap">
                <div class="location-section--inner">
                    <p class="title">Location</p>
                    <p class="location"> 151 Bow Street, Everett MA 02143 </p>
                    <p class="bottom"> Accessible by public transportation <span> I </span> <br> FREE parking available at location </p>
                </div>
            </div>
        </div> <!-- Location End -->
        <div class="footer-39">
            <div class="desktop-wide-wrap">
                <p>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                </p>
                <div class="bottom-title"> 2020 Boston Fight Center LLC All Rights Reserved </div>
            </div>
        </div>
    </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="/js/quiz-cources-choose.js" type="text/javascript"> </script>
        <script src="/js/quiz-carousel.js" type="text/javascript"> </script>
        <script src="/js/quiz-faq.js" type="text/javascript"> </script>
        <script src="/js/mobile-menu.js" type="text/javascript"> </script>
</body>

</html>
