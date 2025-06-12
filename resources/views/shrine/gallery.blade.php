@extends('layouts.app',['title'=>'Gallery'])
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center font-weight-bold">Gallery</h2>
    <ul class="nav nav-tabs justify-content-center mb-4" id="galleryTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-toggle="tab" data-target="#all" type="button" role="tab">All</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="festival-tab" data-toggle="tab" data-target="#festival" type="button" role="tab">Festival</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="church-tab" data-toggle="tab" data-target="#church" type="button" role="tab">Church</button>
        </li>
    </ul>
    <div class="tab-content" id="galleryTabContent">
        <!-- All Tab -->
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <div class="row">
                <!-- 50 image divs for All -->
                @for ($i = 0; $i < 50; $i++)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 cursor-pointer">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset('images/gallery/PXL_20220625_131750636.jpg') }}" 
                             class="img-fluid rounded gallery-img" 
                             alt="Gallery Image {{ $i+1 }}" 
                             data-toggle="modal" 
                             data-target="#galleryModal" 
                             data-index="{{ $i }}">
                    </div>
                </div>
                @endfor
            </div>
        </div>
        <!-- Festival Tab -->
        <div class="tab-pane fade" id="festival" role="tabpanel">
            <div class="row">
                @for ($i = 0; $i < 50; $i++)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 cursor-pointer">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset('images/gallery/PXL_20220625_131750636.jpg') }}" 
                             class="img-fluid rounded gallery-img" 
                             alt="Festival Image {{ $i+1 }}" 
                             data-toggle="modal" 
                             data-target="#galleryModal" 
                             data-index="{{ $i }}">
                    </div>
                </div>
                @endfor
            </div>
        </div>
        <!-- Church Tab -->
        <div class="tab-pane fade" id="church" role="tabpanel">
            <div class="row">
                @for ($i = 0; $i < 50; $i++)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 cursor-pointer">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset('images/gallery/PXL_20220625_131750636.jpg') }}" 
                             class="img-fluid rounded gallery-img" 
                             alt="Church Image {{ $i+1 }}" 
                             data-toggle="modal" 
                             data-target="#galleryModal" 
                             data-index="{{ $i }}">
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Modal with Carousel -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="galleryModalLabel">Gallery</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div id="galleryCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @for ($i = 0; $i < 50; $i++)
            <div class="carousel-item{{ $i == 0 ? ' active' : '' }}">
              <img src="{{ asset('images/gallery/PXL_20220625_131750636.jpg') }}" class="d-block w-100" alt="Gallery Image {{ $i+1 }}">
            </div>
            @endfor
          </div>
          <a class="carousel-control-prev" href="#galleryCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#galleryCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.modal {
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-dialog {
    margin: 1.75rem auto;
}

.modal-content {
    border: none;
    border-radius: 8px;
    overflow: hidden;
}

.carousel-control-prev,
.carousel-control-next {
    width: 15%;
    opacity: 0.9;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 15px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    background-size: 50%;
}

.modal-sm {
    max-width: 350px;
}

.carousel-item img {
    object-fit: cover;
    height: 250px;
    width: 100%;
}

.modal-header {
    padding: 0.5rem 1rem;
}

.modal-title {
    font-size: 1.1rem;
}

.close {
    padding: 0.5rem;
    margin: -0.5rem -0.5rem -0.5rem auto;
}

.close span {
    font-size: 1.5rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal carousel logic
    document.querySelectorAll('.gallery-img').forEach((img, idx) => {
        img.addEventListener('click', function() {
            var carousel = $('#galleryCarousel');
            carousel.carousel(parseInt(this.dataset.index));
        });
    });

    // Center modal on show
    $('#galleryModal').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').css({
            'margin-top': function () {
                return ($(window).height() - $(this).height()) / 2;
            }
        });
    });
});
</script>
@endsection
