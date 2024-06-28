<!-- Main News Slider Start -->
<div class="container-fluid px-0">
    <div class="row mx-0">
        <div class="col-12 px-0">
            <div class="owl-carousel main-carousel position-relative">
            <?php foreach ($contents as $content): ?>
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100 w-100" src="<?= base_url('uploads/content/' . $content['foto']) ?>" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">Coding</a>
                                <a class="text-white" href=""><?= date('M d, Y', strtotime($content['tanggal'])) ?></a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href=""><?= $content['judul'] ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->
