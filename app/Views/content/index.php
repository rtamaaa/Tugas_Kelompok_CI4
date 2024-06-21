<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
                    <a href="<?= base_url('content/create') ?>" class="btn btn-primary mb-3">Tambah Konten</a>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Subtittle</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contents as $content) : ?>
                                    <tr>
                                        <td><?= $content['judul'] ?></td>
                                        <td><?= $content['tanggal'] ?></td>
                                        <td><?= $content['subtittle'] ?></td>

                                        <td>
                                            <img src="<?= base_url('uploads/content/' . $content['foto']) ?>" alt="<?= $content['judul'] ?>" class="img-thumbnail img-fluid gambar-modal" data-toggle="modal" data-target="#gambarModal" data-foto="<?= base_url('uploads/content/' . $content['foto']) ?>" data-judul="<?= htmlspecialchars($content['judul']) ?>">
                                        </td>
                                        
                                        <td>
                                            <a href="<?= base_url('content/read/' . $content['id']) ?>" class="btn btn-sm btn-success">Read</a>
                                            <a href="<?= base_url('content/edit/' . $content['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="<?= base_url('content/delete/' . $content['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gambarModalLabel">Detail Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="gambarModalImg" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Ketika gambar dengan kelas .gambar-modal di-klik
        $('.gambar-modal').on('click', function() {
            var imgPath = $(this).data('foto'); // Ambil atribut data-foto
            var judul = $(this).data('judul'); // Ambil atribut data-judul

            $('#gambarModal').modal('show'); // Tampilkan modal
            $('#gambarModalLabel').text(judul); // Set judul modal
            $('#gambarModalImg').attr('src', imgPath); // Set sumber gambar modal
        });
    });
</script>
