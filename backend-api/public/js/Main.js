const base_url = 'http://localhost:8080/';
const apiUrl = 'api/V1/';

function isFormValid() {
    var requiredFields = $('#form').find(':input[required]');
    var isValid = true;

    requiredFields.each(function() {
        if (!$(this).val()) {
            isValid = false;
            return false;
        }
    });

    return isValid;
}

const form = document.getElementById('form');
const steps = Array.from(form.getElementsByClassName('modal-body')[0].children);
const nextButtons = Array.from(form.getElementsByClassName('next-step'));
const prevButtons = Array.from(form.getElementsByClassName('prev-step'));

function showNextStep() {
    const currentStep = getCurrentStep();
    const nextStep = currentStep + 1;
    if (nextStep < steps.length) {
        steps[currentStep].classList.add('hidden');
        steps[nextStep].classList.remove('hidden');
    }
}

function showPrevStep() {
    const currentStep = getCurrentStep();
    const prevStep = currentStep - 1;
    if (prevStep >= 0) {
        steps[currentStep].classList.add('hidden');
        steps[prevStep].classList.remove('hidden');
    }
}

function getCurrentStep() {
    return steps.findIndex((step) => !step.classList.contains('hidden'));
}

nextButtons.forEach((button) => {
    button.addEventListener('click', showNextStep);
});

prevButtons.forEach((button) => {
    button.addEventListener('click', showPrevStep);
});

function signOut() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to sign out?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I Want to Sign Out!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url:`${base_url}sign-out`,
                type: 'GET',
                dataType: 'JSON',
                success: function (respond) {
                    swal.fire({
                        icon: respond.icon,
                        title: respond.title,
                        text: respond.text,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000
                    }).then (function() {
                        window.location.href = `${base_url}`;
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal.hideLoading();
                    swal.fire("!Opps ", "Something went wrong, try again later", "error");
                }
            });
        };
    });
}