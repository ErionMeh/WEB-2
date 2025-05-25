<footer class="bg-light py-4">
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center">
        <div>© <?= date('Y') ?> eStore. All rights reserved.</div>
        <div>
            <a href="theme-switcher.php?theme=light" class="btn btn-sm <?= ($theme ?? 'light') === 'light' ? 'btn-primary' : 'btn-outline-secondary' ?>">Light</a>
            <a href="theme-switcher.php?theme=dark" class="btn btn-sm <?= ($theme ?? 'light') === 'dark' ? 'btn-primary' : 'btn-outline-secondary' ?> ms-2">Dark</a>
        </div>
    </div>
</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
