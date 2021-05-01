function seleccionOtro(op1, op2) {
    var SelCargo = document.getElementById(op1);
    var InputCargo = document.getElementById(op2);
    if (SelCargo.value == 'Otro') {
        InputCargo.removeAttribute("readonly", false);
    } else {
        InputCargo.setAttribute("readonly", true);
        InputCargo.value = "";
    }
}

function desactivar(op1, op2, op3) {
    var cmbuno = document.getElementById(op1);
    var cmbdos = document.getElementById(op2);
    var input = document.getElementById(op3);
    if (cmbuno.checked == true) {
        cmbdos.setAttribute("disabled", true);
        input.removeAttribute("readonly", false);
    } else if (cmbuno.checked == false) {
        cmbdos.removeAttribute("disabled", false);
        input.setAttribute("readonly", true);
        input.value = "";
    }
    if (cmbdos.checked == true) {
        cmbuno.setAttribute("disabled", true);
        input.removeAttribute("readonly", false);
    } else if (cmbuno.checked == false) {
        cmbuno.removeAttribute("disabled", false);
        input.setAttribute("readonly", true);
        input.value = "";
    }
}

function inputs(op1, op2, opa) {
    var cmb = document.getElementById(op1);
    var input = document.getElementById(op2);
    if (cmb.checked == true) {
        input.removeAttribute("readonly", false);
        if (opa == '2') {
            var fecha = document.getElementById('InputFecha');
            var cuota = document.getElementById('InputCuota');
            fecha.removeAttribute("readonly", false);
            cuota.removeAttribute("readonly", false);
        }
    } else if (cmb.checked == false) {
        input.setAttribute("readonly", true);
        input.value = "";
        if (opa == '2') {
            var fecha = document.getElementById('InputFecha');
            var cuota = document.getElementById('InputCuota');
            fecha.setAttribute("readonly", true);
            cuota.setAttribute("readonly", true);
            fecha.value = "";
            cuota.value = "";
        }
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