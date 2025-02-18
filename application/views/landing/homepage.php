    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= base_url('assets/landing/') ?>img/carousel1.png" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="fs-4 text-white animated zoomIn">Welcome to <strong class="text-dark">Jewepe's Dream Weddings</strong></p>
                                    <h1 class="display-1 text-dark mb-4 animated zoomIn">Creating Timeless Memories for Your Love Story</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= base_url('assets/landing/') ?>img/carousel2.png" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="fs-4 text-white animated zoomIn">Welcome to <strong class="text-dark">Jewepe's Dream Weddings</strong></p>
                                    <h1 class="display-1 text-dark mb-4 animated zoomIn">Creating Timeless Memories for Your Love Story</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Article Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid" src="<?= base_url('assets/landing/') ?>img/article2.png" alt="">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">About Us</p>
                        <h1 class="display-6">Wujudkan Pernikahan Impian Anda Bersama Jewepe Dream Weddings</h1>
                    </div>
                    <p class="mb-4">Jewepe Dream Weddings adalah wedding organizer yang berkomitmen untuk membantu Anda mewujudkan pernikahan impian. Kami memahami bahwa pernikahan adalah hari istimewa yang tidak terlupakan, dan kami ingin membantu Anda menciptakan pengalaman yang indah dan berkesan. Dengan dedikasi, pengalaman, dan kreativitas kami, kami siap menjadi mitra terpercaya Anda dalam merencanakan dan melaksanakan pernikahan yang sempurna.</p>
                    <p class="mb-4">Kami percaya bahwa pernikahan adalah tentang lebih dari sekadar perayaan. Ini adalah tentang merayakan cinta, komitmen, dan awal dari babak baru dalam hidup Anda. Kami ingin membantu Anda menciptakan pernikahan yang mencerminkan kisah cinta Anda dan yang akan Anda kenang dengan penuh kasih sayang selama bertahun-tahun yang akan datang.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Article End -->

        <!-- Products Start -->
        <div class="container-fluid product py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Our Galery</p>
                <h1 class="display-6">Capturing Moments Creating Memories</h1>
            </div>
            <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
                <a href="" class="d-block product-item rounded">
                    <img src="<?= base_url('assets/landing/') ?>img/product-1.png" alt="">
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="<?= base_url('assets/landing/') ?>img/product-2.png" alt="">
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="<?= base_url('assets/landing/') ?>img/product-3.png" alt="">
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="<?= base_url('assets/landing/') ?>img/product-4.png" alt="">
                </a>
                <a href="" class="d-block product-item rounded">
                    <img src="<?= base_url('assets/landing/') ?>img/product-5.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Store Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Katalog Paket Pernikahan</p>
                <h1 class="display-6">Pilih Paket dan Buat Kenangan</h1>
            </div>
            <div class="row g-4">
                <?php
                foreach ($getAllCatalog as $row) :
                ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="store-item position-relative text-center">
                        <img class="img-fluid" src="<?= base_url('assets/files/catalog/') . $row->image ?>" alt="">
                        <div class="p-4">
                            <h4 class="mb-3"><?= $row->package_name; ?></h4>
                            <?= word_limiter(strip_tags($row->description), 10);?>
                            <h4 class="text-primary">Rp. <?= number_format($row->price, 2, ",", "."); ?></h4>
                        </div>
                        <div class="store-overlay">
                            <a href="<?= base_url('Homepage/detail?id=') . $row->catalogue_id; ?>" class="btn btn-primary rounded-pill py-2 px-4 m-2">More Detail <i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>

                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <a href="" class="btn btn-primary rounded-pill py-3 px-5">View More Products</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Store End -->


    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5 my-5">
        <div class="container py-5">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-white">Testimonial</p>
                <h1 class="display-6">What our clients say about our team</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.5s">
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4">Jewepe Dream Weddings benar-benar mengerti apa yang kami inginkan. Dari awal hingga akhir, mereka memastikan setiap detail sesuai dengan keinginan kami. Pernikahan kami berjalan sangat lancar dan indah, lebih dari yang pernah kami impikan. Terima kasih, Jewepe Dream Weddings, telah membuat hari spesial kami menjadi begitu sempurna!</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="<?= base_url('assets/landing/') ?>img/testimonial-1.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5>Amanda Putri</h5>
                            <span class="text-primary">Dokter</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4">Kami sangat terkesan dengan profesionalisme dan perhatian terhadap detail yang ditunjukkan oleh tim Jewepe Dream Weddings. Mereka membuat kami merasa tenang dan percaya bahwa pernikahan kami akan berjalan dengan baik. Hasilnya luar biasa! Semua tamu memuji keindahan dan keunikan pernikahan kami. Kami sangat merekomendasikan Jewepe Dream Weddings!</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="<?= base_url('assets/landing/') ?>img/testimonial-2.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5>Cristiano Messi</h5>
                            <span class="text-primary">Pengusaha</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item p-4 p-lg-5">
                    <p class="mb-4">Jewepe Dream Weddings benar-benar ahli dalam mengatur pernikahan yang luar biasa. Mereka mendengarkan semua keinginan kami dan memberikan saran yang sangat berharga. Dekorasi, makanan, dan keseluruhan suasana sangat memukau. Kami sangat berterima kasih atas kerja keras dan dedikasi tim mereka. Pernikahan kami tidak akan sempurna tanpa mereka!</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid flex-shrink-0" src="<?= base_url('assets/landing/') ?>img/testimonial-3.jpg" alt="">
                        <div class="text-start ms-3">
                            <h5>Maya Setiawan</h5>
                            <span class="text-primary">Desainer Grafis</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
<!-- Search Order Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Cek Status Pesanan</p>
            <h1 class="display-6">Masukkan Nama dan Email Anda</h1>
        </div>
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-8">
                <form action="<?= base_url('Homepage/check_order_status') ?>" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary rounded-pill py-3 px-5">Cek Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search Order End -->

    <!-- Contact Start -->
    <div class="container-xxl contact py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Contact Us</p>
                <h1 class="display-6">Contact us right now</h1>
            </div>
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <p class="text-center mb-5">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo</p>
                    <div class="row g-5">
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-envelope fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">info@jewepedreamweddings.com</p>
                            <p class="mb-0">support@jewepedreamweddings.com</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-phone fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">+62 216 1234 5678</p>
                            <p class="mb-0">+62 812 3456 7890</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">Jl. Mimpi Indah No. 123</p>
                            <p class="mb-0">Jakarta, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Start -->