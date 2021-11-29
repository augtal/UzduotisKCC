@extends('layouts.app')

@section('content')
<div class="container" id="mainContainer">
</div> 
@endsection

@section('scripts')
    <script>
        window.onload = function() {
            createPage();
        };

        function createPage() {
            var form = document.createElement("div");

            var message = {!! json_encode($message, JSON_HEX_TAG)!!};

            let markup =`
            <div class="row justify-content-center">
                <div class="col-md-8">`;

            if (message != null){
                if (message['type'] == 'success')
                    markup += `<h4><li class="success">${message['message']}</li></h4>`;
                else
                    markup += `<h4><li class="error">${message['message']}</li></h4>`;
            }
                    
            markup += `<div class="card">
                        <div class="card-header"><h3>Subscribe to our newsletter</h3></div>

                        <div class="card-body">
                            <form id="subscribeForm" action="/subscribe/completed" method="post">
                                @csrf
                                <div>
                                    <label for="email">Enter your email: </label>
                                    <input type="text" id="email" name="email" class="custom-Email">
                                    <input type="hidden" id="formValues" name="formValues" value="">
                                </div>
                                <p style="display: none" class="errorMsg" id="errorMsg">Email adress is wrong</p>

                                <button type="submit" class="btn btn-custom">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            `;

            form.innerHTML = markup;
            document.getElementById("mainContainer").appendChild(form);
        };
    </script>

    <script>
        window.addEventListener("load", function() {
            let form = document.forms["subscribeForm"];
            form.addEventListener('submit', handleSubmit);
        });

        function handleSubmit(event) {
            let form = document.forms["subscribeForm"];
            event.preventDefault();

            if(validateForm()){
                document.getElementById("formValues").value = JSON.stringify({'email' : form["email"].value});
                form.submit();
            }
        }

        function validateForm() {
            var email = document.forms["subscribeForm"]["email"];
            var errorMsg = document.getElementById("errorMsg");
            var re = new RegExp('[a-zA-Z0-9_].+@[a-zA-Z0-9_].+\.[a-zA-Z0-9_].+');

            if (! re.test(email.value)) {
                errorMsg.style.display = "block";
                return false;
            }
            else if (email.value == "") {
                errorMsg.style.display = "block";
                return false;
            }

            

            return true;
        }
    </script>

@endsection