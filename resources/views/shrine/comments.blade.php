@extends('layouts.app',['title'=>'Mass Comments'])
@extends('layouts.app', ['title' => 'Mass Comments'])

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8 text-center">
            <img src="{{ asset('images/idai1.png') }}" alt="logo" class="img-fluid mb-3" style="max-height: 90px;">
            <h5 class="fw-bold text-danger mb-2" style="font-size: 1.35rem;">
                "எமது இதய அன்பில் நிலைத்திருந்தால் எல்லா நன்மைகளும் பெறுவீர்கள்"
            </h5>
            <h6 class="fw-bold text-primary mb-1" style="font-size: 1.2rem;">
                திரு இருதய ஆண்டவர் திருத்தலம்
            </h6>
            <h6 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">
                இடைக்காட்டூர்
            </h6>
            <span class="badge bg-success fs-5 px-4 py-2 mb-3 shadow-sm" style="font-size: 1.1rem;">
                <b>திருப்பலி கருத்து</b>
            </span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg" style="border-radius: 18px;">
                <div class="card-body py-4 px-3">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="list-group list-group-flush">
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check1" id="check1">
                                        நன்றியறிதலகா 1
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check2" id="check2">
                                        நன்றியறிதலகா 2
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check3" id="check3">
                                        நன்றியறிதலகா 3
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check4" id="check4">
                                        நன்றியறிதலகா 4
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check5" id="check5">
                                        நன்றியறிதலகா 5
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check6" id="check6">
                                        நன்றியறிதலகா 6
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check7" id="check7">
                                        நன்றியறிதலகா 7
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check8" id="check8">
                                        நன்றியறிதலகா 8
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check9" id="check9">
                                        நன்றியறிதலகா 9
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check10" id="check10">
                                        நன்றியறிதலகா 10
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check11" id="check11">
                                        நன்றியறிதலகா 11
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check12" id="check12">
                                        நன்றியறிதலகா 12
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check13" id="check13">
                                        நன்றியறிதலகா 13
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="list-group list-group-flush">
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check14" id="check14">
                                        நன்றியறிதலகா 14
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check15" id="check15">
                                        நன்றியறிதலகா 15
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check16" id="check16">
                                        நன்றியறிதலகா 16
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check17" id="check17">
                                        நன்றியறிதலகா 17
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check18" id="check18">
                                        நன்றியறிதலகா 18
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check19" id="check19">
                                        நன்றியறிதலகா 19
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check20" id="check20">
                                        நன்றியறிதலகா 20
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check21" id="check21">
                                        நன்றியறிதலகா 21
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check22" id="check22">
                                        நன்றியறிதலகா 22
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check23" id="check23">
                                        நன்றியறிதலகா 23
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check24" id="check24">
                                        நன்றியறிதலகா 24
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check25" id="check25">
                                        நன்றியறிதலகா 25
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check26" id="check26">
                                        நன்றியறிதலகா 26
                                    </label>
                                    <label class="list-group-item d-flex align-items-center py-2" style="font-size: 1.05rem;">
                                        <input class="form-check-input me-2" type="checkbox" name="check27" id="check27">
                                        நன்றியறிதலகா 27
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="text-center mt-4">
                            <button type="submit" class="btn btn-danger px-5 py-2 shadow-sm fw-bold" style="font-size: 1.1rem;">
                                கருத்து சமர்ப்பிக்கவும்
                            </button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection