<?php Yii::import('application.modules.reviews.ReviewsModule'); ?>

<?php if(isset($models) && $models != array()): ?>

    <div class="left-side-reviews">
        <div class="block-title"><a href="/reviews">Отзывы клиентов</a></div>

        <ul>
            <?php foreach($models as $review): ?>
                <li>
                    <blockquote>
                        <?php echo $review->message; ?>
                    </blockquote>
                    <div class="ls-reviews-author">
                        <?php echo $review->fio; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>