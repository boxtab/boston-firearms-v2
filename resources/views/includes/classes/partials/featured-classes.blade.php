<?php
// ! TODO: Add real data instead of fake data !
$fake_grid_items = array(
    '1' => array(
        'title' => 'Massachusetts LTC Qualifier',
        'price' => '140',
        'description' => 'In this class we cover everything you need to know to get your MA LTC. Including fundamentals, state laws, storage and more.',
        'for1' => 'MA and Non-MA residents.',
        'for2' => 'People interested in getting their License To Carry (LTC) or FID',
    ),
    '2' => array(
        'title' => '39 States LTC Qualifer',
        'price' => '300',
        'description' => 'Want to carry outside of MA? This course covers 38 states. No previous licenses or courses are required. ',
        'for1' => 'MA and Non-MA residents.',
        'for2' => 'People interested in getting their License To Carry (LTC) or FID in 39 states.',
    ),

);
?>

<div class="want-your-license featured-classes-section">
    <div class="desktop-wide-wrap">

        <div class="title">
            Want Your License To Carry? <br>
            These Courses Are For You.
        </div>

        <div class="want-your-license-grid">


            @foreach ($featured_classes as $featured_class)
            <div class="item">
                <div class="top-row">

                    <div class="item-title"><?php echo substr($featured_class['title'], 0, 30); ?><?php if (strlen($featured_class['title']) > 30) echo '...';
                                                                                                    else {
                                                                                                    } ?></div>
                    <div class="price-block">
                        <div class="price">${{ $featured_class['price'] }}</div>
                        <!-- <div class="hours">4 Hours</div> -->
                    </div>
                </div>
                <div class="bottom-row">
                    <div class="desc-title">Desctription</div>
                    <div class="desc"><?php echo $fake_grid_items[$loop->iteration]['description'] ?></div>
                    <div class="desc-title for-title">Who this class is for</div>
                    <div class="desc for"><?php echo $fake_grid_items[$loop->iteration]['for1'] ?></div>
                    <div class="desc for"><?php echo $fake_grid_items[$loop->iteration]['for2'] ?></div>
                    <div class="button-row">
                        <a class="a-btn" href="{{ route('class.page', $featured_class['slug']) }}">Sign Up For <span>${{ $featured_class['price'] }}</span></a>
                        <a href="#" class="more">more info</a>
                    </div>
                </div>

            </div>
            @endforeach


        </div>

    </div>
</div>