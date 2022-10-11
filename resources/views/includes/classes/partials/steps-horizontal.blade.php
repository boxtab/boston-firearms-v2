<?php
// ! TODO: Add correct data instead of fake data
$fake_grid_items = array(
    '1' => array(
        'title' => 'STEP 01',
        'description' => 'Take our State Police Certified Firearms Safety Course required by Massachusetts law.',
    ),
    '2' => array(
        'title' => 'STEP 02',
        'description' => 'We award you a certificate of completion the same day stamped with Live Fire training',
    ),
    '3' => array(
        'title' => 'STEP 03',
        'description' => 'We help you apply for your license at your local police station to make sure you have the best chance of getting approved.',
    )
);
?>

<div class="steps-horizontal">
    <div class="desktop-wide-wrap">
        <div class="title">
            How This Course Works
        </div>
        <div class="steps">

            <?php foreach ($fake_grid_items as $item => $value) { ?>
                <div class="step">
                    <div class="step-title "><?php echo $value['title'] ?></div>
                    <div class="step-content"><?php echo $value['description'] ?></div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>