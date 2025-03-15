<div class="contaniner">
    <h1 class="title-h1-admin text-center text-white">Administrator Login</h1>
        <p class="text-center text-white">We have created a user so you can try the website faster</p>
    <div class="container">
        <form class="text-white" action="{{route('cook.login')}}" method="post">
            @csrf
            <div class="form-inputs">
                <div>
                    
                        @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">
                                        {{ $error }}
                                    </p>
                                    @endforeach
                        @endif
                    
                </div>
                <div >
                    <label for="email">Email</label>
                    <input id="email" type="email" value="SteveJobs@gmail.com" autocomplete="email" name="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" autocomplete="current-password" value='idfhiodfnf1234445sedfsdf!"#$%sdfsdf' name="password">
                </div>
                <div id="form-submid-admin">
                    <input type="submit" value="Login">
                </div>
            </div>
          





        </form>
    </div>  
</div>