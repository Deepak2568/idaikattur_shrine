@extends('layouts.app', ['title' => 'Donate'])
@section('content')
<section class="sh-page-hero" style="background-image: url('{{ asset('images/shs.png') }}');">
    <div class="container sh-animate-in">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">Support the Shrine</h1>
                <p class="lead">Share your interest to donate. Online payment will be enabled soon.</p>
            </div>
        </div>
    </div>
</section>

<div class="container sh-section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <p class="text-muted mb-4">
                        Your gift helps maintain Sacred Heart Shrine, Idaikattur, and support its ministries.
                        Please leave your details below. We will contact you, and online payment will be added later.
                    </p>

                    <div id="donateSuccess" class="alert alert-success d-none" role="alert"></div>

                    <form id="donateForm" action="{{ route('donate.store') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Full name *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold">Phone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label fw-bold">Amount you wish to donate (₹)</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" step="0.01" placeholder="Optional">
                                <span class="text-danger error-text amount_error"></span>
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label fw-bold">Address *</label>
                                <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your full address"></textarea>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-bold">Message / intention</label>
                                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Optional"></textarea>
                                <span class="text-danger error-text message_error"></span>
                            </div>
                            <div class="col-12 text-center pt-2">
                                <button type="submit" id="donateBtn" class="btn btn-danger btn-lg px-5">
                                    <i class="fas fa-donate me-2"></i> Submit donation interest
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var donateUrl = @json(route('donate.store'));

    $("#donateForm input, #donateForm textarea").on("input", function () {
        var fieldName = $(this).attr("name");
        $("." + fieldName + "_error").text("");
    });

    $("#donateForm").on("submit", function (e) {
        e.preventDefault();
        $(".error-text").text("");
        $("#donateSuccess").addClass("d-none").text("");

        var $btn = $("#donateBtn");
        var originalBtnHtml = $btn.html();

        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Processing...')
            .prop("disabled", true);

        $.ajax({
            url: donateUrl,
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json"
            },
            success: function (response) {
                if (response.status === 200) {
                    $("#donateSuccess").removeClass("d-none").text(response.message);
                    $("#donateForm")[0].reset();
                }
                $btn.html(originalBtnHtml).prop("disabled", false);
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $("." + key + "_error").text(value[0]);
                    });
                }
                $btn.html(originalBtnHtml).prop("disabled", false);
            }
        });
    });
});
</script>
@endsection
