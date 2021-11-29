@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ __('Welcome') }}</h3></div>

                <div class="card-body">
                    <h4>{{ __('To subscribe to our newsletter press the button below')}}</h4>
                    <a href="{{ url('subscribe') }}" class="btn btn-info">Subscribe</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script defer>
        window.onload = function() {
            createForm();
        };

        function createForm() {
            var br = document.createElement("br");

            var generateForm = document.getElementById("subscribeForm");

            // var EmailLabel = document.createElement("label");
            // EmailLabel.setAttribute("for", "email");
            // EmailInput.innerText = "Email:"

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

            // generateForm.appendChild(EmailLabel); 
            // generateForm.appendChild(br); 
            
            generateForm.appendChild(EmailInput); 
            generateForm.appendChild(br); 

            generateForm.appendChild(errorMsg); 

            generateForm.appendChild(submitBtn); 

            document.getElementById("subscribeFormDiv").appendChild(generateForm);
        }
    </script>

    {{-- <script>
        const form = document.getElementById('subscribeForm');
        form.addEventListener('submit', handleSubmit);

        function handleSubmit(event) {
            event.preventDefault();

            if(validateForm()){
                
                console.log(form);
                console.log(json);
            }
        }

        function validateForm() {
            var email = document.forms["subscribeForm"]["emailInput"];
            var errorMsg = document.getElementById("errorMsg");

            if (email.value == "") {
                errorMsg.style.display = "block";
                return false;
            }

            return true;
        }
    </script> --}}

@endsection