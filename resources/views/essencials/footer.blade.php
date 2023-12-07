@section('footer')
<footer>
    <div class="row" id="footer">
        <div class="row" id="sub-footer">
            <div class="col-md-4">
                <p id="marca-footer">Quas Factory</p>
            </div>
            <div class="col-md-2">
            </div>
            
            <div class="col-md-3 ml-auto" id="fecha">
                <?php
                        echo date("l, j F Y, h:i A");
                ?>
            </div>
            <div class="col-md-2" id="logout">                 
                <form method="POST" action="{{ route('logout') }}" id="logout-button">
                    @csrf
                    <button type="submit" class="btn btn-link" id="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </div>
</footer>
@endsection