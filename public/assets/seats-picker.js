function resetSeats(seats) {
  $('.seat').each(function () {
    if (seats.includes(this.id))
      this.classList.add('occupied')
  })
}

$(document).ready(() => {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  resetSeats(pushedSeats);

  $('.seat:not(.occupied)').click(
    e => $(e.target).toggleClass('selected')
  )
  $('#tmp').click(e => {
    console.log([...$('.seat.selected')])
    let seats = [...$('.seat.selected')]
      .map((seat) => seat.id)

    $.post(
      '/choose_seats',
      { ...seats },
      () => console.log('success')
    )
      .always((response) => {
        document.write([response.responseText]);
      })
  })
})
