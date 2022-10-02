
@php
    if($_COOKIE["login"] == "true"){
        header("Location: /");
        exit();
    }
@endphp
@extends('layouts/main')
@section('container')

<style>
    html,
    body {
    height: 100%;
    }

    body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    }

    .form-signin {
    max-width: 330px;
    padding: 15px;
    }

    .form-signin .form-floating:focus-within {
    z-index: 2;
    }

    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
  
    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    
    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }
    
    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }
    
    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }
    
    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }
    
    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
    </style>
  
  
  <!-- Custom styles for this template -->
  
  <div class="container text-center">
          <main class="form-signin w-100 m-auto">
              <form>
                  {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                  <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                  
                  <div class="form-floating">
                      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                      <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    <p class="mt-2">Don't Have an account ? <a href="/register">Register</a></p>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
                </form>
            </main>
            
    
            
        </div>

        <script>
            var auth = "";
            async function handleSubmit(event) {
                event.preventDefault();

                const data = new FormData(event.target);

                const email = data.get('email');
                const password = data.get('password');
                
                var myHeaders = new Headers();
                myHeaders.append("Accept", "application/json");

                var formdata = new FormData();
                formdata.append("email", email);
                formdata.append("password", password);

                var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: formdata,
                redirect: 'follow'
                };

                let response = await fetch("http://127.0.0.1:8000/api/v1/login", requestOptions);
                let json =  await response.json();
                // let json = JSON.parse(hasil);

                console.log(json.token);
                if(json.token != null){
                    createCookie("login", "true", 0.5);
                    createCookie("token", json.token, 0.5);
                    window.location.replace('/');
                }else{
                    createCookie("login", "false", 0.5);
                    alert("Email or password wrong!!");
                }
            // fetch("http://127.0.0.1:8000/api/v1/login", requestOptions)
            // .then(response.json())
            // .catch(error => console.log('error', error))

            // console.log({ value });
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

            const form = document.querySelector('form');
            form.addEventListener('submit', handleSubmit);

        </script>
    
    @endsection