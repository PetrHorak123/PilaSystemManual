<header class="bg-primary bg-gradient text-white py-5">
    <div class="container px-4 text-center">
        <h1 class="fw-bolder">PilaSystem manuál</h1>


        @auth
            <p class="lead">
                Pro zobrazení kompletní dokumentace webové aplikace 
                <a href="https://www.pilasystem.cz/" class="text-reset inline-link" style="text-underline-offset: 0.3em">
                    PilaSystem
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-box-arrow-up-right mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                    </svg>
                </a> 
                klikněte na tlačítko níže.     
            </p>
            
            <div class="btn-group" style="width: 300">
                <a class="btn btn-lg btn-light btn-outline-secondary mt-2" style="width: 150px" href="{{ route('docs') }}">Dokumentace</a> 
                <a class="btn btn-lg btn-light btn-outline-success mt-2" style="width: 150px" href="{{ route('news') }}">Novinky</a> 
            </div>   
        @endauth
        
        @guest
            <p class="lead">
                Pro zobrazení kompletní dokumentace webové aplikace 
                <a href="https://www.pilasystem.cz/" class="text-reset inline-link" style="text-underline-offset: 0.3em">
                    PilaSystem
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-box-arrow-up-right mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                    </svg>
                </a> 
                se přihlaste.     
            </p>

            <a class="btn btn-lg btn-light mt-2" href="{{ route('login') }}">Přihlásit se</a> 
        @endguest

    </div>
</header>