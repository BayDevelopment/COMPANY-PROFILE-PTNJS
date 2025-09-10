<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>

<style>
    /* Tanpa mengubah warna brand—hanya tata letak & estetika */
    .page-head {
        padding: 56px 0 12px;
        text-align: center;
    }

    .page-head .head-page-title {
        font-weight: 800;
        letter-spacing: .2px;
        margin-bottom: .5rem;
    }

    .text_p_translite {
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }

    .card_cooperation {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(16, 24, 40, .08);
        overflow: hidden;
        background: linear-gradient(180deg, #fff, #f8fafc);
    }

    .card_cooperation .card-head {
        padding: 20px 24px 0;
    }

    .cover_form_cooperation {
        padding: 24px;
    }

    .input-group-text {
        background: #fff;
        border-right: 0;
    }

    .form-control.fc_native,
    .form-select.fc_native {
        border-left: 0;
    }

    .form-control.fc_native:focus,
    .form-select.fc_native:focus {
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
    }

    .small-help {
        color: #6c757d;
        font-size: .875rem;
    }

    .upload-note {
        color: #6c757d;
        font-size: .85rem;
    }

    .btn-block {
        display: flex;
        gap: .5rem;
    }

    @media (max-width: 576px) {
        .btn-block {
            flex-direction: column;
        }
    }

    /* Alert success */
    .alert i {
        margin-right: .35rem;
    }

    /* Overlay loading submit */
    .submit-overlay {
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, .85);
        backdrop-filter: blur(3px);
        display: none;
        /* hidden by default */
        align-items: center;
        justify-content: center;
        z-index: 1055;
    }

    .submit-overlay .box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 32px rgba(16, 24, 40, .14);
        padding: 18px 22px;
        text-align: center;
        min-width: 240px;
    }

    .submit-overlay .box .label {
        margin-top: .75rem;
        font-weight: 600;
    }

    .submit-overlay .box .hint {
        margin-top: .25rem;
        font-size: .85rem;
        color: #6c757d;
    }

    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    body {
        font-family: "Poppins", serif;
    }

    .native_logo {
        width: 40px;
    }

    .alert_about {
        margin-top: 100px;
    }

    .cover_paragraft {
        padding: 10px;
        justify-content: center;
        text-align: center;
    }

    .cover_img_empty {
        justify-content: center;
        text-align: center;
        padding: 10px;
    }

    .size_img_empty {
        width: 300px;
    }

    .caption_img_empty {
        font-size: 21px;
        font-weight: 500;
        justify-content: center;
        text-align: center;
    }

    .fc_native {
        border: none;
        border-radius: none;
        border-bottom: 1px solid rgb(255, 215, 69);
        box-shadow: none;
    }

    .fc_native:focus {
        border: none;
        border-radius: none;
        border-bottom: 1px solid rgb(255, 215, 69);
        box-shadow: none;
    }

    .card_cooperation {
        padding: 10px;
        width: 800px;
        margin: auto;
        box-shadow: rgba(255, 222, 76, 0.801) 0px 10px 15px -3px,
            rgba(255, 219, 16, 0.76) 0px 4px 6px -2px;
        margin-bottom: 20px;
        border-radius: 15px;
    }

    .active_native_outline {
        padding: 10px;
        background-color: white;
        border: 1px solid rgb(248, 192, 7);
        color: rgb(248, 192, 7);
        transition: 0.2s;
        text-decoration: none;
    }

    .active_native_outline:hover {
        padding: 10px;
        background-color: rgb(248, 192, 7);
        border: 1px solid rgb(248, 192, 7);
        color: white;
        transition: 0.2s;
        text-decoration: none;
    }

    .bg-native {
        background-color: white;
        box-shadow: rgba(37, 37, 37, 0.938) 0px 10px 10px -10px;
    }

    .native_carousel {
        max-width: 100%;
        background: linear-gradient(rgba(20, 20, 20, 0.233), rgba(20, 20, 20, 0.911)),
            url(/assets/img/jumbo_new.jpg);
        min-height: 100vh;
        background-size: cover;
    }

    .judul_carousel {
        margin-top: -250px !important;
        font-size: 28px;
        font-weight: bold;
        /* Gaya font */
        background: rgb(226, 226, 226);
        background: linear-gradient(90deg,
                rgba(226, 226, 226, 1) 0%,
                rgba(244, 220, 34, 0.82) 0%,
                rgba(244, 244, 244, 0.99) 62%);
        background-clip: text;
        color: transparent;
        /* Menghapus warna teks asli */
        -webkit-background-clip: text;
        /* Masih menjaga kompatibilitas untuk beberapa browser */
    }

    .active_native {
        font-weight: 500;
        color: rgb(248, 192, 7);
    }

    .active_native:hover {
        font-weight: 500;
        color: rgb(248, 192, 7);
    }

    .font_native {
        position: relative;
        text-decoration: none;
        color: black;
        /* Warna teks */
    }

    .font_native:hover {
        position: relative;
        text-decoration: none;
        color: rgb(248, 192, 7);
        /* Warna teks */
    }

    .font_native::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        /* Ketebalan garis */
        background-color: rgb(248, 192, 7);
        /* Warna garis */
        transition: width 0.3s ease;
        /* Efek transisi untuk animasi */
    }

    .font_native:hover::before {
        width: 100%;
        /* Lebar garis saat hover */
    }

    .section_one {
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 15px;
        height: 80vh;
    }

    .spacing_one {
        margin-top: 50px;
    }

    .judul_col {
        font-size: 32px;
        color: black;
    }

    .paragraft_native {
        font-size: 21px;
        color: rgb(66, 66, 66);
        line-height: 2.4;
        font-weight: 300;
    }

    .span_date {
        font-size: 15px;
        padding: 5px;
        font-weight: 500;
    }

    .img_native {
        margin: auto;
        justify-content: start;
        text-align: start;
        width: 310px;
        border-radius: 10px;
        box-shadow: rgba(250, 215, 17, 0.562) 1.95px 1.95px 2.6px;
    }

    .btn_a_public {
        padding: 15px;
        background-color: white;
        color: rgb(248, 192, 7);
        border: 1px solid rgb(248, 192, 7);
        font-weight: 500;
        transition: 0.2s;
        text-decoration: none;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
            rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }

    .btn_a_public:hover {
        padding: 15px;
        background-color: rgb(248, 192, 7);
        border: 1px solid rgb(248, 192, 7);
        color: white;
        transition: 0.2s;
        text-decoration: none;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
            rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }

    .btn_a_native {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #fae20dff, #fae20dff);
        color: #fff;
        padding: 0.55rem 1.3rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.3s ease, box-shadow 0.3s ease, color 0.3s ease;
        /* transition cukup untuk warna/box-shadow saja, bukan all */
        position: relative;
        overflow: hidden;
    }

    .btn_a_native i {
        font-size: 0.85rem;
    }

    .btn_a_native::before {
        content: "";
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, 0.3);
        transition: left 0.5s;
        /* hanya animasi posisi left */
    }

    .btn_a_native:hover::before {
        left: 130%;
    }

    .btn_a_native:hover {
        box-shadow: 0 6px 16px rgba(253, 237, 13, 0.4);
        color: #fff;
    }

    /* section two */
    .section_two {
        background-image: url(/assets/img/dott.jpg);
        width: 100%;
        height: 90vh;
        padding: 15px;
    }

    .judul_section {
        position: relative;
        font-size: 32px;
        color: black;
        justify-content: start;
        text-align: start;
        padding: 10px;
        margin-bottom: 30px;
    }

    .judul_section::after {
        content: "";
        display: block;
        width: 300px;
        height: 2px;
        /* Ketebalan garis */
        background: rgb(2, 0, 36);
        background: linear-gradient(90deg,
                rgba(2, 0, 36, 1) 0%,
                rgba(246, 236, 81, 1) 96%);
        position: absolute;
        bottom: 0;
        left: 0;
        animation: garisAnimasi0 2s infinite alternate;
    }

    @keyframes garisAnimasi0 {
        0% {
            width: 100px;
        }

        100% {
            width: 300px;
            /* Panjang maksimum yang diinginkan */
        }
    }

    .card {
        box-shadow: rgba(250, 215, 17, 0.562) 1.95px 1.95px 2.6px;
    }

    .cover_opsi_project {
        padding: 5px;
        justify-content: center;
        text-align: center;
        margin-top: -20px;
        margin-bottom: 10px;
    }

    .cover_link_native {
        margin-top: 40px;
        justify-content: center;
        text-align: center;
    }

    .cover_link_native_project {
        margin-top: 30px;
        justify-content: center;
        text-align: center;
    }

    .card-img-top {
        height: 30vh;
        background-attachment: fixed;
        background-size: cover;
    }

    /* sectio tree */
    .section_tree {
        padding: 10px;
        height: 80vh;
    }

    /* section patner */
    .section_partner {
        padding: 20px;
    }

    .img_owl_carousel {
        width: 150px;
        padding: 15px;
        height: 100px;
    }

    .owl-stage-outer {
        width: auto;
        margin: auto;
        justify-content: center;
        text-align: center;
    }

    /* section_count */
    .section_count_project {
        padding: 15px;
        margin-top: 50px;
    }

    .judul_count {
        position: relative;
        font-size: 32px;
        color: black;
        justify-content: start;
        text-align: start;
        padding: 10px;
        margin-bottom: 30px;
    }

    .judul_count::after {
        content: "";
        display: block;
        width: 100px;
        height: 4px;
        /* Ketebalan garis */
        background: rgb(2, 0, 36);
        background: linear-gradient(90deg,
                rgba(2, 0, 36, 1) 0%,
                rgba(246, 236, 81, 1) 96%);
        position: absolute;
        bottom: 0;
        left: 0;
        animation: garisAnimasi 2s infinite alternate;
    }

    @keyframes garisAnimasi {
        0% {
            width: 100px;
        }

        100% {
            width: 200px;
            /* Panjang maksimum yang diinginkan */
        }
    }

    .body_count_project {
        min-height: auto;
        background: rgb(255, 255, 255);
        background: linear-gradient(90deg,
                rgba(255, 255, 255, 1) 4%,
                rgba(244, 220, 34, 0.8211659663865546) 79%,
                rgba(255, 255, 255, 0.989233193277311) 100%);
        padding: 5px;
        margin-top: 10px;
    }

    .native_footer_logo {
        width: 60px;
        margin: auto;
    }

    .cover_head_count {
        padding: 15px;
    }

    .body_col_count {
        padding: 15px;
        justify-content: center;
        text-align: center;
        box-shadow: rgba(0, 0, 0, 0.295) 1.95px 1.95px 2.6px;
        margin-top: 10px;
    }

    .count {
        font-size: 32px;
    }

    .text_count {
        font-size: 24px;
    }

    /* about */
    .head-page-title {
        position: relative;
        display: block;
        /* Menjamin elemen berada dalam satu baris */
        padding: 10px;
        background-color: rgb(124, 122, 122);
        font-size: 28px;
        font-weight: 400;
        /* Gaya font */
        background: rgb(226, 226, 226);
        background: linear-gradient(90deg,
                rgba(226, 226, 226, 1) 0%,
                rgb(244, 220, 34) 100%,
                rgba(244, 244, 244, 0.989233193277311) 62%);
        -webkit-background-clip: text;
        /* Menyusun gradient hanya pada teks */
        color: transparent;
        /* Menghapus warna teks asli */
        justify-content: center;
        text-align: center;
    }

    .head-page-title::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        /* Menyelaraskan garis agar tepat di tengah */
        width: 100px;
        /* Menyesuaikan lebar garis */
        height: 2px;
        /* Tebal garis bawah */
        background-color: rgba(248, 192, 7, 0.479);
        /* Warna garis bawah */
    }

    .cover_page_title {
        padding: 5px;
        margin-top: 100px;
        margin-bottom: 25px;
    }

    .cover_img_head {
        justify-content: center;
        text-align: center;
        padding: 10px;
    }

    .size_img_head {
        box-shadow: 1px 2px 3px rgb(255, 183, 27);
        width: 300px;
    }

    .cover_judul_two {
        padding: 10px;
        margin-top: 25px;
        margin-bottom: 25px;
        width: 500px;
        justify-content: start;
        text-align: start;
        background-color: rgba(247, 247, 247, 0.74);
        border-left: 2px solid rgb(255, 183, 27);
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

    .cover_paragraft_two {
        margin-bottom: 25px;
    }

    .title_two {
        font-size: 28px;
        font-weight: 400;
        /* Gaya font */
        background: linear-gradient(90deg,
                rgba(226, 226, 226, 1) 0%,
                rgb(244, 220, 34) 50%,
                /* Sesuaikan posisi warna */
                rgba(244, 244, 244, 0.99) 100%);
        -webkit-background-clip: text;
        /* Menyusun gradien hanya pada teks */
        color: transparent;
        /* Menghapus warna teks asli agar gradien terlihat */
    }

    .paragraft_two {
        font-size: 19px;
        line-height: 1.9;
        color: rgba(124, 124, 124, 0.815);
    }

    /* Visi dan misi */
    .visi,
    .misi {
        font-size: 21px;
        color: rgb(255, 183, 27);
        font-weight: 500;
    }

    .opsi-semifooter {
        justify-content: center;
        text-align: center;
        padding: 10px;
    }

    .native_a_semifooter_none {
        text-decoration: none;
        color: rgba(255, 183, 27, 0.493);
        font-size: 21px;
        transition: 0.2s;
        cursor: auto;
    }

    .native_a_semifooter {
        text-decoration: none;
        color: rgb(255, 183, 27);
        font-size: 21px;
        transition: 0.2s;
    }

    .native_a_semifooter:hover {
        text-decoration: none;
        color: rgb(255, 183, 27);
        font-size: 21px;
        transition: 0.2s;
        transform: translateY(-5%);
    }

    .section_content_services {
        margin-bottom: 50px;
    }

    .text_services {
        font-size: 16px;
        font-weight: 400;
        color: rgba(124, 124, 124, 0.815);
        text-align: center;
        padding: 5px;
        line-height: 1.5;
    }

    /* section footer */
    .section_footer {
        min-height: auto;
        padding: 15px;
        background: rgb(226, 226, 226);
        background: linear-gradient(90deg,
                rgba(226, 226, 226, 1) 4%,
                rgba(244, 220, 34, 0.8211659663865546) 25%,
                rgba(244, 244, 244, 0.989233193277311) 88%);
    }

    footer {
        background: rgb(226, 226, 226);
        background: linear-gradient(90deg,
                rgba(226, 226, 226, 1) 4%,
                rgba(244, 220, 34, 0.8211659663865546) 25%,
                rgba(244, 244, 244, 0.989233193277311) 88%);
    }

    .text_footer {
        margin-bottom: -10px;
        padding: 10px;
        justify-content: center;
        text-align: center;
        position: relative;
        text-decoration: none;
        color: black;
        /* Warna teks */
    }

    .text_footer ::before {
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        /* Posisi dari kiri 50% */
        transform: translateX(-50%);
        /* Menggeser garis ke kiri agar berada di tengah */
        width: 50%;
        /* Lebar garis 50% dari lebar elemen */
        height: 1px;
        /* Ketebalan garis */
        background-color: rgba(136, 134, 134, 0.801);
        /* Warna garis hitam */
    }

    .judul_footer {
        font-size: 19px;
    }

    .native_link {
        transition: 0.2s;
        color: white;
    }

    .native_link:hover {
        transition: 0.2s;
        color: rgb(248, 192, 7);
        transform: translateX(2%);
    }

    .native_location {
        transition: 0.2s;
        color: white;
    }

    .native_location:hover {
        transition: 0.2s;
        color: rgb(248, 192, 7);
    }

    .text-link {
        transition: 0.2s;
        color: black;
        font-weight: 500;
    }

    .text-link:hover {
        transition: 0.2s;
        color: rgb(248, 192, 7);
    }

    .iframe_native {
        box-shadow: 1px 2px 3px rgb(248, 192, 7);
        width: auto;
        height: auto;
    }

    .nav_desktop {
        display: none;
    }

    .nav_mobile {
        display: block;
    }

    /* contact */
    .text_contact {
        font-size: 32px;
        font-weight: 400;
        color: rgb(95, 95, 95);
        padding: 10px;
        background-color: rgba(247, 244, 244, 0.473);
        margin-top: 50px;
        border-left: 2px solid rgb(248, 192, 7);
    }

    .judul_form {
        position: relative;
        font-size: 27px;
        color: black;
        justify-content: start;
        text-align: start;
        padding: 10px;
        margin-bottom: 30px;
    }

    .judul_form::after {
        content: "";
        display: block;
        width: 100px;
        height: 1.9px;
        /* Ketebalan garis */
        background: rgb(2, 0, 36);
        background: linear-gradient(90deg,
                rgba(2, 0, 36, 1) 0%,
                rgba(246, 236, 81, 1) 96%);
        position: absolute;
        bottom: 0;
        left: 0;
        animation: garisAnimasi 2s infinite alternate;
    }

    .fl_proposal::after {
        content: " (PDF - Maks 1MB)";
        font-weight: bold;
        color: red;
        margin-left: 5px;
        font-size: 14px;
        display: inline-block;
        vertical-align: middle;
    }

    .fl_perusahaan::after {
        content: " (PDF, JPG, JPEG, PNG - Maks 1MB)";
        font-weight: bold;
        color: red;
        margin-left: 5px;
        font-size: 14px;
        display: inline-block;
        vertical-align: middle;
    }

    .fl_dnpwp::after {
        content: " (PDF, JPG, JPEG, PNG - Maks 1MB)";
        font-weight: bold;
        color: red;
        margin-left: 5px;
        font-size: 14px;
        display: inline-block;
        vertical-align: middle;
    }

    .fl_sp::after {
        content: " (PDF - Maks 1MB)";
        font-weight: bold;
        color: red;
        margin-left: 5px;
        font-size: 14px;
        display: inline-block;
        vertical-align: middle;
    }

    .section_content_contact {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
    }

    .iframe_native_contact {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        /* Pastikan iframe ada di bawah */
    }

    .cover_card_form {
        position: relative;
        z-index: 2;
        /* Pastikan form berada di atas iframe */
        background: rgba(255, 255, 255, 0.8);
        /* Warna putih dengan transparansi 80% */
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        /* Efek blur pada background */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        width: 400px;
    }

    .text_p_translite {
        font-size: 18px;
        color: black;
    }

    .coo_active {
        background-color: rgb(248, 192, 7);
        color: white;
    }

    .cover_form_cooperation {
        padding: 20px;
    }

    /*  */
    @media screen and (min-width: 768px) {
        .native_carousel {
            max-width: 100%;
            background: linear-gradient(rgba(20, 20, 20, 0.233),
                    rgba(20, 20, 20, 0.911)),
                url(/assets/img/jumbo_new.jpg);
            min-height: 100vh;
            background-size: cover;
            background-position: right;
        }

        .nav_desktop {
            display: block;
        }

        .nav_mobile {
            display: none;
        }

        .active_native_outline {
            justify-content: center;
            text-align: center;
        }
    }

    /* ===== FINAL: Mobile-first responsive overrides ===== */

    /* Card cooperation: no fixed width */
    .card_cooperation {
        width: 100%;
        max-width: 980px;
        margin: 0 auto 20px;
        padding: clamp(12px, 3.5vw, 28px);
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(16, 24, 40, .08);
        background: linear-gradient(180deg, #fff, #f8fafc);
    }

    /* Inner spacing */
    .cover_form_cooperation {
        padding: clamp(12px, 3.5vw, 24px);
    }

    /* Input group tidy */
    .input-group-text {
        background: #fff;
        border-right: 0;
    }

    .form-control.fc_native,
    .form-select.fc_native {
        border-left: 0;
    }

    /* Card images scale nicely */
    .card-img-top {
        width: 100%;
        height: auto;
        /* keep aspect ratio */
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    /* Avoid rigid sizes */
    .size_img_empty {
        width: min(100%, 300px);
    }

    .native_logo {
        width: 40px;
        max-width: 100%;
    }

    /* Floating form panel width */
    .cover_card_form {
        width: min(100%, 420px);
    }

    /* Sections: no forced viewport height */
    .section_one,
    .section_two,
    .section_tree {
        height: auto;
        min-height: unset;
        background-size: cover;
        background-position: center;
    }

    /* Buttons group stacks on mobile */
    .btn-block {
        display: flex;
        gap: .5rem;
    }

    @media (max-width: 576px) {
        .btn-block {
            flex-direction: column;
        }
    }

    /* Tablet & down */
    @media (max-width: 768px) {
        .page-head {
            padding: 40px 0 10px;
        }

        .card-img-top {
            max-height: 260px;
        }

        .judul_section,
        .judul_count {
            font-size: 24px;
        }

        .paragraft_two,
        .text_services {
            font-size: 16px;
            line-height: 1.7;
        }

        .text_contact {
            font-size: 20px;
        }

        .img_native {
            width: min(100%, 320px);
        }
    }

    /* Phones */
    @media (max-width: 480px) {
        .head-page-title {
            font-size: 22px;
        }

        .text_p_translite {
            font-size: 14px;
            padding: 0 8px;
        }

        .judul_section,
        .judul_count {
            font-size: 20px;
        }

        .judul_carousel {
            font-size: 16px;
            margin-top: 0 !important;
        }

        .btn_a_native {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container">
    <!-- Overlay Loading -->
    <div id="submitOverlay" class="submit-overlay" aria-hidden="true">
        <div class="box">
            <div class="spinner-border" role="status" aria-hidden="true"></div>
            <div class="label">Mengunggah berkas…</div>
            <div class="hint">Mohon tunggu, jangan tutup halaman.</div>
        </div>
    </div>

    <!-- Page Title -->
    <div class="page-head">
        <div class="cover_page_title">
            <div class="head-page-title h2 mb-0">
                <?= esc($page_title) ?>
            </div>
            <p class="text_p_translite mt-2"><?= esc($translite) ?></p>
        </div>
    </div>

    <!-- Card Cooperation -->
    <div class="card_cooperation mb-4">
        <div class="card-head">
            <?php if (session()->getFlashdata('sweet_success')) : ?>
                <div class="alert alert-success d-flex align-items-center mt-2" role="alert">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Pengajuan kerja sama telah berhasil diproses. Kami akan segera menghubungi Anda.</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="cover_form_cooperation">
            <form action="<?= site_url('/pages/cooperation') ?>" method="post" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>
                <?php $errors = session()->get('errors') ?? []; ?>

                <div class="row g-3">
                    <!-- Nama Perusahaan -->
                    <div class="col-md-6">
                        <label for="nama_perusahaan" class="form-label">Nama perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                            <input
                                type="text"
                                class="form-control fc_native <?= isset($errors['nama_perusahaan']) ? 'is-invalid' : '' ?>"
                                id="nama_perusahaan"
                                name="nama_perusahaan"
                                placeholder="Masukan nama perusahaan"
                                value="<?= old('nama_perusahaan') ?>"
                                required>
                            <div class="invalid-feedback">
                                <?= isset($errors['nama_perusahaan']) ? $errors['nama_perusahaan'] : 'Nama perusahaan wajib diisi.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Penanggung Jawab -->
                    <div class="col-md-6">
                        <label for="penanggung_jawab" class="form-label">Penanggung jawab</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                            <input
                                type="text"
                                class="form-control fc_native <?= isset($errors['penanggung_jawab']) ? 'is-invalid' : '' ?>"
                                id="penanggung_jawab"
                                name="penanggung_jawab"
                                placeholder="Masukan nama penanggung jawab"
                                value="<?= old('penanggung_jawab') ?>"
                                required>
                            <div class="invalid-feedback">
                                <?= isset($errors['penanggung_jawab']) ? $errors['penanggung_jawab'] : 'Penanggung jawab wajib diisi.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Perusahaan -->
                    <div class="col-12">
                        <label for="alamat_perusahaan" class="form-label">Alamat perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                            <textarea
                                class="form-control fc_native <?= isset($errors['alamat_perusahaan']) ? 'is-invalid' : '' ?>"
                                id="alamat_perusahaan"
                                name="alamat_perusahaan"
                                placeholder="Masukan alamat perusahaan"
                                rows="3"
                                required><?= old('alamat_perusahaan') ?></textarea>
                            <div class="invalid-feedback">
                                <?= isset($errors['alamat_perusahaan']) ? $errors['alamat_perusahaan'] : 'Alamat perusahaan wajib diisi.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Jabatan -->
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-id-badge"></i></span>
                            <input
                                type="text"
                                class="form-control fc_native <?= isset($errors['jabatan']) ? 'is-invalid' : '' ?>"
                                id="jabatan"
                                name="jabatan"
                                placeholder="Masukan jabatan anda disini"
                                value="<?= old('jabatan') ?>"
                                required>
                            <div class="invalid-feedback">
                                <?= isset($errors['jabatan']) ? $errors['jabatan'] : 'Jabatan wajib diisi.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                            <input
                                type="text"
                                class="form-control fc_native <?= isset($errors['telepon']) ? 'is-invalid' : '' ?>"
                                id="telepon"
                                name="telepon"
                                placeholder="081212341234"
                                value="<?= old('telepon') ?>"
                                required>
                            <div class="invalid-feedback">
                                <?= isset($errors['telepon']) ? $errors['telepon'] : 'Nomor telepon wajib diisi.' ?>
                            </div>
                        </div>
                        <div class="small-help mt-1">Gunakan format Indonesia (contoh: 0812xxxxxxx).</div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input
                                type="email"
                                class="form-control fc_native <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                id="email"
                                name="email"
                                placeholder="example@gmail.com"
                                value="<?= old('email') ?>"
                                required
                                aria-describedby="emailHelp">
                            <div class="invalid-feedback">
                                <?= isset($errors['email']) ? $errors['email'] : 'Email wajib diisi & harus valid.' ?>
                            </div>
                        </div>
                        <div id="emailHelp" class="form-text small-help">Kami tidak akan pernah membagikan email Anda kepada orang lain.</div>
                    </div>

                    <!-- Kerjasama -->
                    <div class="col-md-6">
                        <label for="ruang_lingkup_kerjasama" class="form-label">Kerjasama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-handshake"></i></span>
                            <select
                                class="form-select fc_native <?= isset($errors['ruang_lingkup_kerjasama']) ? 'is-invalid' : '' ?>"
                                id="ruang_lingkup_kerjasama"
                                name="ruang_lingkup_kerjasama"
                                required>
                                <option selected value="">-- PILIH KERJASAMA --</option>
                                <option value="Construction" <?= old('ruang_lingkup_kerjasama') == 'Construction' ? 'selected' : '' ?>>Construction</option>
                                <option value="Electrical" <?= old('ruang_lingkup_kerjasama') == 'Electrical'   ? 'selected' : '' ?>>Electrical</option>
                                <option value="Mechanical" <?= old('ruang_lingkup_kerjasama') == 'Mechanical'   ? 'selected' : '' ?>>Mechanical</option>
                                <option value="Civil" <?= old('ruang_lingkup_kerjasama') == 'Civil'        ? 'selected' : '' ?>>Civil</option>
                                <option value="Painting" <?= old('ruang_lingkup_kerjasama') == 'Painting'     ? 'selected' : '' ?>>Painting</option>
                                <option value="Scafolding" <?= old('ruang_lingkup_kerjasama') == 'Scafolding'   ? 'selected' : '' ?>>Scafolding</option>
                                <option value="Insulation" <?= old('ruang_lingkup_kerjasama') == 'Insulation'   ? 'selected' : '' ?>>Insulation</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['ruang_lingkup_kerjasama']) ? $errors['ruang_lingkup_kerjasama'] : 'Silakan pilih jenis kerjasama.' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Proposal -->
                    <div class="col-md-6">
                        <label for="proposal" class="form-label fl_proposal">Proposal</label>
                        <input
                            type="file"
                            class="form-control fc_native <?= isset($errors['proposal']) ? 'is-invalid' : '' ?>"
                            name="proposal"
                            id="proposal"
                            accept=".pdf"
                            required>
                        <div class="invalid-feedback">
                            <?= isset($errors['proposal']) ? $errors['proposal'] : 'Proposal wajib diunggah (PDF).' ?>
                        </div>
                        <div class="upload-note mt-1">Format: PDF • Maksimal 1MB (sesuaikan limit server).</div>
                    </div>

                    <!-- Profil Perusahaan -->
                    <div class="col-md-6">
                        <label for="profil_perusahaan" class="form-label fl_perusahaan">Profil Perusahaan</label>
                        <input
                            type="file"
                            class="form-control fc_native <?= isset($errors['profil_perusahaan']) ? 'is-invalid' : '' ?>"
                            name="profil_perusahaan"
                            id="profil_perusahaan"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required>
                        <div class="invalid-feedback">
                            <?= isset($errors['profil_perusahaan']) ? $errors['profil_perusahaan'] : 'Format harus PDF/JPG/PNG.' ?>
                        </div>
                        <div class="upload-note mt-1">Format: PDF, JPG, PNG • Maksimal 1MB (sesuaikan limit server).</div>
                    </div>

                    <!-- Dokumen NPWP -->
                    <div class="col-md-6">
                        <label for="dokumen_npwp" class="form-label fl_dnpwp">Dokumen NPWP</label>
                        <input
                            type="file"
                            class="form-control fc_native <?= isset($errors['dokumen_npwp']) ? 'is-invalid' : '' ?>"
                            name="dokumen_npwp"
                            id="dokumen_npwp"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required>
                        <div class="invalid-feedback">
                            <?= isset($errors['dokumen_npwp']) ? $errors['dokumen_npwp'] : 'Format harus PDF/JPG/PNG.' ?>
                        </div>
                        <div class="upload-note mt-1">Format: PDF, JPG, PNG • Maksimal 1MB (sesuaikan limit server).</div>
                    </div>

                    <!-- Surat Pernyataan -->
                    <div class="col-md-6">
                        <label for="surat_pernyataan" class="form-label fl_sp">Surat Pernyataan</label>
                        <input
                            type="file"
                            class="form-control fc_native <?= isset($errors['surat_pernyataan']) ? 'is-invalid' : '' ?>"
                            name="surat_pernyataan"
                            id="surat_pernyataan"
                            accept=".pdf"
                            required>
                        <div class="invalid-feedback">
                            <?= isset($errors['surat_pernyataan']) ? $errors['surat_pernyataan'] : 'Format harus PDF.' ?>
                        </div>
                        <div class="upload-note mt-1">Format: PDF • Maksimal 1MB (sesuaikan limit server).</div>
                    </div>
                </div>

                <div class="mt-3 btn-block">
                    <button class="btn btn-warning btn-sm text-white" type="submit">
                        <i class="fa-solid fa-file-arrow-up me-1"></i> Up Kerjasama
                    </button>
                    <!-- Tambahkan tombol reset jika perlu -->
                    <button type="reset" class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Catatan penting untuk WA auto-click -->
<script>
    // Jika menggunakan session('wa_url'), cukup buka tab WA.
    // Auto-click tombol "send" di WhatsApp Web TIDAK memungkinkan (cross-origin policy).
    window.addEventListener('load', function() {
        var waUrl = "<?= session()->getFlashdata('wa_url'); ?>";
        if (waUrl) window.open(waUrl, '_blank');
    });

    // spinner loading
    (function() {
        // Ambil form kerjasama
        const form = document.querySelector('form[action*="/pages/cooperation"]');
        if (!form) return;

        const overlay = document.getElementById('submitOverlay');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(e) {
            // 1) Kalau invalid: cegah submit, tampilkan feedback
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            // 2) Valid: JANGAN disable input! (biarkan CSRF & data terkirim)
            //    Cukup kunci tombol submit & tampilkan overlay
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                // Simpan label asli supaya bisa dipulihkan kalau perlu
                if (!submitBtn.dataset.originalHtml) {
                    submitBtn.dataset.originalHtml = submitBtn.innerHTML;
                }
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengunggah...';
            }

            if (overlay) {
                overlay.style.display = 'flex';
                overlay.setAttribute('aria-hidden', 'false');
            }
            // Biarkan submit berlanjut (browser akan navigate)
        });

        // 3) Kalau user tekan Back (BFCache), sembunyikan overlay & pulihkan tombol
        window.addEventListener('pageshow', function(evt) {
            if (overlay) {
                overlay.style.display = 'none';
                overlay.setAttribute('aria-hidden', 'true');
            }
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitBtn.dataset.originalHtml) {
                    submitBtn.innerHTML = submitBtn.dataset.originalHtml;
                }
            }
        });
    })();
</script>

<?= $this->endSection() ?>