<section class="ftco-section-parallax">
    <div class="parallax-img d-flex align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <h2>Subscribe to our Newsletter</h2>
                    <p>Get the lastest information about new jobs popping accross the world</p>
                    <div class="row d-flex justify-content-center mt-4 mb-4">
                        <div class="col-md-12">
                            <form action="{{ route('subscribe') }}" method="POST" class="subscribe-form">
                                @csrf
                                <div class="form-group d-flex">
                                    <input type="email" required name="email" class="form-control"
                                        placeholder="Enter email address">
                                    @error('email')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <input type="submit" value="Subscribe" class="submit px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <h2>Write a feedback</h2>
                    <div class="row justify-content-center mt-4 mb-4">
                        <div class="col-md-12">
                            <form action="{{ route('feedback') }}" method="POST" class="subscribe-form">
                                @csrf
                                <div class="form-group">
                                    <input type="name" required name="name" class="form-control mb-2"
                                        placeholder="Enter your name">
                                    @error('name')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <input type="email" required name="email" class="form-control mb-2"
                                        placeholder="Enter email address">
                                    @error('email')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <textarea name="message" required cols="30" rows="5" class="form-control mb-2"> {{ old('message') }} </textarea>
                                    @error('message')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <input type="submit" value="Submit" class="submit px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
