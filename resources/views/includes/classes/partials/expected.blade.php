<?php
// ! TODO: Add correct data instead of fake data
$fake_grid_items = array(
    '1' => array(
        'ico' => 'ico-clock.svg',
        'type' => 'clock',
        'title' => 'Length = 4 hours or less',
    ),
    '2' => array(
        'ico' => 'ico-shooting.svg',
        'type' => 'shooting',
        'title' => 'Live Fire Shooting in our indoor range',
    ),
    '3' => array(
        'ico' => 'ico-map-pin.svg',
        'type' => 'map-pin',
        'title' => 'Leave with the ability to apply in all 6 states allowing 39 state reciprocity.',
    )
);
?>

<div class="expected">
    <div class="desktop-wide-wrap">
        <div class="container">
            <div class="title">
                What Can I Expect In
                The Class?
            </div>
            <div class="expectaions">
                <?php foreach ($fake_grid_items as $item => $value) { ?>
                    <div class="expectaion">
                        <div class="ico">
                            <img src="/ico/<?php echo $value['ico'] ?>" alt="" class="<?php echo $value['type'] ?>">
                        </div>
                        <div class="text"><?php echo $value['title'] ?></div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>