function resetSeats(seats) {
  $('#seats-picker .seat').each(function () {
    if (seats.includes(this.id))
      this.classList.value = 'seat occupied'
    else
      this.classList.value = 'seat'
  })
  document.getElementById('seats-picker')
    .classList.remove('disabled')
}

function disableSeatsPicker() {
  document.getElementById('seats-picker')
    .classList.add('disabled')
}

function updatePrice() {
  let price = 0
  $('#seats-picker .seat.selected').each(function () {
    if ("DE".includes(this.id[0]))
      price += 3
    else
      price += 2
  })
  $('#price-output')
    .empty()
    .append(price)
  if (price == 0)
    $('#continue-btn').attr('disabled', 'disabled')
  else
    $('#continue-btn').removeAttr('disabled')
}

$(document).ready(() => {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  if (typeof pushedSeats !== 'undefined') {
    resetSeats(pushedSeats);

    // Allow seat selection
    $('#seats-picker .seat:not(.occupied)').click(
      e => {
        $(e.target).toggleClass('selected')
        updatePrice()
      }
    )
  }

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