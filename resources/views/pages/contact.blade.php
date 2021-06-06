@extends('layout.master')

@section('title', 'contact')

@section('contact')

<script>
    location.assign('#contact');
</script>

<div class="message-panel" id="message">

    <div class="contact-form php-mail-form" role="form">

        <div class="form-group">
            <input type="name" name="name" class="form-control" id="contact-name" value="" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" >
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="contact-email" value="" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
        </div>
        <div class="form-group">
            <input type="text" name="subject" class="form-control" id="contact-subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="message" id="contact-message" placeholder="Your Message" rows="5" data-rule="required" data-msg="Please write something for us"></textarea>
        </div>

        <p class="message-sending"></p>

        <div class="form-send">
            <button id="valid_form" class="btn btn-large btn-primary">Send Message</button>
        </div>

    </div>

</div>
@endsection

