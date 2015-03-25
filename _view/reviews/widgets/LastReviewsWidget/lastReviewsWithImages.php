<?php Yii::import('application.modules.reviews.ReviewsModule'); ?>

<?php if(isset($models) && $models != array()): ?>

    <noindex>
        <div class="extra-title">Отзывы</div>

        <div class="tarif-reviews">
            <ul style="margin-left: -1320px;">

                <?php foreach($models as $review): ?>
                    <li>
                        <?php if( !empty($review->image) ): ?>
                            <img src="<?php print $review->getImageUrl(48, 48); ?>" class="author-photo">
                        <?php endif; ?>
                        <div class="author-name">
                            <?php print $review->fio; ?>
                            <div class="author-company">
                                <?php !empty($review->organisation) ? print $review->organisation : print ''; ?>
                            </div>
                        </div>
                        <?php print $review->message; ?>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </noindex>

<?php endif; ?>