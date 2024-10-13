<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<div class="container my-5">
    <h1 class="border-bottom mb-4">Create New Book</h1>
    <form class="mb-5" method="post" action="<?= base_url('/book/store'); ?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" id="title" class="form-control <?= session('errors.title') ? 'is-invalid': '' ?>" value="<?= old('title') ?>" >
                <?php if (session('errors.title')) : ?>
                    <small id="title" class="invalid-feedback"><?= session('errors.title'); ?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
                <input type="text" name="author" id="author" class="form-control <?= session('errors.author') ? 'is-invalid': '' ?>" value="<?= old('author') ?>" >
                <?php if (session('errors.author')) : ?>
                    <small id="author" class="invalid-feedback"><?= session('errors.author'); ?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
                <input type="text" name="publisher" id="publisher" class="form-control <?= session('errors.publisher') ? 'is-invalid': '' ?>" value="<?= old('publisher') ?>" >
                <?php if (session('errors.publisher')) : ?>
                    <small id="publisher" class="invalid-feedback"><?= session('errors.publisher'); ?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row py-0">
            <label for="cover" class="col-sm-2 col-form-label">Cover</label>
            <div class="col-sm-10">
                <label class="btn btn-outline-secondary btn-sm" for="cover">
                    <i class="bi bi-image"></i> Choose Image
                </label>
                <input type="file" name="cover" id="cover" class="form-control d-none <?= session('errors.cover') ? 'is-invalid': '' ?>" value="<?= old('cover') ?>" onchange="previewImage(event)">
                <div class="float-right mb-5">
                    <a href="<?= base_url('/books'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary">Save Now</button>
                </div>
                <?php if (session('errors.cover')) : ?>
                    <small id="cover" class="invalid-feedback"><?= session('errors.cover'); ?></small>
                <?php endif; ?>
                <div class="d-flex justify-content-center mx-auto p-0 m-0">
                    <img class="img-fluid" style="width: 100px;" src="<?= base_url('/img/default.jpg'); ?>" id="previewCover">
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>