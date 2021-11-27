window.onload = function() {
    createForm();
};
var form = document.getElementById("subscribeForm");

form.addEventListener('submit', (event) => {
    // stop form submission
    event.preventDefault();

    if(validateForm()){
        form.submit()
    }
});

function createForm() {
    var br = document.createElement("br");

    var form = document.createElement("form");
    form.setAttribute("name", "subscribe");
    form.setAttribute("method", "post");
    form.setAttribute("action", "/subscribe");

    var EmailInput = document.createElement("input");
    EmailInput.setAttribute("type", "email");
    EmailInput.setAttribute("name", "emailInput");
    EmailInput.setAttribute("placeholder", "example@example.com");

    var submitBtn = document.createElement("input");
    submitBtn.setAttribute("type", "submit");
    submitBtn.setAttribute("value", "Submit");

    var errorMsg = document.createElement("p");
    errorMsg.setAttribute("id", "errorMsg");
    errorMsg.setAttribute("class", "errorMsg");
    errorMsg.innerText = "Email is wrong";
    errorMsg.style.display = "none";

    form.appendChild(EmailInput); 
    form.appendChild(br); 

    form.appendChild(errorMsg); 

    form.appendChild(submitBtn); 

    document.getElementById("subscribeForm").appendChild(form);
}

function validateForm() {
    var email = document.forms["subscribe"]["emailInput"];
    var errorMsg = document.getElementById("errorMsg");

    if (email.value == "") {
        window.alert(
            "Please enter a valid e-mail address.");
        email.focus();

        errorMsg.style.display = "block";
        return false;
    }

    return true;
}