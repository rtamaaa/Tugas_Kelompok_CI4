<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Judul : <?= $content['judul'] ?></h5>
                            <p class="card-text"> Deskripsi :<?= $content['deskripsi'] ?></p>
                            <p class="card-text">Tanggal : <?= $content['tanggal'] ?></p>

                            <?php if ($content['foto']) : ?>
                                <?php $image_path = base_url('uploads/content/' . $content['foto']); ?>
                                <img src="<?= $image_path ?>" class="img-thumbnail" width="300" alt="Content Image">
                            <?php else: ?>
                                <p>No image found for this content.</p>
                            <?php endif; ?>
                            <a href="<?= base_url('content/') ?>" class="btn btn-primary ">close</a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
