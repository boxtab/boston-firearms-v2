<?php
$grid_items = array(
    '1' => array(
        'img' => 'review-img.png',
        'text' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint in nihil laudantium accusantium magni soluta ratione ducimus, minus corrupti quod porro quidem.',
    ),
    '2' => array(
        'img' => 'review-img.png',
        'text' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint in nihil laudantium accusantium magni soluta ratione ducimus, minus corrupti quod porro quidem.',
    ),
    '3' => array(
        'img' => 'review-img.png',
        'text' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint in nihil laudantium accusantium magni soluta ratione ducimus, minus corrupti quod porro quidem.',
    )
);
?>

<div class="review-section">
    <div class="review">
        <div class="review-title">
            Over 2500+ Google Reviews
        </div>
        <div class="review-carousel">
            <?php foreach ($grid_items as $item => $value) { ?>
                <div class="item">
                    <div class="review-quote"></div>
                    <div class="review-image-row">
                        <div class="review-image"><img src="/images/<?php echo $value['img'] ?>" alt=""></div>
                    </div>
                    <div class="review-text"><?php echo $value['text'] ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>