function seleccionOtro(op1, op2) {
    let SelCargo = document.getElementById(op1);
    let InputCargo = document.getElementById(op2);
    if (SelCargo.value == 'Otro') {
        InputCargo.removeAttribute("readonly", false);
    } else {
        InputCargo.setAttribute("readonly", true);
        InputCargo.value = "";
    }
}

function mensajes() {
    Swal.fire({
        tittle: 'Registrado con exito',
        showConfirmButton: false,
        icon: 'success',
        timer: 2000
    });

}