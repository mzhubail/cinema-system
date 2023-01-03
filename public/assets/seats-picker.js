let price;
const seatsCountError = document.getElementById('seats-count-error')

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
  price = 0
  $('#seats-picker .seat.selected').each(function () {
    if ("DE".includes(this.id[0]))
      price += 4
    else
      price += 3
  })
  $('#price-output')
    .empty()
    .append(price.toFixed(3))
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
    $('#seats-picker .seat:not(.occupied)').click(e => {
      if (
        $('#seats-picker .seat.selected').length >= 10 &&
        !e.target.classList.contains('selected')
      ) {
        seatsCountError.style.display = 'block'
        return
      }
      seatsCountError.style.display = 'none'
      $(e.target).toggleClass('selected')
      updatePrice()
    })
  }

  $('#continue-btn').click(e => {
    let seats = [...$('#seats-picker .seat.selected')]
      .map((seat) => seat.id)

    // Address of the current window
    address = window.location.search
    // Returns a URLSearchParams object instance
    parameterList = new URLSearchParams(address)
    // Get the time_slot_id
    let tsid = parameterList.get('tsid')

    // console.log({ ...seats })
    $.post(
      '/choose_seats',
      {
        time_slot_id: tsid,
        seats: { ...seats },
        price: price,
      },
    )
      .done((data) => console.log(data))
      .done((data) => {
        if (data == 'proceed')
          window.location = '/confirm_booking'
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