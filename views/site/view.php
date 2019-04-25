<div class="blog-main">
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        From the Firehose
    </h3>

    <div class="blog-post">
        <div class="blog-post-meta">

            <div class="col-sm-6 pull-left">
                <span class="glyphicon glyphicon-time"></span><?= date("Y.m.d H:i", $model->date) ?>
            </div>
            <div class="col-sm-6 pull-right" style="text-align:right;">
                <span class="glyphicon glyphicon-hand-up"></span><?= $model->likes->count ?>
            </div>


        </div>

        <div><?= $model->text ?></div>
        <div class="attachments">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <?php if (property_exists($model, "attachments") && @sizeof($model->attachments) > 0): ?>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $sliderActivated = 1; ?>
                        <?php foreach ($model->attachments as $attachment) : ?>

                            <?php foreach (array_reverse(array_keys((array)$attachment->{$attachment->type})) as $large_photo): ?>
                                <?php if (strpos($large_photo, "photo_") !== false): ?>
                                    <div class="item <?= $sliderActivated-- ? 'active' : '' ?>">
                                        <img src="<?= $attachment->{$attachment->type}->$large_photo ?>"/>
                                    </div>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div><!-- /.blog-post -->

</div>
