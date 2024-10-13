<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mx-5" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/')  ?>">Home</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/about')  ?>">About</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/blog')  ?>">Blog</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/contact')  ?>">Contact Us</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('/books')  ?>">Books</a>
                </li>

            </ul>
        </div>
    </div>
</nav>