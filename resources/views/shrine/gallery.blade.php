@extends('layouts.app',['title'=>'Gallery'])
@section('content')
<div class="container py-5">    
    <div class="row">
        @for ($i = 1; $i <= 50; $i++)
            @if(file_exists(public_path('images/gallery/' . $i . '.jpg')))
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                <div class="gallery-item">
                    <img src="{{ asset('images/gallery/' . $i . '.jpg') }}" 
                         class="img-fluid rounded gallery-img" 
                         alt="Gallery Image {{ $i }}">
                </div>
            </div>
            @endif
        @endfor
    </div>
</div>

<style>
.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    background: #fff;
    padding: 8px;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.gallery-img {
    height: 300px;
    object-fit: cover;
    width: 100%;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-img {
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .gallery-img {
        height: 250px;
    }
}

@media (min-width: 768px) {
    .gallery-img {
        height: 280px;
    }
}

@media (min-width: 992px) {
    .gallery-img {
        height: 320px;
    }
}

@media (min-width: 1200px) {
    .gallery-img {
        height: 350px;
    }
}
</style>
@endsection
