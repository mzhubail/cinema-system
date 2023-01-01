const input = document.getElementById('search-box'),
  form = document.getElementById('search-form'),
  moviesContainer = document.getElementById('movies-container'),
  suggestionsContainer = document.getElementById('suggestions-container');

input.addEventListener('keyup', function () {
  let v = input.value
  if (v == '')
    return
  const r = new XMLHttpRequest()
  r.onload = function () {
    suggestionsContainer.innerHTML = this.responseText
  }
  r.open('get', `/api/search?q=${v}&m=suggest`)
  r.send()
})

form.addEventListener('submit', function (e) {
  e.preventDefault()
  const r = new XMLHttpRequest()
  r.onload = function () {
    moviesContainer.innerHTML = this.responseText != ''
      ? this.responseText
      : 'Sorry, no movies were found';
  }
  r.open('get', `/api/search?q=${input.value}&m=cards`)
  r.send()
})
