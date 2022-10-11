<div class="form-block class-form-block">
    <div class="form-row">
        <div class="title">
            Sign Up For This Class
        </div>
        <form action="{{ route('class.sign-up-via-contact-form') }}" method="post">
            @csrf
            <input type="hidden" name="event_id" value="{{ $class->id }}">
            <div class="field-block">
                <label for="full">First Name</label>
                <input id="full"
                       placeholder="Enter Your Name"
                       name="first_name"
                       value="{{old('first_name') ?? ''}}"
                       required
                       class="@error('first_name')is-invalid @enderror"
                >
                @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="last">Last Name</label>
                <input id="last"
                       placeholder="Enter here"
                       name="last_name"
                       required
                       value="{{old('last_name') ?? ''}}"
                       class="@error('last_name')is-invalid @enderror"
                >
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="email">Email</label>
                <input id="email"
                       placeholder="Enter Your Email"
                       name="email"
                       required
                       value="{{old('email') ?? ''}}"
                       class="@error('email')is-invalid @enderror"
                >
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field-block">
                <label for="message">Message</label>
                <textarea id="message"
                          placeholder="Write a message"
                          name="message"
                          class="@error('message')is-invalid @enderror"
                >{{old('message') ?? ''}}</textarea>
                @error('message')
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
