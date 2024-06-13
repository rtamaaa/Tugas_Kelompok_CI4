<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Konten Form Edit Pengguna -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Pengguna</h1>

                    <form action="<?= base_url('user/update/' . $user['id']) ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                <option value="user" <?= ($user['role'] == 'user') ? 'selected' : '' ?>>User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <!-- Akhir Konten Form Edit Pengguna -->
                </div>
            </div>
        </div>
    </div>
</div>
