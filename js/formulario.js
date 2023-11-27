document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const enviarBtn = form.querySelector(".enviarBtn");
    const allInputs = form.querySelectorAll(".input-campos input");

    enviarBtn.addEventListener("click", (event) => {
        event.preventDefault();

        let isFormValid = true;

        allInputs.forEach(input => {
            if (input.required && input.value.trim() === "") {
                isFormValid = false;
                const errorSpan = input.nextElementSibling;
                if (errorSpan) {
                    errorSpan.textContent = "Este campo es requerido";
                }
            } else {
                const errorSpan = input.nextElementSibling;
                if (errorSpan) {
                    errorSpan.textContent = ""; // Limpia el mensaje de error si existe
                }
            }
        });

        if (isFormValid) {
            // Resto de tu código para enviar el formulario
            form.submit();
        }
    });
});
