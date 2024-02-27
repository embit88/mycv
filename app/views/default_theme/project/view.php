<section class="container text-center article-projects">
    <h2><?= $this->data['project']['name'] ?></h2>
    <div class="row">
        <br>
        <div class="col-12 col-lg-10 offset-lg-1">
            <img class="img-responsive" alt="<?= $this->data['project']['name'] ?>" src="<?= image($this->data['project']['image']) ?>">
        </div>
        <div class="col-12">
            <br>
            <br>
            <?= $this->data['project']['content'] ?>
            <?php if(!empty($this->data['project']['site_url'])): ?>
                <br>
                <p><a href="<?= $this->data['project']['site_url'] ?>" target="_blank" rel="nofollow"> <?= $this->data['project']['site_url'] ?></a></p>
            <?php endif; ?>
        </div>
    </div>
</section>