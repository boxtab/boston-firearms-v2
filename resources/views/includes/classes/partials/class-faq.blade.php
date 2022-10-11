<div class="faq-section-new">
    <div class="desktop-wide-wrap">

        <div class="faq-section">
            <div class="faq-section-title">
                FAQs
            </div>
            <div class="faq-list">
                @foreach($class->faqs as $faqItem)
                    <div class="faq">
                        <div class="title">{{ $faqItem['question'] }}<br></div>
                        <div class="description">{{ $faqItem['answer'] }}</div>
                    </div>
                @endforeach

                    {{--<div class="faq">
                        <div class="title">Do I need to be a Massachusetts resident?<br></div>
                        <div class="description">No you do not</div>
                    </div>
                <div class="faq">
                    <div class="title">How much does the course cost?<br></div>
                    <div class="description">$140 one time fee</div>
                </div>
                <div class="faq">
                    <div class="title">What day/time is the class?<br></div>
                    <div class="description">We have classes available 7 days a week morning and night. You will reserve your spot after payment.</div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
