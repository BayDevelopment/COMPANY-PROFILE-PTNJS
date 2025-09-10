<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>
<style>
    /* Partner */
    .section_partner {
        padding: 56px 0 8px;
    }

    .partner-title {
        text-align: center;
        font-weight: 800;
        margin-bottom: 1.25rem;
    }

    .partner-carousel .item {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px;
    }

    .img_owl_carousel {
        max-height: 60px;
        width: auto;
        filter: grayscale(100%);
        opacity: .85;
        transition: .25s ease;
    }

    .img_owl_carousel:hover {
        filter: grayscale(0);
        opacity: 1;
        transform: translateY(-2px);
    }

    /* Fade-up on view */
    .fade-up {
        opacity: 0;
        transform: translateY(14px);
        transition: all .55s ease;
    }

    .fade-up.in-view {
        opacity: 1;
        transform: none;
    }
</style>
<section class="section_head">
    <div class="container">
        <div class="cover_page_title">
            <div class="head-page-title">
                <?= esc($page_title) ?>
            </div>
            <p class="text_contact">Bagaimana kami bisa membantu?.</p>
        </div>
    </div>
</section>


<section class="section_content_contact">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.7033067619536!2d106.06601767498778!3d-5.897235494086697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4195d2f0d0deb7%3A0x7d4654a95ed4aede!2sPT.%20NAJWA%20JAYA%20SUKSES!5e0!3m2!1sid!2sid!4v1738515771542!5m2!1sid!2sid" class="iframe_native_contact" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="cover_card_form">
        <h6 class="judul_form">
            Hubungi Kami
        </h6>
        <form action="<?= site_url('/pages/contact') ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label for="name_contact" class="form-label">Name</label>
                <input type="text" class="form-control fc_native" id="name_contact" name="name" value="<?= old('name') ?>" required>
                <?php if (session()->getFlashdata('sweet_errors') && isset(session()->getFlashdata('sweet_errors')['name'])): ?>
                    <span class="text-danger"><?= session()->getFlashdata('sweet_errors')['name']; ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email_contact" class="form-label">Email address</label>
                <input type="email" class="form-control fc_native" id="email_contact" value="<?= old('email') ?>" name="email" required>
                <div id="emailHelp" class="form-text">Kami tidak akan membagikan kepada siapapun.</div>
                <?php if (session()->getFlashdata('sweet_errors') && isset(session()->getFlashdata('sweet_errors')['email'])): ?>
                    <span class="text-danger"><?= session()->getFlashdata('sweet_errors')['email']; ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="pesan_contact" class="form-label">Message</label>
                <textarea class="form-control fc_native" id="pesan_contact" rows="3" name="message" required><?= old('message') ?></textarea>
                <?php if (session()->getFlashdata('sweet_errors') && isset(session()->getFlashdata('sweet_errors')['message'])): ?>
                    <span class="text-danger"><?= session()->getFlashdata('sweet_errors')['message']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Kirim ke sistem (simpan/email) -->
            <button type="submit" class="btn btn-shiny border-0">Kirim</button>

            <!-- Kirim via WhatsApp (POST ke /pages/pesan-wa) -->
            <button type="submit"
                formaction="<?= site_url('/pages/pesan-wa') ?>"
                class="btn btn-shiny border-0">
                <i class="fa-brands fa-whatsapp me-1"></i> Whatsapp
            </button>
        </form>

    </div>
</section>

<!-- our partner -->
<section class="section_partner fade-up">
    <div class="cover_owl_content">
        <div class="owl-carousel owl-theme partner-carousel">
            <div class="item">
                <img src="<?= base_url('/assets/img/benua-partner.png') ?>" class="img_owl_carousel" alt="Benua Partner" loading="lazy">
            </div>
            <div class="item">
                <img src="<?= base_url('/assets/img/Econindo-partner.png') ?>" class="img_owl_carousel" alt="Econindo Partner" loading="lazy">
            </div>
            <div class="item">
                <img src="<?= base_url('/assets/img/fajar-partner.jpeg') ?>" class="img_owl_carousel" alt="Fajar Partner" loading="lazy">
            </div>
            <div class="item">
                <img src="<?= base_url('/assets/img/spektrum-partner.jpg') ?>" class="img_owl_carousel" alt="Spektrum Partner" loading="lazy">
            </div>
        </div>
    </div>
</section>
<script>
    // Fade-up on view
    (function() {
        const els = document.querySelectorAll('.fade-up');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in-view');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: .14
        });
        els.forEach(el => io.observe(el));
    })();
    // Owl init (pastikan Owl sudah di-include di layout)
    $('.partner-carousel').owlCarousel({
        loop: true,
        margin: 18,
        autoplay: true,
        autoplayTimeout: 2500,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    });
</script>
<?= $this->endSection() ?>