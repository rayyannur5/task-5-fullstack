<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
    <div class="container">
      <a class="navbar-brand" href="/">Rakamin Project</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Home") ? 'active' : '' }}" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "About") ? 'active' : '' }}" href="/about">About me</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light me-2" type="submit">Search</button>
        </form>

        @if ($_COOKIE["login"] == "true")
        <a href="/about">
          <p class="text-light mt-3 ms-2" id="account_name"></p>
        </a>
        @else
            <a href="/login">
            <button class="btn btn-outline-light bg-danger" >Login</button>
            </a>
              
          @endif
      </div>
    </div>
</nav>

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
    let data = json.name;
    // name = data.name;
    console.log(json);
    document.getElementById("account_name").innerHTML = data;
  }
  getInfo();
</script>
