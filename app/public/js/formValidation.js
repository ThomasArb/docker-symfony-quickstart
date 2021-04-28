window.onsubmit = function validatePhoneNumberAndFillIntl() {
    let phoneNumber = document.getElementById('callback_request_nationalPhoneNumber').value;
    let country = document.getElementById('callback_request_country').value;

    // response = makeValidationRequest(country, phoneNumber);
    // response.then(result => console.log(result.text()));

    let inputIntlPhoneNumber = document.getElementById('callback_request_internationalPhoneNumber');
    inputIntlPhoneNumber.value = phoneNumber;
};

async function makeValidationRequest(country, phoneNumber) {
    let formdata = new FormData();
    formdata.append('country', country);
    formdata.append('phoneNumber', phoneNumber);

    let requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    return await fetch('/validate_phone', requestOptions);
}
