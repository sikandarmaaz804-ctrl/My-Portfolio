<div class="col-lg-4 col-md-6 mb-4">

    <div class="card border-0 shadow-sm project-card"
         data-bs-toggle="modal"
         data-bs-target="#projectModal{{ $project->id }}">

        <!-- IMAGE -->
        <img src="{{ asset('uploads/'.$project->image1) }}"
             class="card-img-top project-img">

        <div class="card-body text-center">
            <h5 class="mb-1">{{ $project->title }}</h5>
            <p class="text-muted mb-0">{{ $project->client_name }}</p>
        </div>

    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">

            <!-- CLOSE -->
            <div class="text-end p-2">
                <button class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- CAROUSEL -->
            <div id="carousel{{ $project->id }}"
                 class="carousel slide"
                 data-bs-ride="carousel">

                <div class="carousel-inner rounded">

                    <div class="carousel-item active">
                        <img src="{{ asset('uploads/'.$project->image1) }}"
                             class="d-block w-100 rounded">
                    </div>

                    @if($project->image2)
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/'.$project->image2) }}"
                             class="d-block w-100 rounded">
                    </div>
                    @endif

                    @if($project->image3)
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/'.$project->image3) }}"
                             class="d-block w-100 rounded">
                    </div>
                    @endif

                    @if($project->image4)
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/'.$project->image4) }}"
                             class="d-block w-100 rounded">
                    </div>
                    @endif

                    @if($project->image5)
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/'.$project->image5) }}"
                             class="d-block w-100 rounded">
                    </div>
                    @endif

                    @if($project->image6)
                    <div class="carousel-item">
                        <img src="{{ asset('uploads/'.$project->image6) }}"
                             class="d-block w-100 rounded">
                    </div>
                    @endif

                </div>

                @if($project->website_link)
                <div class="text-center mt-3">
                    <a href="{{ $project->website_link }}" target="_blank" rel="noopener noreferrer"
                       class="btn btn-warning btn-sm">Visit Website</a>
                </div>
                @endif

                <!-- PREV -->
                <button class="carousel-control-prev clean-control"
                        type="button"
                        data-bs-target="#carousel{{ $project->id }}"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon clean-icon"></span>
                </button>

                <!-- NEXT -->
                <button class="carousel-control-next clean-control"
                        type="button"
                        data-bs-target="#carousel{{ $project->id }}"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon clean-icon"></span>
                </button>

            </div>

        </div>
    </div>
</div>

<!-- STYLE -->
<style>
/* REMOVE ALL BACKGROUND + BORDERS */
.clean-control {
    width: 10%;
    background: none !important;
    border: none !important;
    box-shadow: none !important;
    opacity: 1;
}

/* REMOVE DEFAULT BOOTSTRAP ICON STYLE */
.clean-icon {
    background-image: none !important;
}

/* 🔥 BOLD YELLOW ARROWS */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none !important;
    width: 32px;
    height: 32px;

    border: solid #FFD700;   /* gold/yellow */
    border-width: 0 5px 5px 0;  /* thicker arrow */
    display: inline-block;
    padding: 6px;

    transition: 0.3s ease;
}

/* LEFT ARROW */
.carousel-control-prev-icon {
    transform: rotate(135deg);
}

/* RIGHT ARROW */
.carousel-control-next-icon {
    transform: rotate(-45deg);
}

/* POSITION */
.carousel-control-prev,
.carousel-control-next {
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.85;
}

/* HOVER EFFECT */
.carousel-control-prev:hover .carousel-control-prev-icon,
.carousel-control-next:hover .carousel-control-next-icon {
    border-color: #ffcc00; /* brighter yellow */
    transform: scale(1.2) rotate(135deg);
}

.carousel-control-next:hover .carousel-control-next-icon {
    transform: scale(1.2) rotate(-45deg);
}

</style>