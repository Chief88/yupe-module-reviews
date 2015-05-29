<?php if(isset($reviews) && $reviews != []): ?>
    <div class="customer-testimonials" id="about-scroll-reviews">

        <h4>Отзывы наших заказчиков</h4>

        <ul class="row-fluid">

            <?php $itemNumber = 1; foreach ($reviews as $model): ?>

                <li class="span4 item-review">

                    <div class="row-fluid">

                        <?php if( !empty($model->image) ): ?>
                            <div class="span4 wrapper-img transition-05">
                                <img class="" src="<?php print $model->getImageUrl(104, 104); ?>" alt="<?php print $model->fio; ?>" title="<?php print $model->fio; ?>"/>
                            </div>
                        <?php endif; ?>

                        <div class="span8 <?php empty($model->image)? print 'width-full': print ''; ?>">

                            <div class="fio"><?php print $model->fio; ?></div>
                            <div class="organisation"><?php print $model->organisation; ?></div>
                            <div class="clearfix"></div>
                            <hr/>
                            <div class="clearfix"></div>
                            <div class="rating">

                                <?php $i = 1; $rating = $model->rating;
                                for($i >= 1; $i <= 5; $i++):
                                    if( $i <= $rating ):?>

                                        <div class="star star-full"></div>
                                    <?php else:?>
                                        <div class="star star-contour"></div>
                                    <?php endif ?>

                                <?php endfor; ?>

                            </div>

                        </div>

                    </div>

                    <div class="row-fluid data-reviews">

                        <div class="span12 message-reviews ">
                            <?php print $model->message; ?>
                        </div>

                    </div>

                </li>

                <?php if(fmod($itemNumber, $countInLine) == 0): ?>
                    <div class="clearfix"></div>
                <?php endif; $itemNumber ++ ?>

            <?php endforeach;?>

        </ul>

    </div>
<?php endif; ?>