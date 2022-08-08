@extends('layouts.app')
@section('content')
    <div class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 mb-5">
                    <h1>Messages</h1>
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Conversation with <span
                                style="font-size: 30px; font-style: bold; color:green;">
                                {{ ucWords($data['application']->vacancy->company->user->name) }} </span>from <span
                                style="font-size: 30px; font-style: bold; color:blue;">
                                {{ ucWords($data['application']->vacancy->company->company_name) }} </span> who listed <span
                                style="font-size: 30px; font-style: bold; color:blue;">
                                {{ ucWords($data['application']->vacancy->title) }} </span> job.</h3>
                        @if ($data['conversation'])
                            @foreach ($data['conversation']->message as $convo)
                                <p
                                    style="border-width: thin;  -webkit-background-clip: padding-box; border-style:solid; border-color: black; padding: 1em;">
                                    @if ($convo->sender == auth()->user()->id)
                                        You : <span style="color: green">{{ $convo->message }}</span>
                                    @else
                                        {{ ucfirst($convo->senderr->name) }} : <span
                                            style="color: purple">{{ $convo->message }}</span>
                                    @endif
                                </p>
                            @endforeach

                            <form
                                action="{{ route('jobs.candidates.message', ['job_id' => $data['job']->id, 'applicant_id' => $data['application']->id]) }}"
                                method="POST" class="p-5 bg-white">
                                @csrf
                                <input type="hidden" name="conversation_id" value="{{ $data['conversation']->id }}">
                                <div class="row form-group">
                                    <div class="col-md-12 mb-3 mb-md-0">
                                        <label class="font-weight-bold" for="message">Message</label>
                                        <input type="text" id="message" name="message" required
                                            value="{{ old('message') }}" class="form-control"
                                            placeholder="Your message here">
                                        @error('message')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                        @if (session('error'))
                                            <span style="color: red;">{{ session('error') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <p><button type="submit" value="Send Message" class="btn btn-primary py-2 px-4">Send
                                        Message</button></p>
                            </form>
                            @else
                            <div class="col-md-12 ftco-animate">
                                <p style="color: red;">No messages from the Employer !</p>
                            </div><!-- end -->
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
