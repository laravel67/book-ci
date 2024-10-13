<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<div class="container my-5">
    <h1>Detail Book</h1>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4 p-2">
                <img class="img-fluid" src="<?= base_url('img/' . $book["cover"]); ?>" alt="<?= $book["cover"]; ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $book['title']; ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Publisher: <?= $book['publisher']; ?></li>
                        <li class="list-group-item">Author: <?= $book['author']; ?></li>
                        <li class="list-group-item">Published:
                            <?= \Carbon\Carbon::parse($book['created_at'])->locale('id')->isoFormat('D MMMM YYYY'); ?>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-right">
                    <a class="btn btn-secondary btn-sm" href="<?= base_url('/books'); ?>">Back</a>
                    <a class="btn btn-primary btn-sm" href="<?= base_url('/book/edit/' . $book['slug']); ?>">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>