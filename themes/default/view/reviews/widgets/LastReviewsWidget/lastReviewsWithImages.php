<?php Yii::import('application.modules.reviews.ReviewsModule'); ?>

<?php if(isset($models) && $models != []): ?>

    <div class="container">
        <div class="portfolio">
            <h2>Отзывы</h2>
            <div class="sepa-30"></div>
            <ul class="news-list photoframes">

                <?php foreach($models as $index=> $review): ?>
                    <?php $modulo = $index % 3;

                    switch($modulo){
                        case 0:
                            $classF = 'f1';
                            break;
                        case 1:
                            $classF = 'f2';
                            break;
                        case 2:
                            $classF = 'f3';
                            break;
                        default:
                            $classF = 'f1';
                    }?>
                    <li>
                        <div class="image photoframe <?= $classF; ?>">
                            <img src="<?= $review->getImageUrl(320, 222); ?>" alt="<?= $review->name; ?>" />
                        </div>

                        <div class="title withdate">
                            <?= $review->name; ?>
                            <div class="date"><?= $review->date; ?></div>
                        </div>
                        <div class="cut">
                            <?= strlen($review->message) > 376 ? mb_strcut($review->message, 0, 376).'...' : $review->message; ?>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
            <div class="sepa-30"></div>
            <div class="text-center"><a href="/reviews" class="btn btn-primary single-line">Все отзывы</a></div>
            <div class="sepa-60"></div>
        </div>
    </div>

<?php endif; ?>