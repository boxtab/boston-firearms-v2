<div class="contact-section">

    <div class="map-block">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2946.3727904875414!2d-71.06312158418659!3d42.39850614066486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e371ff25ce3b23%3A0xa8d17d8fcbda1a72!2sBoston%20Firearms%20Safety%20Training%20Center!5e0!3m2!1sen!2sen!4v1604418404018!5m2!1sen!2sen&amp;language=en" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>

    <div class="form-block contact-form-block">
        <div class="title">
            GET IN TOUCH WITH US
        </div>
        <form action="{{ route('contact-us.store') }}" method="post">
            @csrf

            <div class="field-block">
                <label for="first_name">First Name</label>
                <input id="first_name"
                       placeholder="Enter Your First Name"
                       name="contact_us[first_name]"
                       value="{{old('contact_us.first_name')}}"
                       class="@error('contact_us.first_name')is-invalid @enderror"
                >
                @error('contact_us.first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="last_name">Last Name</label>
                <input id="last_name"
                       placeholder="Enter Your Last Name"
                       name="contact_us[last_name]"
                       value="{{old('contact_us.last_name')}}"
                       class="@error('contact_us.last_name')is-invalid @enderror"
                >
                @error('contact_us.last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="mobile">Mobile Phone</label>
                <input id="mobile"
                       placeholder="Enter Phone Number"
                       name="contact_us[phone]"
                       value="{{old('contact_us.phone')}}"
                       class="@error('contact_us.phone')is-invalid @enderror"
                >
                @error('contact_us.phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="email">Email</label>
                <input id="email"
                       placeholder="Enter Your Email"
                       name="contact_us[email]"
                       value="{{old('contact_us.email')}}"
                       class="@error('contact_us.email')is-invalid @enderror"
                >
                @error('contact_us.email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="message">Message</label>
                <textarea id="message"
                          placeholder="Write a message"
                          name="contact_us[message]"
                          class="@error('contact_us.message')is-invalid @enderror"
                >{{old('contact_us.message')}}</textarea>
                @error('contact_us.message')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-row">
                <button class="button">
                    Submit
                </button>
            </div>

        </form>
    </div>

</div>
