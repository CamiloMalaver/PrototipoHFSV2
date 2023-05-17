let selectContainer = document.querySelector(".select-container")
let select = document.querySelector(".select")
let input = document.getElementById("input")
let options = document.querySelectorAll(".select-container .option")

$(document).ready(function() {
    var today = new Date().toISOString().split('T')[0]
    $('#input_function_date').attr('min', today)

    select.onclick = () => {
        selectContainer.classList.toggle("active")
    }
    
    options.forEach((e) => {
        e.addEventListener("click", () => {
            input.value = e.innerText;
            selectContainer.classList.remove("active")
            options.forEach((e) => {
                e.classList.remove("selected")
            })
            e.classList.add("selected")
        })
    })

    $('#toggle_new_function_form').click(() => {
        $('#form_add_function_container').toggleClass('d-none')
        $('#form_add_function_container').toggleClass('fade-in-top')
    })
})
