<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<div class="container my-5">
    <div class="row justify-content-between align-items-center">
        <div>
            <a class="btn btn-sm btn-success" href="<?= base_url('/book/create'); ?>">Create new book</a>
            <h4>List Books</h4>
        </div>
        <div>
            <?= $this->include('layouts/flash'); ?>
        </div>
        <div>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Book search...">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Cover Image</th>
                <th scope="col">Title</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + ($perPage * ($currentPage - 1)) ?>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td scope="row"><?= $i++; ?></td>
                    <td>
                        <img class="cover" src="<?= base_url('img/' . $book["cover"]); ?>" alt="" srcset="">
                    </td>
                    <td><?= $book['title']; ?></td>
                    <td>
                        <a href="<?= base_url('/book/' . $book['slug']); ?>" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i></a>
                        <a href="<?= base_url('/book/edit/' . $book['slug']); ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form class="d-inline" action="<?= base_url('/book/' . $book['id']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('This action will delete the data permanently, are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
</div>
<?= $this->endSection(); ?>