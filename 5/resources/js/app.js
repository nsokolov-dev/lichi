let DOMReady = function (callback) {
    document.readyState === "interactive" || document.readyState === "complete" ? callback() : document.addEventListener("DOMContentLoaded", callback)
}

DOMReady(function () {
    document.querySelector('#form-registration')
      .addEventListener("submit", (e) => {
          e.preventDefault()

          let form = e.target
          let modalSuccess = document.querySelector('#modal-success')
          let formData = new FormData(form)
          let data = JSON.stringify(Object.fromEntries(formData))

          form.classList.add('_loading')

          fetch(form.attributes.action.value, {
              method: form.attributes.method.value,
              body: data,
          })
            .then(async response => {
                data = await response.json()

                if (data.status === 'error') {
                    setFormErrors(form, data.errors)
                    return
                }

                clearFormErrors(form)
                form.style.display = 'none'
                modalSuccess.style.display = 'block'
            })
            .catch(response => {
                setFormErrors(form, {server: 'Произошла ошибка, пожалуйста, свяжитесь с администратором сайта'})
            })
            .finally(() => {
                form.classList.remove('_loading')
            })
      })

    function clearFormErrors(form) {
        let existsErrors = form.querySelector('.form__errors')

        if (existsErrors) {
            existsErrors.remove()
        }
    }

    function setFormErrors(form, errors) {

        clearFormErrors(form)

        let blockErrors = document.createElement('ul')
        blockErrors.classList.add('form__errors')

        Object.keys(errors).forEach(function (property) {

            let error = document.createElement('li')
            error.innerText = property + ': ' + errors[property]
            blockErrors.append(error)

        })

        form.prepend(blockErrors)
    }

})
