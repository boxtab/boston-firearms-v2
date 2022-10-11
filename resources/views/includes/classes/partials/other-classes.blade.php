<!-- <div class="other-classes-section">
    <div>
        @foreach ($other_classes as $other_class)
        <p>{{ $other_class['title'] }}</p>
        <a href=""></a>
        @endforeach
    </div>

</div> -->


<?php
// ! TODO: Add real data instead of fake data !
$fake_grid_items = array(
    '1' => array(
        'img' => 'macro-shot-gun-isolated-white-background.jpg',
        'title' => 'Concealed Carry 1',
        'price' => '200',
        'description' => 'Real, live shooting drills to skyrocket your confidence with handling a firearm. No theories, videos, or lectures. This is the real deal.',
        'for1' => 'You already took a Basic Firearms Safety Course',
        'for2' => 'You want to feel more confident handling a firearm',
    ),
    '2' => array(
        'img' => 'guns-with-ammunition-paper-target.jpg',
        'title' => 'Brookline Qualification Test',
        'price' => '125',
        'description' => 'Brookline requires applicants to qualify at the Moon Island range. The test consists of 30 rounds of .38 ammunition on a Smith & Wesson .38 revolver.',
        'for1' => 'You already took a Basic Firearms Safety Course',
        'for2' => 'You are a Brookline, MA resident looking to get your LTC.',
    ),
    '3' => array(
        'img' => 'bullets-paper-target-shooting-practice.jpg',
        'title' => 'Rhode Island Qualification Test',
        'price' => '125',
        'description' => 'In the state of Rhode Island applicants must qualify within 12 months in front of a NRA or police instructor who must document said score.',
        'for1' => 'You already took a Basic Firearms Safety Course',
        'for2' => 'You are a Rhode Island resident looking to get your LTC.',
    ),

);
?>


<div class="courses-grid-section">
    <div class="desktop-wide-wrap">


        <div class="section-title">
            <?php // ! TODO: we should implement different titles for this section for different pages
            ?>
            Already Have Your LTC? These Courses Are For You.
        </div>

        <div class="courses-grid">

            @foreach ($other_classes as $other_class)
            <div class="item">
                <div class="item-zoom">
                    <div class="img">
                        <img src="/images/<?php echo $fake_grid_items[$loop->iteration]['img'] ?>" alt="">
                    </div>

                    <div class="top-row">
                        <div class="item-title">{{ $other_class['title'] }}</div>
                        <div class="price-block">
                            <div class="price">${{ $other_class['price'] }}</div>
                            <!-- <div class="hours">2 Hours</div> -->
                        </div>
                    </div>
                    <div class="bottom-row">
                        <div class="desc-title">Desctription</div>
                        <div class="desc"><?php echo $fake_grid_items[$loop->iteration]['description'] ?></div>
                        <div class="desc-title for-title">Who this class is for</div>
                        <div class="desc for"><?php echo $fake_grid_items[$loop->iteration]['for1'] ?></div>
                        <div class="desc for"><?php echo $fake_grid_items[$loop->iteration]['for2'] ?></div>
                        <div class="button-row">
                            <a href="{{ route('class.page', $other_class['slug']) }}">More Info</a>
                        </div>
                    </div>

                </div>
            </div>

            @endforeach
        </div>

    </div>
</div>