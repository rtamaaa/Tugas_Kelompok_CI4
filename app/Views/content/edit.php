<div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Konten Form Edit -->
                        <h1 class="h3 mb-2 text-gray-800">Edit Konten</h1>

                        <form action="<?= base_url('content/update/' . $content['id']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="<?= $content['judul'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="subtittle">subtittle</label>
                                <input type="text" class="form-control" id="subtittle" name="subtittle" value="<?= $content['subtittle'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= $content['deskripsi'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $content['tanggal'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                                <?php if ($content['foto']): ?>
                                    <img src="<?= base_url('writable/uploads/' . $content['foto']); ?>" alt="<?= $content['judul']; ?>" class="img-thumbnail mt-2" width="150">
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <!-- Akhir Konten Form Edit -->
                    </div>
                </div>
            </div>
        </div>
    </div>