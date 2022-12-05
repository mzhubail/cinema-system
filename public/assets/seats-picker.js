$(document).ready(() => {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.seat:not(.occupied)').click(
    e => $(e.target).toggleClass('selected')
  )
  $('#tmp').click(e => {
    console.log([...$('.seat.selected')])
    let seats = [...$('.seat.selected')]
      .map((seat) => seat.id)

    $.post(
      '/choose_seats',
      {...seats},
      () => console.log('success')
    )
      .always((response) => {
        document.write([response.responseText]);
      })
  })
})
