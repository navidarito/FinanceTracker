<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container ">
        
        <a class="navbar-brand" href="#"> <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                    style="width: 50px;" alt="logo">The Lotus Finance Tracker</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
            <ul class="navbar-nav text-center">
            
           


            @Auth
                <li class="nav-item">
                    <a class="nav-link" href="/budget/report">Report</a>   
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/transactions">Transactions</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="/transactions/add">Add transaction </a>
                </li>
                

                <li class="nav-item">
                    <a class="nav-link" href="/budget">Budgets</a>   
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/budget/add">Add Budget</a>   
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/categories">Categories</a>   
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/categories/add">Add Category</a> 
                </li>
      
            @endauth

            </ul>

            
              

            
        </div>

    </div>

        @auth
        
            <span class="badge badge-secondary m-1 fs-5">
                Hi there, {{Auth::user()->name}}
            </span>


        <form action="{{route('logout')}}" method="POST" class="m-0">
            @csrf
            <button class="btn btn-outline-success my-2 my-sm-0 m-1" type="submit">Log out</button>
        </form>
        @endauth
</nav>