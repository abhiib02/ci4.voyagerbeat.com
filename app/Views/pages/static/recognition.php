<div class="bgSecondaryTheme text-white py-4 mb-4">
    <div class="container">
        <h1 class="mb-1">Awards & Recognition</h1>
    </div>
</div>
<div class="container">
    <h1>Recognitions By Govt.</h1>
    <div class="d-flex gap-2" style="width: fit-content;animation: slide 30s linear infinite alternate;">
        <div class="square card grid-center">
            <img src="/assets/recog/1.png" alt="1">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/2.png" alt="2">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/3.png" alt="3">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/4.png" alt="4">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/5.png" alt="5">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/6.png" alt="6">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/7.png" alt="7">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/8.png" alt="8">
        </div>
        <div class="square card grid-center">
            <img src="/assets/recog/9.png" alt="9">
        </div>
    </div>
    <hr>
    <p>
        At Voyagers Beat, our dedication to crafting remarkable travel experiences has not gone unnoticed. In a relatively short span, we've earned trust, accolades, and the support of esteemed institutions and government bodies.
    </p>
    <p>
        We are proud to be a recognized and certified member of ATOAI (Adventure Tour Operators Association of India), reinforcing our commitment to maintaining high safety and quality standards in adventure travel. Our efforts in the travel and tourism sector have been consistently acknowledged, including receiving the prestigious MSME Best Enterprise Award in the Travel & Tourism category for three consecutive years — a testament to our excellence, reliability, and consistent service delivery.
    </p>
    <p>
        Our innovative approach to travel has also gained the support of Startup India, a government initiative aimed at fostering innovation-driven entrepreneurship. We are honored to have been selected as an official adventure tour operator under Uttar Pradesh Tourism, contributing to regional tourism development with curated experiences rooted in authenticity and sustainability.
    </p>
    <p>
        Further strengthening our foundation, Voyagers Beat is proudly incubated by NSRCEL, IIM Bangalore, one of India’s premier startup ecosystems. This association reflects the strategic support and structured growth that drive our mission forward.
    </p>
    <p>
        We’re also thrilled to have received the 2023 TripAdvisor Travelers’ Choice Award, earned through exceptional guest reviews and traveler satisfaction across our journeys.
    </p>
    <p>
        Media platforms such as ANI and Business Standard have featured our story, recognizing our growing impact on India’s travel landscape.
    </p>
    <p>
        These milestones are more than accolades — they are affirmations of our promise to deliver meaningful, well-crafted, and responsible travel experiences across India and beyond.
    </p>

</div>
<div class="container">
    <?php
    $awardsImgArr = [
        'aw1.webp',
        'aw2.webp',
        'aw3.webp',
        'aw4.webp',
        'aw5.webp',
        'aw6.webp',
    ]
    ?>
    <section class="container">
        <h3 class="text-center">Awards</h3>
        <!-- Swiper -->
        <div class="swiper career-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($awardsImgArr as $image): ?>
                    <div class="swiper-slide" style="overflow:clip;height:500px;background-image:url('/assets/recog/<?= $image ?>');background-size: cover;background-position: center;">

                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</div>