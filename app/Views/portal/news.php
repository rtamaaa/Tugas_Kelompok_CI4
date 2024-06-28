    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.marquee/jquery.marquee.min.js"></script>
<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 mb-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3 marquee"
                            style="width: calc(100% - 170px); padding-right: 90px;">
                            <?php foreach ($descriptions as $description): ?>
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href=""><?= $description ?></a></div>
                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->

    <script>
    $(document).ready(function(){
        // Initialize the Marquee Plugin
        $('.marquee').marquee({
            duration: 15000,
            gap: 50,
            delayBeforeStart: 0,
            direction: 'left',
            duplicated: true,
            pauseOnHover: true
        });
    });
    </script>