/* Utilities functions from browse_time_slots.php */
newTag = (t, s) => `<${t}> ${s} </${t}>`
newRow = s => newTag("tr", s)
newCell = s => newTag("td", s)
// newRow = s => `<tr> ${s} </tr>`
// newCell = s => `<td> ${s} </td>`

$(document).ready(() => {
  $("[onchange]").change()

  $('.custom-file-input')
    .change(e => setFilename(e.target))
    .change()
})

/**
 * Used in browse_time_slots.php to fetch time slots info and output them in a table
 *
 * Assumes the existance of an empty container #ts-table for the output
 */
function timeSlotsTableHandler(e) {
  header = ["ID", "Branch Name", "Hall letter", "Date", "Time", ""];
  mid = e.value
  $.getJSON(`api/get_time_slots?mid=${mid}`)
    .done((data) => {
      if (data.length === 0) {
        // TODO: add message to be displayed in case no time slot exists
        $("#ts-table")
          .css("display", "none")
        return
      }
      content = '<table class="table table-striped">'
      content += newTag(
        "thead",
        newRow(
          header.map(s => newCell(s)).join(" ")
        )
      );
      content += "<tbody>"
      data.forEach(element => {
        j = element
        content += `<tr>
            <td> ${element.id} </td>
            <td> ${element.branch_name} </td>
            <td> ${element.hall_letter} </td>
            <td> ${element.date} </td>
            <td> ${element.time} </td>
            <td> <a href='/edit_time_slot?id=${element.id}'> Edit </a> </td>
          </tr>`
      });
      content += '</tbody> </table>'
      $("#ts-table")
        .empty()
        .append(content)
        .css("display", "block")
    })
}

/**
 * Used in browse_time_slots.php to fetch time slots info and output them in a table
 *
 * Assumes the existance of an empty container #ts-table for the output
 */
function timeSlotsSelectHandler(e) {
  hid = e.value
  if (hid === '')
    return
  $.getJSON(`api/get_time_slots?hid=${hid}`)
    .done((data) => {
      // Disable seats picker
      if (typeof disableSeatsPicker !== 'undefined')
        disableSeatsPicker();

      // Ensure time slots exist
      if (data.length === 0) {
        $("#time-slot-input")
          // Disable time slot input
          .attr("disabled", "disabled")
          .empty()
          .append("<option hidden disabled selected value> -- No time slots exist -- </option>")
        return
      }
      // Convert data to options
      content = data.map((data) => {
        return `<option value="${data.id}"> ${data.id} | ${data.start_time} </option>`;
      })
      content.unshift("<option hidden disabled selected value> -- Choose a time slot -- </option>")
      $("#time-slot-input")
        // Enable halls input
        .removeAttr("disabled")
        // Add options
        .empty()
        .append(content)
    })
}

/**
 * Used in add_time_slots.php to fetch halls and place them as options in #hall-input
 */
function hallsSelectHandler(e) {
  bid = e.value
  $.getJSON(`api/get_halls?bid=${bid}`)
    .done((data) => {
      // Disable time slot input
      $("#time-slot-input")
        .attr("disabled", "disabled")
        .empty()
      // Disable seats picker
      if (typeof disableSeatsPicker !== 'undefined')
        disableSeatsPicker();

      // Ensure halls exist
      if (data.length === 0) {
        $("#hall-input")
          // Disable halls input
          .attr("disabled", "disabled")
          .empty()
          .append("<option hidden disabled selected value> -- No halls exist -- </option>")
        return
      }
      // Convert data to options
      content = data.map((data) => {
        return `<option value="${data.id}"> ${data.letter} </option>`;
      })
      content.unshift("<option hidden disabled selected value> -- Choose a hall -- </option>")
      $("#hall-input")
        // Enable halls input
        .removeAttr("disabled")
        // Add options
        .empty()
        .append(content)
    })
}

function hallsTableHandler(e) {
  header = ["ID", "Letter", ""];
  // bid = e.target.value
  bid = e.value
  $.getJSON(`api/get_halls?bid=${bid}`)
    .done((data) => {
      // Ensure halls exist
      if (data.length === 0) {
        // TODO: add message to be displayed in case no time slot exists
        $("#halls-table")
          .css("display", "none")
        return
      }

      content = '<table class="table table-striped">'
      content += newTag(
        "thead",
        newRow(
          header
            .map(s => newCell(s))
            .join(" ")
        )
      );
      content += "<tbody>"
      data.forEach(element => {
        j = element
        content += `<tr>
            <td> ${element.id} </td>
            <td> ${element.letter} </td>
            <td> <a href="edit_hall?id=${element.id}"> Edit </a> </td>
          </tr>`
      });
      content += '</tbody> </table>'
      $("#halls-table")
        .empty()
        .append(content)
        .css("display", "block")
    })
}


/**
 * Used in /browse_bookings_by_customer to fetch a given customer's booking info
 * and output them in a table
 *
 * Assumes the existance of an empty container #ts-table for the output
 */
function bookingsByCustomerHandler(e) {
  header = ["ID", "Movie Title", "Movie Time", "Booking Time", "Price"];
  cid = e.value
  $.getJSON(`/api/get_bookings?cid=${cid}`)
    .done((data) => {
      if (data.length === 0) {
        // TODO: add message to be displayed in case no bookings exist
        $("#ts-table")
          .css("display", "none")
        return
      }
      content = '<table class="table table-striped">'
      content += newTag(
        "thead",
        newRow(
          header.map(s => newCell(s)).join(" ")
        )
      );
      content += "<tbody>"
      data.forEach(element => {
        j = element
        content += `<tr>
            <td> ${element.id} </td>
            <td> ${element.movie_title} </td>
            <td> ${element.movie_time} </td>
            <td> ${element.booking_time} </td>
            <td> ${element.price} </td>
          </tr>`
      });
      content += '</tbody> </table>'
      $("#ts-table")
        .empty()
        .append(content)
        .css("display", "block")
    })
}


/**
 * Used in /browse_bookings_by_time_slot to fetch a given booking info inside a
 * given time slot and output them in a table
 *
 * Assumes the existance of an empty container #ts-table for the output
 */
function bookingsByTimeSlotHandler(e) {
  header = ["ID", "Movie Title", "Movie Time", "Booking Time", "Price"];
  tsid = e.value
  $.getJSON(`/api/get_bookings?tsid=${tsid}`)
    .done((data) => {
      if (data.length === 0) {
        // TODO: add message to be displayed in case no bookings exist
        $("#ts-table")
          .css("display", "none")
        return
      }
      content = '<table class="table table-striped">'
      content += newTag(
        "thead",
        newRow(
          header.map(s => newCell(s)).join(" ")
        )
      );
      content += "<tbody>"
      data.forEach(element => {
        j = element
        content += `<tr>
            <td> ${element.id} </td>
            <td> ${element.movie_title} </td>
            <td> ${element.movie_time} </td>
            <td> ${element.booking_time} </td>
            <td> ${element.price} </td>
          </tr>`
      });
      content += '</tbody> </table>'
      $("#ts-table")
        .empty()
        .append(content)
        .css("display", "block")
    })
}

// Used for .custom-file-input
function setFilename(elem) {
  if (elem.files.length == 0) return
  var fileName = elem.files[0].name;
  var nextSibling = elem.nextElementSibling

  nextSibling.innerText = fileName
}