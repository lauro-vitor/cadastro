<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded mb-3">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li @if($current == "home") class="nav-item active" @else class="nav-item" @endif>
                <a href="/" class="nav-link">Home</a>
            </li>
            <li  @if($current == "produtos") class="nav-item active" @else class="nav-item" @endif>
                <a href="/produtos" class="nav-link">Produtos</a>
            </li>
            <li  @if($current == "categorias") class="nav-item active" @else class="nav-item" @endif>
                <a href="/categorias" class="nav-link">Categorias</a>
            </li>
        </ul>
    </div>
    
</nav>