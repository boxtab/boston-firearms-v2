<div class="due-today" style="display: flex">
    <div class="text">
        <h3>Amount due today</h3>
        @if (isset($booking))
            <p>Rest of balance paid the day of class: ${{ $booking->getRestAmount() }}</p>
        @endif
    </div>
    <div class="amount">
        ${{ $appointment->getInitialAmount() }}
    </div>
</div>
