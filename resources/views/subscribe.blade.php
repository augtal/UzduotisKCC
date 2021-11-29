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

            var sites = {!! json_encode($message, JSON_HEX_TAG)!!};

            console.log(sites);

            let markup =`
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><h3>Subscribe to our newsletter</h3></div>

                        <div class="card-body">
                            <form id="subscribeForm" action="/subscribe/completed" method="post">
                                @csrf
                                <label for="email">Enter your email: </label>
                                <input type="email" id="email" name="email" required>
                                <br>
                                <button type="submit" class="btn btn-success">Submit</button>
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
                form.submit();
            }
        }

        function validateForm() {
            var email = document.forms["subscribeForm"]["email"];
            var errorMsg = document.getElementById("errorMsg");

            if (email.value == "") {
                errorMsg.style.display = "block";
                return false;
            }

            return true;
        }
    </script>

@endsection