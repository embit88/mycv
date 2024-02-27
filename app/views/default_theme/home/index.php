<section class="container text-center section-about">
    <h2 id="about"><?= lang('title_about') ?></h2>
    <div class="row">
        <div class="col-12 col-lg-6 float-left">
            <img alt="no image" src="<?= image('vfprog.png') ?>">
        </div>
        <div class="col-12 col-lg-6 float-right about-content">
            <?php if(isset($this->data['informations']['content'])): ?>
                <?= $this->data['informations']['content'] ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="container text-center section-skills">
    <h2 id="skills"><?= lang('title_skills') ?></h2>
    <div class="row">
        <div class="col-12 col-lg-4 float-left">
            <?php if(isset($this->data['skills']['content_first'])): ?>
                <?= $this->data['skills']['content_first'] ?>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-4 float-left">
            <?php if(isset($this->data['skills']['content_second'])): ?>
                <?= $this->data['skills']['content_second'] ?>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-4 float-left">
            <?php if(isset($this->data['skills']['content_third'])): ?>
                <?= $this->data['skills']['content_third'] ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="container text-center section-works">
    <h2 id="works"><?= lang('title_works') ?></h2>
    <div class="row">
        <?php if(isset($this->data['works']) && count($this->data['works']) > 0): ?>
            <?php foreach ($this->data['works'] as $work): ?>
                <div class="work-block col-12 col-lg-6 offset-lg-3">
                    <p class="work-name"><?= $work['name'] ?>
                        <?php if(!empty($work['site_url'])): ?>
                            <a href="<?= $work['site_url'] ?>" target='_blank' rel='nofollow' class="work-site"><?= $work['site_url'] ?></a>
                        <?php endif; ?>
                    </p>
                    <p class="work-date"><?= $work['date_start'] ?> - <?= !empty($work['date_end']) ? $work['date_end'] : lang('title_work_today') ?></p>
                    <p class="work-content"><?= $work['content'] ?></p>
                    <?php if($work !== end($this->data['works'])): ?>
                        <span>&#8595;</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<section class="container text-center section-projects">
    <h2 id="projects"><?= lang('title_projects') ?></h2>
    <div class="row">
        <?php if(isset($this->data['projects']) && count($this->data['projects']) > 0): ?>
            <?php foreach ($this->data['projects'] as $project): ?>
                <div class="col-12 col-sm-6 col-lg-4 float-left">
                    <div class="project-block">
                        <a href="<?= rtrim(\vfx\App::$request->site_url() . '/' . \vfx\App::$app->getProperty('language_slug'), '/') ?>/project/<?= $project['slug'] ?>">
                            <img alt="<?= $project['name'] ?>" src="<?= image($project['image']) ?>">
                            <p class="project-name"><?= $project['name'] ?></p>
                            <?php if(!empty($project['short_content'])): ?>
                                <p class="project-text"><?= $project['short_content'] ?></p>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="show-more-button" data-route="<?= \vfx\App::$app->getProperty('language_slug') . \vfx\Router::getRouteName('api.get_projects', 'url') ?>" data-text="<?= lang('title_no_element') ?>" data-page="1" data-image="<?= IMAGE_PATH ?>" data-href="<?= rtrim(\vfx\App::$request->site_url() . '/' . \vfx\App::$app->getProperty('language_slug'), '/') ?>/project/"><?= lang('title_show_more') ?></button>
</section>

<section class="container text-center section-contacts">
    <h2 id="contacts"><?= lang('title_contacts') ?></h2>
    <div class="row">
        <div class="col-12 ">
            <?php if(isset($this->data['contacts']['phone'])): ?>
                <a target="_blank" rel="nofollow" href="tel:<?= $this->data['contacts']['phone'] ?>"><?= $this->data['contacts']['phone'] ?></a>
            <?php endif; ?>
            <?php if(isset($this->data['contacts']['phone_other'])): ?>
                <a target="_blank" rel="nofollow" href="tel:<?= $this->data['contacts']['phone'] ?>"><?= $this->data['contacts']['phone_other'] ?></a>
            <?php endif; ?>
            <?php if(isset($this->data['contacts']['email'])): ?>
                <a target="_blank" rel="nofollow" href="mailto:<?= $this->data['contacts']['email'] ?>"><?= $this->data['contacts']['email'] ?></a>
            <?php endif; ?>
            <?php if(isset($this->data['contacts']['telegram'])): ?>
                <a target="_blank" rel="nofollow" href="<?= $this->data['contacts']['telegram'] ?>"><?= lang('title_telegram') ?></a>
            <?php endif; ?>
            <?php if(isset($this->data['contacts']['github'])): ?>
                <a target="_blank" rel="nofollow" href="<?= $this->data['contacts']['github'] ?>"><?= lang('title_github') ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>