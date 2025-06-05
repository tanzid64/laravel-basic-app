@php
    // ** Get Hero from database **
    $hero = App\Models\Hero::find(1);
@endphp
<div class="lonyo-hero-section light-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 d-flex align-items-center">
          <div class="lonyo-hero-content" data-aos="fade-up" data-aos-duration="700">
            <h1 id="hero-title" contentEditable="{{ auth()->check() ? 'true' : 'false' }}"  class="hero-title">{{ $hero->title }}</h1>
            <p id="hero-description" contentEditable="{{ auth()->check() ? 'true' : 'false' }}" class="text">{{ $hero->description }}</p>
            <div class="mt-50" data-aos="fade-up" data-aos-duration="900">
              <a href="{{ $hero->link }}" class="lonyo-default-btn hero-btn">{{ $hero->button_text }}</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="lonyo-hero-thumb" data-aos="fade-left" data-aos-duration="700">
            <img src="{{ asset($hero->image) }}" alt="">
            <div class="lonyo-hero-shape">
              <img src="{{ asset('frontend/assets/images/shape/hero-shape1.svg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    function saveChanges(element) {
      let field = element.attr('id') === 'hero-title' ? 'title' : 'description';
      let value = element.text().trim();

      $.ajax({
        url: '{{ route("update.hero.content") }}',
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: 'application/json',
        data: JSON.stringify({
          field: field,
          value: value
        }),
      });
    }

    $('#hero-title, #hero-description').on('blur', function() {
      saveChanges($(this));
    });

    $(document).on('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        saveChanges($(e.target));
      }
    });
  });
</script>
