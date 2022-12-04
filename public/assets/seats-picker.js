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
        // document.body.innerHTML = data;
        document.write([response.responseText]);
        // document.body.innerHTML = response.responseText;
        // console.log(response)
      })
    // .map((seat) => ({
    //   letter: seat.id[0],
    //   number: parseInt(seat.id.slice(1))
    // }))

    // console.log(seats)
    // let seats_ = {}
    // for (const seat of seats) {
    //   if (!seats_[seat.letter])
    //     seats_[seat.letter] = []
    //   seats_[seat.letter].push(seat.number)
    // }
    // console.log(seats_)
  })
})
