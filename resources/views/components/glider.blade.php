<div class="glider-contain">
  <div class="glider">
    {{ $slot }}
  </div>

  <button aria-label="Previous" class="glider-prev">«</button>
  <button aria-label="Next" class="glider-next">»</button>
  <div role="tablist" class="dots"></div>
</div>


@push('scripts')
  <script src="assets/glider.js"></script>
  <script>
    window.addEventListener('load', function() {
      new Glider(document.querySelector('.glider'), {
        // slidesToShow: 3,
        // dots: '#dots',
        // arrows: {
        //   prev: '.glider-prev',
        //   next: '.glider-next'
        // }

        // Mobile-first defaults
        slidesToShow: 1,
        slidesToScroll: 1,
        scrollLock: true,
        dots: '#resp-dots',
        arrows: {
          prev: '.glider-prev',
          next: '.glider-next'
        },
        rewind: true,
        responsive: [{
          // screens greater than >= 576px
          breakpoint: 576,
          settings: {
            // Set to `auto` and provide item width to adjust to viewport
            slidesToShow: 2, //'auto',
            slidesToScroll: 'auto',
            itemWidth: 150,
            duration: 0.25
          }
        }, {
          // screens greater than >= 768px
          breakpoint: 768,
          settings: {
            // Set to `auto` and provide item width to adjust to viewport
            slidesToShow: 3, //'auto',
            slidesToScroll: 'auto',
            itemWidth: 150,
            duration: 0.25
          }
        }, {
          // screens greater than >= 992px
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            itemWidth: 150,
            duration: 0.25
          }
        }]
      })
    })
  </script>
@endpush
