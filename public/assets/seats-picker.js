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

  if (typeof pushedSeats !== 'undefined')
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

// TODO: disable seat selection when no time slot is chosen
// TODO: add a message to be displayed in case the hall is full
// TOOD: fix changing branch doesn't reset timeslots

function seatsPickerHandler(element) {
  tsid = element.value
  if (tsid === '')
    return
  $.getJSON(`api/get_seats?tsid=${tsid}`)
    .done((data) => {
      resetSeats(data)
    })
}