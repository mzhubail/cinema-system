function resetSeats(seats) {
  $('.seat').each(function () {
    if (seats.includes(this.id))
      this.classList.value = 'seat occupied'
    else
      this.classList.value = 'seat'
  })
}

$(document).ready(() => {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  resetSeats(pushedSeats);

  allowSelection = true
  if (allowSelection)
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

function seatsPickerHandler(element) {
  tsid = element.value
  if (tsid === '')
    return
  $.getJSON(`api/get_seats?tsid=${tsid}`)
    .done((data) => {
      resetSeats(data)
    })
}