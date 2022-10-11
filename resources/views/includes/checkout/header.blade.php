@php
$isScheduleTabPassed = false;
$isContactTabPassed = false;
if ( $current !='schedule-class' && !empty($sessionData['event_slug']) && !empty($sessionData['appointment_id']) ) {
    $isScheduleTabPassed = true;
}
if ($current !='enter-details' && !empty($sessionData['client']) && count($sessionData['client']) == 4) {
    $isContactTabPassed = true;
}

@endphp
<div class="header">
    <div class="tabs">
        <div class="titles">
            <div class="title title2 {{ $current == 'schedule-class'? 'current':'' }}">
                <a href="{{ !empty( $sessionData['event_slug'] ) ? route( 'checkout.schedule-class.show', [ $sessionData['event_slug'] ] ) : '#' }}">Schedule Class</a>
            </div>
            <div class="title title2 {{ $current == 'enter-details'? 'current':'' }}">
                <a href="{{ ( !empty( $sessionData['appointment_id'] ) &&  $sessionData['appointment_id'] > 0 ) ? route( 'checkout.enter-details.show', [ $sessionData['appointment_id'] ] ) : '#' }}">Enter Details</a>
            </div>
            <div class="title title2 {{ $current == 'make-payment'? 'current':'' }}">
                <a href="{{ ( !empty( $sessionData['booking_id'] ) && $sessionData['booking_id'] > 0 ) ? route( 'checkout.make-payment.show', [ $sessionData['booking_id'] ] ) : '#' }}">Make Payment</a>
            </div>
        </div>
        <div class="cols">
            <div class="col col3 {{ $current == 'schedule-class'? 'current':'' }} {{ $isScheduleTabPassed ? 'passed':'' }}"></div>
            <div class="col col3 {{ $current == 'enter-details'? 'current':'' }} {{ $isContactTabPassed ? 'passed' : '' }}"></div>
            <div class="col col3 {{ $current == 'make-payment'? 'current':'' }}"></div>
        </div>
    </div>
</div>
