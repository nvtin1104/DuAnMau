<div class="map-section section-top-gap-100" data-aos="fade-up" data-aos-delay="0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124569.49820296704!2d107.94530395123998!3d12.66132297785952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3171f7d4216cd2fb%3A0x9f4a5ec2f999fb4!2zVHAuIEJ1w7RuIE1hIFRodeG7mXQsIMSQ4bqvayBM4bqvaywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1697595709027!5m2!1svi!2s"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...::::End  Map Section:::... -->

<!-- ...::::Start Contact Section:::... -->
<div class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Start Contact Details -->
                <div class="contact-details-wrapper section-top-gap-100" data-aos="fade-up" data-aos-delay="0">
                    <div class="contact-details">
                        <!-- Start Contact Details Single Item -->
                        <div class="contact-details-single-item">
                            <div class="contact-details-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="contact-details-content contact-phone">
                                <a href="tel:<?php echo $inforWebsite['phone'] ?>"><?php echo $inforWebsite['phone'] ?></a>
                            </div>
                        </div> <!-- End Contact Details Single Item -->
                        <!-- Start Contact Details Single Item -->
                        <div class="contact-details-single-item">
                            <div class="contact-details-icon">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                            <div class="contact-details-content contact-phone">
                                <a href="https://www.facebook.com/">BookShop</a>
                            </div>
                        </div> <!-- End Contact Details Single Item -->
                        <!-- Start Contact Details Single Item -->
                        <div class="contact-details-single-item">
                            <div class="contact-details-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="contact-details-content contact-phone">
                                <span><?php echo $inforWebsite['address'] ?></span>
                            </div>
                        </div> <!-- End Contact Details Single Item -->
                    </div>
                    <!-- Start Contact Social Link -->
                    <div class="contact-social">
                        <h4>Theo dõi chúng tôi</h4>
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                        </ul>
                    </div> <!-- End Contact Social Link -->
                </div> <!-- End Contact Details -->
            </div>
            <div class="col-lg-8">
                <div class="contact-form section-top-gap-100" data-aos="fade-up" data-aos-delay="200">
                    <h3>Liên hệ</h3>
                    <form id="contact-form" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="default-form-box mb-20">
                                    <label for="contact-name">Tên</label>
                                    <input name="name" type="text" id="contact-name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="default-form-box mb-20">
                                    <label for="contact-email">Email</label>
                                    <input name="email" type="email" id="contact-email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box mb-20">
                                    <label for="contact-subject">Tiêu đề</label>
                                    <input name="subject" type="text" id="contact-subject">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box mb-20">
                                    <label for="contact-message">Lời nhắn</label>
                                    <textarea name="message" id="contact-message" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-black-default-hover" type="submit">Gửi</button>
                            </div>
                            <p class="form-messege"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>