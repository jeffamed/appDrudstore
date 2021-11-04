import Swal from "sweetalert2";

export function useToast() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const successToast = (action) => {
        Toast.fire({
            icon: 'success',
            title: `${action} Exitosamente`
        })
    }

    const errorToast = () => {
      Toast.fire({
          icon: 'error',
          title: 'Algo salio mal, revise el formulario.'
      })
    }

    return {successToast, errorToast}
}
