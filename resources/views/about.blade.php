@extends('layouts/main')
@section('navbar')
    @include('partials/navbar')
@endsection
@section('container')
<main>

    <div class="container mt-5 pt-5">
        <h1 id="account_name_">Name</h1>
        <h3 id="account_email_">email</h3>
            <button onclick="logout()" class="btn btn-danger">Logout</button>
    </div>
</main>
    
    <script>
        async function getInfo(){
            var myHeaders = new Headers();
            let text1 = "Bearer";
            let text2 = "{{ $_COOKIE["token"] }}";
            let result = text1.concat(" ", text2);
            myHeaders.append("Authorization", result );
        
            var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
            };
            let response = await fetch("http://127.0.0.1:8000/api/v1/profile", requestOptions);
            let json = await response.json();
            let name = json.name;
            let email = json.email;
            // name = data.name;
            document.getElementById("account_name_").innerHTML = name;
            document.getElementById("account_email_").innerHTML = email;
        }

        function createCookie(name, value, days) {
                var expires;
                
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                }
                else {
                    expires = "";
                }
                
                document.cookie = escape(name) + "=" + 
                    escape(value) + expires + "; path=/";
            }


        function logout(event){
            var myHeaders = new Headers();
            myHeaders.append("Accept", "application/json");
            let text1 = "Bearer";
            let text2 = "{{ $_COOKIE["token"] }}";
            let result = text1.concat(" ", text2);
            myHeaders.append("Authorization", result );

            var formdata = new FormData();

            var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: formdata,
            redirect: 'follow'
            };
            console.log("masuk sini");
            createCookie("login", "false", 0.5);

            fetch("http://127.0.0.1:8000/api/v1/logout", requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));
            window.location.reload();
        }


        getInfo();
        </script>

@endsection